<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Saving;

class SavingsController extends Controller
{
    public function index(){
        $savings = DB::table('savings')
        ->select('saved_amount')
        ->where('savings.user_id',Auth::user()->id)
        ->get()
        ;
        $welfare = DB::table('welfare')
        ->select('welfare_paid')
        ->where('welfare.user_id',Auth::user()->id)
        ->get()
        ;
        $disaster = DB::table('disaster')
        ->select('disaster_amount_paid')
        ->where('disaster.user_id',Auth::user()->id)
        ->get()
        ;
        $shares = DB::table('shares')
        ->select('shareAmount')
        ->where('shares.user_id',Auth::user()->id)
        ->get()
        ;
        $transactionsHistory = DB::table('transactions')
        ->select('transactions.*')
        ->where('transactions.user_id',Auth::user()->id)
        ->orderByRaw('created_at DESC')
        ->get()
        ;
        $guarantee = DB::table('_non_members_loans')
        ->join('loans','loans.user_id','=','_non_members_loans.user_id')
        ->select('_non_members_loans.firstName','_non_members_loans.lastName','loans.payBackAmount','loans.balance','loans.issueDate','loans.dueDate','loans.loanStatus')
        ->where('_non_members_loans.user_id',Auth::user()->id)
        ->get()
        ;
        $welfareLoans = DB::table('users')
        ->join('loans','loans.user_id','=','users.id')
        ->select('loans.payBackAmount','loans.balance','loans.issueDate','loans.dueDate','loans.loanStatus','loans.loanAmount')
        ->where('users.id',Auth::user()->id)
        ->where('loans.loanType','welfare')
        ->where('loans.user_id',Auth::user()->id)
        ->get()
        ;
        $loans = DB::table('users')
        ->join('loans','loans.user_id','=','users.id')
        ->select('loans.payBackAmount','loans.balance','loans.issueDate','loans.dueDate','loans.loanStatus','loans.loanAmount')
        ->where('users.id',Auth::user()->id)
        ->where('loans.loanType','savings')
        ->where('loans.user_id',Auth::user()->id)
        ->get()
        ;
        if(count($savings)){
            $totalIndividualSavings = $savings[0];
        }else{
            $totalIndividualSavings=0;

        }

        
        $sharedVariables = $this->sharedFunction();
        $interest = $sharedVariables['interest'];
        $withdrawableAmount = $sharedVariables['withdrawableAmount'];
        // dd($welfareLoans);

        return view('savings',['totalIndividualSavings'=>$totalIndividualSavings,
        'interest'=>$interest,'withdrawableAmount'=>$withdrawableAmount,
        'transactionsHistory'=>$transactionsHistory,'guarantee'=>$guarantee,'welfareLoans'=>$welfareLoans,
        'loans'=>$loans,'savings'=>$savings,'welfare'=>$welfare,'disaster'=>$disaster,'shares'=>$shares]);
    }
 
    //Savings Details
    public function savingDetails(){
        // $details = DB::table('members')
        // ->join('groups', 'groups.id' , '=', 'members.group_id')
        // ->join('savings', 'savings.member_id' , '=', 'members.id')
        // ->where('members.group_id' ,2)
        // ->where( 'members.status','active')
        // ->where( 'members.id',6)
        // ->select('members.id','members.surname','members.other_names','savings.saved_amount')
        // ->get()
        // ;
        // $total = DB::table('members')
        // ->join('groups', 'groups.id' , '=', 'members.group_id')
        // ->join('savings', 'savings.member_id' , '=', 'members.id')
        // ->where('members.group_id' ,2)
        // ->where( 'members.status','active')
        // ->where( 'members.id',6)
        // ->select('savings.saved_amount')
        // ->get()
        // ;
        // $num=1;
        // $names=DB::table('members')
        // ->select('members.surname','members.other_names')
        // ->where('members.id',6)
        // ->get();
      
        $fig=[1,2,3,4];
        // $tot=array_sum($fig);
        
        return view('savingsDetails');
    }
    }
