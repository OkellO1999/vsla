<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Loan;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index(){
        $members=Member::all();
        $loans=Loan::all();
        return view('members',['members'=>$members, 'loans'=>$loans]);
    }

}
