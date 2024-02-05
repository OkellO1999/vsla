<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoansController extends Controller
{
    public function index(){
        
        return view('loans');
    }
    public function addingLoanRequest(Request $request){
        $data = $request->all();
        // dd($data);
        DB::table('_non_members_loans')
        ->insert([
            'firstName'=>$request->surname,
            'lastName'=>$request->other_names,
            'maritalStatus'=>$request->maritalStatus,
            'occupation'=>$request->occupation,
            'village'=>$request->village,
            'parish'=>$request->parish,
            'subCounty'=>$request->subCounty,
            'district'=>$request->district,
            'NIN'=>$request->nin,
            'email'=>$request->email,
            'contact'=>$request->contact,
            'LC1Names'=>$request->lc1names,
            'LC1Contacts'=>$request->lc1contact,
            'ClanLeaderNames'=>$request->clanLeaderContact,
            'ClanLeaderContact'=>$request->clanLeaderNames,
            'amountRequested'=>$request->requestedAmount,
            'reason'=>$request->reason,
            'status'=>'pending',
            'user_id'=>$request->guarantor,
            'group_id'=>Auth::user()->group_id,
        ])
        ;
    }

    public function loanRequest(){
        $nonMembersLoanRequests =DB::table('_non_members_loans')
        ->join('groups','groups.id', '=' , '_non_members_loans.group_id')
        ->join('users','users.id' ,'=', '_non_members_loans.user_id')
        ->select('_non_members_loans.*','users.name')
        ->where('_non_members_loans.group_id',Auth::user()->group_id)
        ->get()
        ;
        $num =1;
        // dd($nonMembersLoanRequests);
        return view('loanRequest',['nonMembersLoanRequests'=>$nonMembersLoanRequests,'num'=>$num]);
    }
    public function loanRequestMembers(){
        $membersLoanRequests =DB::table('requests')
        ->join('users','users.id' ,'=', 'requests.user_id')
        ->select('requests.*','users.name','users.contact','users.group_id','users.id')
        ->where('requests.user_id',Auth::user()->id)
        ->get()
        ;
        $num =1;
        // dd($membersLoanRequests);
        return view('members-loan-requests',['membersLoanRequests'=>$membersLoanRequests,'num'=>$num]);
    }
    public function loanDetails($borrowerId){

        $details = DB::table('_non_members_loans')
        ->join('groups','_non_members_loans.group_id', '=', 'groups.id')
        ->join('users','_non_members_loans.user_id', '=', 'users.id')
        ->select('_non_members_loans.*','users.name','groups.*')
        ->where('_non_members_loans.id',$borrowerId)
        ->get()
        ;
        // dd($details);
        return view('loanDetails',['details'=>$details]);
    }
    public function approveRequest($id){
        $approvalInfo = DB::table('_non_members_loans')
        ->join('groups','_non_members_loans.group_id', '=', 'groups.id')
        ->select('_non_members_loans.*')
        ->where('_non_members_loans.id',$id)
        ->get()
        ;
        return view('approveLoan',['approvalInfo'=>$approvalInfo]);
    }
    public function approveMembersRequest($uid){
        $approvalInfo = DB::table('requests')
        ->join('users','requests.user_id', '=', 'users.id')
        ->select('requests.*','users.*')
        ->where('users.id',$uid)
        ->get()
        ;
        return view('approveMembersLoan',['approvalInfo'=>$approvalInfo]);
    }
    public function handleApproval(Request $request){
        // dd($request->all());
        $interestRate=$request->interestRate / 100;
        $interest = $interestRate * $request->givenAmount;
        $totalInterest = $interest * $request->paymentPeriod;
        $payBackAmount = $request->givenAmount + $totalInterest;
        $sequentialPayment = $payBackAmount / ($request->paymentSequence * $request->paymentPeriod);

        if($request->paymentSequence === $request->paymentPeriod){
            $sequentialPayment = $payBackAmount;
        }

        $loanIssuingDate = Carbon::now();
        $dueDate = $loanIssuingDate->copy()->addDays($request->paymentPeriod * 30);
        $id=$request->id;
        DB::transaction( function() use($request,$interestRate,
        $interest,
        $totalInterest,
        $payBackAmount,
        $sequentialPayment,
        $loanIssuingDate,
        $dueDate,
        $id){

            $loanApproval = DB::table('loans')
            ->insert([
                'loanAmount'=>$request->givenAmount,
                'issueDate'=>$loanIssuingDate,
                'dueDate'=>$dueDate,
                'interestRate'=>$interestRate,
                'interestAmount'=>$interest,
                'payBackAmount'=>$payBackAmount,
                'balance'=>$payBackAmount,
                'loanType'=>$request->completePaymentWith,
                'userType'=>'non member',
                'group_id'=>$request->group_id,
                'user_id'=>$request->user_id,
            ])
    
            ;
    
            $totalSavings = DB::table('total_savings')
            ->select('total_savings.*')
            ->where('total_savings.group_id',$request->group_id)
            ->get()
            ;
    
            if($request->completePaymentWith === 'savings'){
    
                if(count($totalSavings)){
    
                    $newSavings = $totalSavings[0]->savings - $request->givenAmount;
                    $newWelfare= $totalSavings[0]->welfare;
                    $newDisaster= $totalSavings[0]->disaster;
                    $newShares = $totalSavings[0]->shares;
                    $newInterest = $totalSavings[0]->interest + $totalInterest;
                    $newSharesInterest = $totalSavings[0]->sharesInterest;
                    if($totalSavings[0]->savings < $request->givenAmount){
                        return redirect('/loans/approve-loan-request/'.'{{ $id }}')->with('errorMessage','Sorry!, you have insufficient balance on your savings account to complete this transaction');
                    }
    
                    $loanIssuing = DB::table('total_savings')
                    ->upsert(
                    [
                        'savings'=>$newSavings,
                        'welfare'=>$newWelfare,
                        'disaster'=>$newDisaster,
                        'shares'=>$newShares,
                        'interest'=>$newInterest,
                        'sharesInterest'=>$newSharesInterest,
                        'group_id'=>$request->group_id,
                
                    ],
                    ['group_id'],
                    ['savings','interest']
                    )
                    ;
                }
    
            }
    
    
            if($request->completePaymentWith === 'shares'){
    
                if(count($totalSavings)){

                    $newSavings = $totalSavings[0]->savings;
                    $newWelfare= $totalSavings[0]->welfare;
                    $newDisaster= $totalSavings[0]->disaster;
                    $newShares = $totalSavings[0]->shares  - $request->givenAmount;
                    $newInterest = $totalSavings[0]->interest;
                    $newSharesInterest = $totalSavings[0]->sharesInterest + $totalInterest;

                    if($request->givenAmount > $totalSavings[0]->shares){
                        return redirect('/loans/approve-loan-request/'.'{{ $id }}')->with('errorMessage','Sorry!, you have insufficient balance on your shares account to complete this transaction');
                    }
        
                    $loanIssuing = DB::table('total_savings')
                    ->upsert(
                    [
                        'savings'=>$newSavings,
                        'welfare'=>$newWelfare,
                        'disaster'=>$newDisaster,
                        'shares'=>$newShares,
                        'interest'=>$newInterest,
                        'sharesInterest'=>$newSharesInterest,
                        'group_id'=>$request->group_id,
                
                    ],
                    ['group_id'],
                    ['savings','sharesInterest']
                    )
                    ;
        
                }
    
    
    }
    

        });
  
        



            // return redirect(route('loans.approval',['id'=>$id]))->with('success','You have successfully given a loan of {$request->givenAmount} Shs payable on the {$dueDate}');
    }
    public function handleMembersApproval(Request $request){
        
            // dd($request->all());
            if($request->completePaymentWith === 'welfare')
            {
                $interestRate=0;
                $interest = 0;
                $totalInterest = 0;
                $payBackAmount = $request->givenAmount + $totalInterest;
                $sequentialPayment = $payBackAmount / ($request->paymentSequence * $request->paymentPeriod);
                
            }else{
                $interestRate=$request->interestRate / 100;
                $interest = $interestRate * $request->givenAmount;
                $totalInterest = $interest * $request->paymentPeriod;
                $payBackAmount = $request->givenAmount + $totalInterest;
                $sequentialPayment = $payBackAmount / ($request->paymentSequence * $request->paymentPeriod);
            }
    
            if($request->paymentSequence === $request->paymentPeriod){
                $sequentialPayment = $payBackAmount;
            }
    
            $loanIssuingDate = Carbon::now();
            $dueDate = $loanIssuingDate->copy()->addDays($request->paymentPeriod * 30);
            $id=$request->id;
            DB::transaction( function() use($request,$interestRate,
            $interest,
            $totalInterest,
            $payBackAmount,
            $sequentialPayment,
            $loanIssuingDate,
            $dueDate,
            $id){
    
                $loanApproval = DB::table('loans')
                ->insert([
                    'loanAmount'=>$request->givenAmount,
                    'issueDate'=>$loanIssuingDate,
                    'dueDate'=>$dueDate,
                    'interestRate'=>$interestRate,
                    'interestAmount'=>$interest,
                    'payBackAmount'=>$payBackAmount,
                    'balance'=>$payBackAmount,
                    'loanType'=>$request->completePaymentWith,
                    'userType'=>'member',
                    'group_id'=>$request->group_id,
                    'user_id'=>$request->user_id,
                ])
        
                ;
        
                $totalSavings = DB::table('total_savings')
                ->select('total_savings.*')
                ->where('total_savings.group_id',$request->group_id)
                ->get()
                ;
        
                if($request->completePaymentWith === 'savings'){
        
                    if(count($totalSavings)){
        
                        $newSavings = $totalSavings[0]->savings - $request->givenAmount;
                        $newWelfare= $totalSavings[0]->welfare;
                        $newDisaster= $totalSavings[0]->disaster;
                        $newShares = $totalSavings[0]->shares;
                        $newInterest = $totalSavings[0]->interest + $totalInterest;
                        $newSharesInterest = $totalSavings[0]->sharesInterest;
                        if($totalSavings[0]->savings < $request->givenAmount){
                            return redirect('/loans/approve-loan-request/'.'{{ $id }}')->with('errorMessage','Sorry!, you have insufficient balance on your savings account to complete this transaction');
                        }
        
                        $loanIssuing = DB::table('total_savings')
                        ->upsert(
                        [
                            'savings'=>$newSavings,
                            'welfare'=>$newWelfare,
                            'disaster'=>$newDisaster,
                            'shares'=>$newShares,
                            'interest'=>$newInterest,
                            'sharesInterest'=>$newSharesInterest,
                            'group_id'=>$request->group_id,
                    
                        ],
                        ['group_id'],
                        ['savings','interest']
                        )
                        ;
                    }
        
                }

                if($request->completePaymentWith === 'savings'){
        
                    if(count($totalSavings)){
        
                        $newSavings = $totalSavings[0]->savings - $request->givenAmount;
                        $newWelfare= $totalSavings[0]->welfare;
                        $newDisaster= $totalSavings[0]->disaster;
                        $newShares = $totalSavings[0]->shares;
                        $newInterest = $totalSavings[0]->interest + $totalInterest;
                        $newSharesInterest = $totalSavings[0]->sharesInterest;
                        if($totalSavings[0]->savings < $request->givenAmount){
                            return redirect('/loans/approve-loan-request/'.'{{ $id }}')->with('errorMessage','Sorry!, you have insufficient balance on your savings account to complete this transaction');
                        }
        
                        $loanIssuing = DB::table('total_savings')
                        ->upsert(
                        [
                            'savings'=>$newSavings,
                            'welfare'=>$newWelfare,
                            'disaster'=>$newDisaster,
                            'shares'=>$newShares,
                            'interest'=>$newInterest,
                            'sharesInterest'=>$newSharesInterest,
                            'group_id'=>$request->group_id,
                    
                        ],
                        ['group_id'],
                        ['savings','interest']
                        )
                        ;
                    }
        
                }  
                
                if($request->completePaymentWith === 'welfare'){
        
                    if(count($totalSavings)){
        
                        $newSavings = $totalSavings[0]->savings;
                        $newWelfare= $totalSavings[0]->welfare - $request->givenAmount;
                        $newDisaster= $totalSavings[0]->disaster;
                        $newShares = $totalSavings[0]->shares;
                        $newInterest = $totalSavings[0]->interest;
                        $newSharesInterest = $totalSavings[0]->sharesInterest;
                        if($totalSavings[0]->savings < $request->givenAmount){
                            return redirect('/loans/approve-loan-request/'.'{{ $id }}')->with('errorMessage','Sorry!, you have insufficient balance on your welfare account to complete this transaction');
                        }
        
                        $loanIssuing = DB::table('total_savings')
                        ->upsert(
                        [
                            'savings'=>$newSavings,
                            'welfare'=>$newWelfare,
                            'disaster'=>$newDisaster,
                            'shares'=>$newShares,
                            'interest'=>$newInterest,
                            'sharesInterest'=>$newSharesInterest,
                            'group_id'=>$request->group_id,
                    
                        ],
                        ['group_id'],
                        ['savings','interest']
                        )
                        ;
                    }
        
                }
        
        
                if($request->completePaymentWith === 'shares'){
        
                    if(count($totalSavings)){
    
                        $newSavings = $totalSavings[0]->savings;
                        $newWelfare= $totalSavings[0]->welfare;
                        $newDisaster= $totalSavings[0]->disaster;
                        $newShares = $totalSavings[0]->shares  - $request->givenAmount;
                        $newInterest = $totalSavings[0]->interest;
                        $newSharesInterest = $totalSavings[0]->sharesInterest + $totalInterest;
    
                        if($request->givenAmount > $totalSavings[0]->shares){
                            return redirect('/loans/approve-loan-request/'.'{{ $id }}')->with('errorMessage','Sorry!, you have insufficient balance on your shares account to complete this transaction');
                        }
            
                        $loanIssuing = DB::table('total_savings')
                        ->upsert(
                        [
                            'savings'=>$newSavings,
                            'welfare'=>$newWelfare,
                            'disaster'=>$newDisaster,
                            'shares'=>$newShares,
                            'interest'=>$newInterest,
                            'sharesInterest'=>$newSharesInterest,
                            'group_id'=>$request->group_id,
                    
                        ],
                        ['group_id'],
                        ['savings','sharesInterest']
                        )
                        ;
            
                    }
        
                    
        
        }
        
        
    
            });
      
            
    
    
    
                // return redirect(route('loans.approval',['id'=>$id]))->with('success','You have successfully given a loan of {$request->givenAmount} Shs payable on the {$dueDate}');
        
    }

    public function nonMemberRecording(){
        $guarantor = DB::table('users')
        ->join('groups','groups.id' ,'=', 'users.group_id')
        ->select('users.id','users.name')
        ->where('users.group_id',Auth::user()->group_id)
        ->get()
        ;
        return view('addNonMember',['guarantor'=>$guarantor]);
    }
    public function nonMemberDefaulters(){
        return view('nonMemberDefaulters');
    }
    public function defaulters(){

        return view('loanDefaulters');
    }
    public function sendRequest(){
        return view('send-loan-request');
    }
    public function getRequest(Request $request){
        $amount = $request->amount;
        $reason = $request->reason;
        $loanType = $request->loanType;
        $requesting = DB::table('requests')
        ->insert([
            'amount'=>$amount,
            'loanType'=>$loanType,
            'reason'=>$reason,
            'user_id'=>Auth::user()->id
        ])
        ;
        if($requesting){
            return redirect(route('loans.sendRequest'))->with('message','Request sent!');
        }else{
            return redirect(route('loans.sendRequest'))->with('errorMessage','Request not sent!');

        }
    }

    public function memberLoanDetails(){
        $memberDetails = DB::table('loans')
        ->join('groups','loans.group_id', '=', 'groups.id')
        ->join('members','loans.member_id', '=', 'members.id')
        ->select('loans.*','members.surname','members.other_names','groups.*','members.nin')
        ->where('loans.group_id','1')
        ->get()
        ;
        // dd($memberDetails);
        $num=1;
        return view('memberLoanDetails',['memberDetails'=>$memberDetails,'num'=>$num]);
    }

}
