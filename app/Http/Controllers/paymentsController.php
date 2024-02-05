<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Saving;

class paymentsController extends Controller
{

    public function addSavings(Request $request){
        $members = DB::table('users')
        ->join ('groups','groups.id','=','users.group_id')
        ->select('users.name','users.id')
        ->where('users.group_id',Auth::user()->group_id)
        ->where('users.id',Auth::user()->id)
        ->get()
        ;

        $membersWithLoans = DB::table('users')
        ->join ('groups','groups.id','=','users.group_id')
        ->join ('loans','loans.user_id','=','users.id')
        ->select('users.name','users.id','loanAmount')
        ->where('loans.group_id','users.group_id')
        ->where('loans.userType','member')
        ->where('loans.loanStatus','paid')
        ->get()
        ;
        $nonmembers = DB::table('users')
        ->join('groups','groups.id','=','users.group_id')
        ->select('users.name','users.id')
        ->where('users.group_id',Auth::user()->group_id)
        ->where('users.role','non member')
        ->get()
        ;
        // dd($members);
        return view('addSavings',['members'=>$members,'nonmembers'=>$nonmembers,'membersWithLoans'=>$membersWithLoans]);
    }

   
    public function registerSavings(Request $request){

        $data = $request->validate([
            'saved_amount'=>'required',
            'memberId'=>'required'
    ]);
        $results=Saving::create($data);
        ;
        return view('addSavings',['data'=>$data]);
        // return redirect(route('savings.registerSavings'));
    }

    public function transactionProcessing(Request $request){
        $data = $request->validate([
            'contact'=>'required',
            'amount'=>'required || numeric',
            'paymentType'=>'required',
            'payFor'=>'required',
            'userType'=>['string','nullable'],
            'member'=>'string || nullable',
            'nonMember'=>'string || nullable',
            'paymethod'=>'required'
        ]);
// #######################################################################################################################################################################
    if($request->paymentType === 'savings'){
        
    if($request->payFor === 'others'){
            
            $userSaving=DB::table('savings')
            ->select('saved_amount')
            ->where('user_id',$request->member)
            ->where('group_id',Auth::user()->group_id)
            ->get('saved_amount')
            ;
            $user=$request->member;
        }else{
            $userSaving=DB::table('savings')
            ->select('saved_amount')
            ->where('user_id',Auth::user()->id)
            ->get('saved_amount')
            ;
            $user = Auth::user()->id;
       }
       // Addition logic
//  dd($userSaving);
        if(count($userSaving) === 0){
            $arrayValueAtIndex0=0;
            $amountArray=[$arrayValueAtIndex0,$request->amount];
            $amount = array_sum($amountArray);
        }else{
            $arrayValueAtIndex0=$userSaving[0]->saved_amount;
            $amountArray=[$arrayValueAtIndex0,$request->amount];
            $amount = array_sum($amountArray);
        }

    }
    
    // dd($arrayValueAtIndex0);
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------    
      
if($request->paymentType === 'welfare'){
    if($request->payFor === 'others'){
            
        $welfareSaving=DB::table('welfare')
        ->select('welfare_paid')
        ->where('user_id',$request->member)
        ->get('welfare_paid')
        ;
        $user=$request->member;
    }else{
        $welfareSaving=DB::table('welfare')
        ->select('welfare_paid')
        ->where('user_id',Auth::user()->id)
        ->get('welfare_paid')
        ;
        $user = Auth::user()->id;
   }
   // Addition logic
    if(count($welfareSaving) === 0){
        $arrayValueAtIndex0=0;
        $amountArray=[$arrayValueAtIndex0,$request->amount];
        $welfareAmount = array_sum($amountArray);
    }else{
        $arrayValueAtIndex0=$welfareSaving[0]->welfare_paid;
        $amountArray=[$arrayValueAtIndex0,$request->amount];
        $welfareAmount = array_sum($amountArray);
    }
}


//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------    
      
if($request->paymentType === 'shares'){
    if($request->payFor === 'others'){
            
        $shareSaving=DB::table('shares')
        ->select('shareAmount')
        ->where('user_id',$request->member)
        ->get('shareAmount')
        ;
        $user=$request->member;
    }else{
        $shareSaving=DB::table('shares')
        ->select('shareAmount')
        ->where('user_id',Auth::user()->id)
        ->get('shareAmount')
        ;
        $user = Auth::user()->id;
   }
   // Addition logic
    if(count($shareSaving) === 0){
        $arrayValueAtIndex0=0;
        $amountArray=[$arrayValueAtIndex0,$request->amount];
        $shareAmountInTotal = array_sum($amountArray);
    }else{
        $arrayValueAtIndex0=$shareSaving[0]->shareAmount;
        $amountArray=[$arrayValueAtIndex0,$request->amount];
        $shareAmountInTotal = array_sum($amountArray);
    }
}


//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------    
      
if($request->paymentType === 'disaster'){
    if($request->payFor === 'others'){
            
        $disasterSaving=DB::table('disaster')
        ->select('disaster_amount_paid')
        ->where('user_id',$request->member)
        ->get('disaster_amount_paid')
        ;
        $user=$request->member;
    }else{
        $disasterSaving=DB::table('disaster')
        ->select('disaster_amount_paid')
        ->where('user_id',Auth::user()->id)
        ->get('disaster_amount_paid')
        ;
        $user = Auth::user()->id;
   }
   // Addition logic
    if(count($disasterSaving) === 0){
        $arrayValueAtIndex0=0;
        $amountArray=[$arrayValueAtIndex0,$request->amount];
        $disasterAmountInTotal = array_sum($amountArray);
    }else{
        $arrayValueAtIndex0=$welfareSaving[0]->disaster_amount_paid;
        $amountArray=[$arrayValueAtIndex0,$request->amount];
        $disasterAmountInTotal = array_sum($amountArray);
    }
}



//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------    
      
if($request->paymentType === 'loans'){
    if($request->payFor === 'others'){
            
        $loanSaving=DB::table('loans')
        ->select('payBackAmount')
        ->where('user_id',$request->member)
        ->get('payBackAmount')
        ;
        $user=$request->member;
    }else{
        $loanSaving=DB::table('loans')
        ->select('payBackAmount')
        ->where('user_id',Auth::user()->id)
        ->get('payBackAmount')
        ;
        $user = Auth::user()->id;
   }
   // Addition logic
    if(count($loanSaving)){
        $arrayValueAtIndex0=$loanSaving[0]->payBackAmount;
        // $amountArray=[$arrayValueAtIndex0,$request->amount];
        $remainingLoanAmountInTotal = ($arrayValueAtIndex0 - $request->amount);
    }else{
        return redirect(route('savings.addSavings'))->with('errormessage','You do not have a pending loan on savings');
    }
}


      
if($request->paymentType === 'welfare loan-repayment'){
    if($request->payFor === 'others'){
            
        $loanSaving=DB::table('loans')
        ->select('payBackAmount')
        ->where('user_id',$request->member)
        ->where('loanType','welfare')
        ->get('payBackAmount')
        ;
        $user=$request->member;
    }else{
        $loanSaving=DB::table('loans')
        ->select('payBackAmount')
        ->where('user_id',Auth::user()->id)
        ->where('loanType','welfare')
        ->get('payBackAmount')
        ;
        $user = Auth::user()->id;
   }
   // Addition logic
    if(count($loanSaving)){
        $arrayValueAtIndex0=$loanSaving[0]->payBackAmount;
        // $amountArray=[$arrayValueAtIndex0,$request->amount];
        $remainingLoanAmountInTotal = ($arrayValueAtIndex0 - $request->amount);
    }else{
        return redirect(route('savings.addSavings'))->with('errorMessage','You do not have a pending welfare loan');
    }
}

// dd($remainingLoanAmountInTotal);

        
// #############################################################################################################################################################
    
            if($request->paymentType === 'savings'){
                DB::transaction( function() use ($request,$amount,$user){
               DB::table('transactions')
               ->insert([
                   'transactionType'=>$request->paymentType,
                   'amount'=>$request->amount,
                   'user_id'=>Auth::user()->id,
                   'group_id'=>Auth::user()->group_id
               ])
               ;
               DB::table('savings')
               ->upsert(['saved_amount'=>($amount), 'user_id'=>$user, 'group_id'=>Auth::user()->group_id],['user_id'],['saved_amount'])
               ;

               $totalSavings = DB::table('total_savings')
               ->select('total_savings.*')
               ->where('total_savings.group_id',Auth::user()->group_id)
               ->get()
               ;
               
               if(count($totalSavings)){

                   $newSavings = $totalSavings[0]->savings + $request->amount;
                   $newWelfare= $totalSavings[0]->welfare;
                   $newDisaster= $totalSavings[0]->disaster;
                   $newShares = $totalSavings[0]->shares;
                   $newInterest = $totalSavings[0]->interest;
                   $newSharesInterest = $totalSavings[0]->sharesInterest;
    
       
               }else{
                $newSavings = $request->amount;
                $newWelfare= 0;
                $newDisaster= 0;
                $newShares = 0;
                $newInterest = 0;
                $newSharesInterest = 0;
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
                               'group_id'=>Auth::user()->group_id,
                       
                           ],
                           ['group_id'],
                           ['savings']
                           )
                           ;

               });


            }
 // ##############################################################################################################################################################

            //    welfare transactions

       
               if($request->paymentType === 'welfare'){
                DB::transaction( function() use($request,$welfareAmount,$user){

                    DB::table('transactions')
                    ->insert([
                        'transactionType'=>$request->paymentType,
                        'amount'=>$request->amount,
                        'user_id'=>Auth::user()->id,
                        'group_id'=>Auth::user()->group_id
                    ])
                    ;
                    DB::table('welfare')
                    ->upsert(['welfare_paid'=>$welfareAmount, 'user_id'=>$user, 'group_id'=>Auth::user()->group_id],
                    ['user_id'],
                    ['welfare_paid'])
                    ;

                    $totalSavings = DB::table('total_savings')
                    ->select('total_savings.*')
                    ->where('total_savings.group_id',Auth::user()->group_id)
                    ->get()
                    ;


    
                    if(count($totalSavings)){

                        $newSavings = $totalSavings[0]->savings;
                        $newWelfare= $totalSavings[0]->welfare + $request->amount;
                        $newDisaster= $totalSavings[0]->disaster;
                        $newShares = $totalSavings[0]->shares;
                        $newInterest = $totalSavings[0]->interest;
                        $newSharesInterest = $totalSavings[0]->sharesInterest;
         
            
                    }else{
                     $newSavings = 0;
                     $newWelfare= $request->amount;
                     $newDisaster= 0;
                     $newShares = 0;
                     $newInterest = 0;
                     $newSharesInterest = 0;
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
                'group_id'=>Auth::user()->group_id,
        
            ],
            ['group_id'],
            ['welfare']
            )
            ;
                });
            
            }
 // ##############################################################################################################################################################
            // Shares transactions
            if($request->paymentType === 'shares'){
                DB::transaction( function() use($request,$shareAmountInTotal,$user){

                    DB::table('transactions')
                    ->insert([
                        'transactionType'=>$request->paymentType,
                        'amount'=>$request->amount,
                        'user_id'=>$user,
                        'group_id'=>Auth::user()->group_id
                    ])
                    ;
                    DB::table('shares')
                    ->upsert(['shareAmount'=>($shareAmountInTotal), 'user_id'=>$user, 'group_id'=>Auth::user()->group_id],
                    ['user_id'],['shareAmount'])
                    ;
    
                    
                    $totalSavings = DB::table('total_savings')
                    ->select('total_savings.*')
                    ->where('total_savings.group_id',Auth::user()->group_id)
                    ->get()
                    ;
    
    
    
                    if(count($totalSavings)){

                        $newSavings = $totalSavings[0]->savings;
                        $newWelfare= $totalSavings[0]->welfare;
                        $newDisaster= $totalSavings[0]->disaster;
                        $newShares = $totalSavings[0]->shares + $request->amount;
                        $newInterest = $totalSavings[0]->interest;
                        $newSharesInterest = $totalSavings[0]->sharesInterest;
         
            
                    }else{
                     $newSavings = 0;
                     $newWelfare= 0;
                     $newDisaster= 0;
                     $newShares = $request->amount;
                     $newInterest = 0;
                     $newSharesInterest = 0;
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
                'group_id'=>Auth::user()->group_id,
        
            ],
            ['group_id'],
            ['shares']
            )
            ;
        });
        return redirect(route('savings.addSavings'))->with('message','Transaction successful');
                
            }

// ##############################################################################################################################################################
            // disaster and preparedness payment
            if($request->paymentType === 'disaster'){
                DB::transaction( function() use($request,$disasterAmountInTotal,$user){

                    DB::table('transactions')
                    ->insert([
                        'transactionType'=>$request->paymentType,
                        'amount'=>$request->amount,
                        'user_id'=>$user,
                        'group_id'=>Auth::user()->group_id
                    ])
                    ;
                    DB::table('disaster')
                    ->upsert(['disaster_amount_paid'=>($disasterAmountInTotal), 'user_id'=>$user, 'group_id'=>Auth::user()->group_id],
                    ['user_id'],
                    ['disaster_amount_paid'])
                    ;

                    
                    $totalSavings = DB::table('total_savings')
                    ->select('total_savings.*')
                    ->where('total_savings.group_id',Auth::user()->group_id)
                    ->get()
                    ;


    
                    if(count($totalSavings)){

                        $newSavings = $totalSavings[0]->savings;
                        $newWelfare= $totalSavings[0]->welfare;
                        $newDisaster= $totalSavings[0]->disaster + $request->amount;
                        $newShares = $totalSavings[0]->shares;
                        $newInterest = $totalSavings[0]->interest;
                        $newSharesInterest = $totalSavings[0]->sharesInterest;
         
            
                    }else{
                     $newSavings =0;
                     $newWelfare= 0;
                     $newDisaster= $request->amount;
                     $newShares = 0;
                     $newInterest = 0;
                     $newSharesInterest = 0;
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
                'group_id'=>Auth::user()->group_id,
        
            ],
            ['group_id'],
            ['disaster']
            )
            ;
                });
                return redirect(route('savings.addSavings'))->with('message','Transaction successful');
            }
 // ##############################################################################################################################################################           
            // loans repayment
            if($request->paymentType === 'loans'){
                DB::transaction( function() use($request,$remainingLoanAmountInTotal,$user){

                    DB::table('transactions')
                    ->insert([
                        'transactionType'=>$request->paymentType,
                        'amount'=>$request->amount,
                        'user_id'=>$user,
                        'group_id'=>Auth::user()->group_id
                    ])
                    ;
                    DB::table('loans')
                    ->where('user_id',$user)
                    ->update(['balance' => $remainingLoanAmountInTotal])
                    ;

                    
                    $totalSavings = DB::table('total_savings')
                    ->select('total_savings.*')
                    ->where('total_savings.group_id',Auth::user()->group_id)
                    ->get()
                    ;


    
                    if(count($totalSavings)){

                        $newSavings = $totalSavings[0]->savings + $request->amount;
                        $newWelfare= $totalSavings[0]->welfare;
                        $newDisaster= $totalSavings[0]->disaster;
                        $newShares = $totalSavings[0]->shares;
                        $newInterest = $totalSavings[0]->interest;
                        $newSharesInterest = $totalSavings[0]->sharesInterest;
         
            
                    }else{
                     $newSavings = $request->amount;
                     $newWelfare= 0;
                     $newDisaster= 0;
                     $newShares = 0;
                     $newInterest = 0;
                     $newSharesInterest = 0;
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
                'group_id'=>Auth::user()->group_id,
        
            ],
            ['group_id'],
            ['savings']
            )
            ;
                });
                
            }
            return redirect(route('savings.addSavings'))->with('message','Transaction successful');
            // });
        //    return redirect(route('savings.addSavings'))->with('error','Sorry, Transaction failed');
    }

    public function withdrawals(){

        return view('withdrawal');
    }

    public function confirmPasswordToWithdraw(Request $request){
        $request->validateWithBag('userWithdrawal', [
            'password' => ['required', 'current_password'],
        ]);

        $verifiedUser = $request->user();
        if($verifiedUser){
            DB::table('users')
            ->where('id',Auth::user()->id)
            ->update(['verified'=>1])
            ;
        }
  
        
            return redirect(route('savings.verified'))->with('verifiedUserId',$verifiedUser);
       

    }

    public function verifiedAccount(){
        return view('verified');
    }

    public function withdraw(Request $request){
        $data=$this->sharedFunction();
        $savingsAmount = $data['savingsAmount'];
        $totalInterestAmount = $data['totalInterestAmount'];
        $totalSavingsAmount = $data['totalSavingsAmount'];
        $totalWelfareAmount = $data['totalWelfareAmount'];
        $welfareAmount = $data['welfareAmount'];
        $shareAmount = $data['shareAmount'];
        $interestShare = $data['interestShare'];
        $totalSharesAmount = $data['totalSharesAmount'];
        $totalSharesInterestAmount = $data['totalSharesInterestAmount'];
        $withdrawableAmount = $data['withdrawableAmount'];


        $remainingBalanceAfterWithdrawal = $savingsAmount - $request->amount;
        $remainingTotalBalanceAfterWithdrawal = $totalSavingsAmount - $request->amount;
        $remainingInterestBalanceAfterWithdrawal = $totalInterestAmount - $interestShare;
        $remainingTotalWelfareBalanceAfterWithdrawal = $totalWelfareAmount - $request->amount;
        $remainingWelfareBalanceAfterWithdrawal = $welfareAmount - $request->amount;
        $remainingShareBalanceAfterWithdrawal = $shareAmount - $request->amount;
        $remainingTotalShareBalanceAfterWithdrawal = $totalSharesAmount - $request->amount;
        $remainingShareInterestBalanceAfterWithdrawal = $totalSharesInterestAmount - $request->amount;
        


        if($request->accounts === 'savings'){
            if($withdrawableAmount <= 0 || $request->amount > $withdrawableAmount){
                return redirect(route('savings.verified'))->with('errorMessage','You have insufficient balance to withdraw');
            }
            DB::transaction(function() use($remainingBalanceAfterWithdrawal,$remainingTotalBalanceAfterWithdrawal,$remainingInterestBalanceAfterWithdrawal) {
            DB::table('savings')
            ->where('user_id',Auth::user()->id)
            ->update(['saved_amount' => $remainingBalanceAfterWithdrawal])
            ;
            DB::table('total_savings')
            ->where('group_id',Auth::user()->group_id)
            ->update(['savings' => $remainingTotalBalanceAfterWithdrawal])
            ;
            DB::table('total_savings')
            ->where('group_id',Auth::user()->group_id)
            ->update(['interest' => $remainingInterestBalanceAfterWithdrawal])
            ;
            });
                return redirect(route('savings.verified'))->with('message','You have withdrawn '.$request->amount . ' UGX successfully');

        }
        if($request->accounts === 'welfare'){
             if($welfareAmount < $request->amount){
                return redirect(route('savings.verified'))->with('errorMessage','You have insufficient balance to withdraw');
            }
            DB::transaction(function() use($remainingTotalWelfareBalanceAfterWithdrawal,$remainingWelfareBalanceAfterWithdrawal) {
                DB::table('welfare')
                ->where('user_id',Auth::user()->id)
                ->update(['welfare_paid' => $remainingWelfareBalanceAfterWithdrawal])
                ;
                DB::table('total_savings')
                ->where('group_id',Auth::user()->group_id)
                ->update(['welfare' => $remainingTotalWelfareBalanceAfterWithdrawal])
                ;
            
                });
                return redirect(route('savings.verified'))->with('message','You have withdrawn '.$request->amount . ' UGX successfully');

        }
        if($request->accounts === 'shares'){
            
            if($withdrawableShareAmount <= 0 || $request->amount > $withdrawableShareAmount){
                return redirect(route('savings.verified'))->with('errorMessage','You have insufficient balance to withdraw');
            }
            DB::transaction(function() use($remainingShareBalanceAfterWithdrawal,$remainingTotalShareBalanceAfterWithdrawal,$remainingShareInterestBalanceAfterWithdrawal) {
                DB::table('shares')
                ->where('user_id',Auth::user()->id)
                ->update(['shareAmount' => $remainingShareBalanceAfterWithdrawal])
                ;
                DB::table('total_savings')
                ->where('group_id',Auth::user()->group_id)
                ->update(['shares' => $remainingTotalShareBalanceAfterWithdrawal])
                ;
                DB::table('total_savings')
                ->where('group_id',Auth::user()->group_id)
                ->update(['sharesInterest' => $remainingShareInterestBalanceAfterWithdrawal])
                ;
                });
                return redirect(route('savings.verified'))->with('message','You have withdrawn '.$request->amount . ' UGX successfully');

        }


    }

}
