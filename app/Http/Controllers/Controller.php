<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function sharedFunction(){
        if(Auth::user()){
        $savings = DB::table('savings')
        ->join('users','users.id','=','savings.user_id')
        ->join('groups','groups.id','=','savings.group_id')
        ->select('saved_amount')
        ->where('users.id', Auth::user()->id)
        ->get()
        ;
        $welfare = DB::table('welfare')
        ->join('users','users.id','=','welfare.user_id')
        ->join('groups','groups.id','=','welfare.group_id')
        ->select('welfare_paid')
        ->where('users.id', Auth::user()->id)
        ->get()
        ;
        $shares = DB::table('shares')
        ->join('users','users.id','=','shares.user_id')
        ->join('groups','groups.id','=','shares.group_id')
        ->select('shareAmount')
        ->where('users.id', Auth::user()->id)
        ->get()
        ;
        $totalSavings = DB::table('total_savings')
        ->join('groups','groups.id','=','total_savings.group_id')
        ->select('total_savings.*')
        ->where('total_savings.group_id',Auth::user()->group_id)
        ->get()
        ;
        if(count($shares)){
            $shareAmount = $shares[0]->shareAmount;
        }else{
            $shareAmount = 0;

        }
        if(count($welfare)){
            $welfareAmount = $welfare[0]->welfare_paid;
        }else{
            $welfareAmount = 0;

        }
        if(count($savings)){
            $savingsAmount = $savings[0]->saved_amount;
        }else{
            $savingsAmount = 0;

        }
        if(count($totalSavings)){
            $totalSavingsAmount=$totalSavings[0]->savings;
            $totalSharesAmount=$totalSavings[0]->shares;
            $totalWelfareAmount=$totalSavings[0]->welfare;
            $totalInterestAmount=$totalSavings[0]->interest;
            $totalSharesInterestAmount=$totalSavings[0]->sharesInterest;
        }else{
            $totalSavingsAmount=0.00;
            $totalSharesAmount=0.00;
            $totalWelfareAmount=0.00;
            $totalInterestAmount=0.00;
            $totalSharesInterestAmount=0.00;
        }
        $totalRation = $totalSavingsAmount + $totalInterestAmount;
        $totalSharesRation = $totalSharesAmount + $totalSharesInterestAmount;
        if($savingsAmount > 0){

            $interestShare = ( $savingsAmount / $totalRation ) * $totalInterestAmount;
        }else{
            $interestShare = 0;
        }
        if($shareAmount > 0){

            $sharesInterest = ( $shareAmount / $totalSharesRation ) * $totalSharesInterestAmount;
        }else{
            $sharesInterest = 0;
        }
        $withdrawableAmount = $savingsAmount + $interestShare;
        $withdrawableShareAmount = $shareAmount + $sharesInterest;

        return ['interest'=>$interestShare,'savingsAmount'=>$savingsAmount,'welfareAmount'=>$welfareAmount,'shareAmount'=>$shareAmount,'totalSavingsAmount'=>$totalSavingsAmount,
        'totalSharesAmount'=>$totalSharesAmount,
        'totalWelfareAmount'=>$totalWelfareAmount,
        'totalInterestAmount'=>$totalInterestAmount,
        'totalSharesInterestAmount'=>$totalSharesInterestAmount,
        'totalRation'=>$totalRation,
        'totalSharesRation'=>$totalSharesRation,
        'interestShare'=>$interestShare,
        'sharesInterest'=>$sharesInterest,
        'withdrawableAmount'=>$withdrawableAmount,
        'withdrawableShareAmount'=>$withdrawableShareAmount];
    }
    }

}
