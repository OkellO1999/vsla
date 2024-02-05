<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class settingsController extends Controller
{
    public function settings(){
        return view('settings');
    }
    public function saveSettings(Request $request){
        $settings = DB::table('settings')
        ->insert([
            'welfareDefaultAmount'=>$request->welfare,
            'disasterDefaultAmount'=>$request->disaster,
            'sharesDefaultAmount'=>$request->shares,
            'membersLoanInterestRate'=>$request->members_rate,
            'nonMembersInterestRate'=>$request->non_members_rate,
            'guarantorPayRate'=>$request->guarantor_rate,
            'group_id'=>Auth::user()->group_id
        ])
        ;
        if($settings){
            return redirect(route('settings.index'))->with('message','Settings Saved!');
        }else{
            return redirect(route('settings.index'))->with('errorMessage','Settings not Saved!');

        }
    }
}
