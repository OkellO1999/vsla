<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disaster;

class DisasterController extends Controller
{
    public function index(){
        return view('disaster');
    }
}
