<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    public function addGroups(){
        return view('registerGroups');
    }
    public function addGroupAdmin(){
        $groups = DB::table('groups')
        ->select('groups.*')
        ->get()
        ;
        return view('addUser',['groups'=>$groups]);
    }
    public function saveAddedGroup(Request $request){
        $data = $request->all();
        $save = DB::table('groups')
        ->insert([
            'group_name'=>$request->group_name,
            'location'=>$request->location,
            'description'=>$request->description
        ])
        ;
        if($save){
            return redirect(route('groups.addGroups'))->with('message', 'Group Added successfully!');
        }else{
            return redirect(route('groups.addGroups'))->with('errorMessage', 'Group not added, Please contact your system admin!');
        }
    }
    public function saveAddedGroupAdmin(Request $request){
        $password = Hash::make($request->lastname.'@'.random_int(100,1000));
        // dd($password);
        $save = DB::table('users')
        ->insert([
            'name'=>$request->surname. ' ' .$request->lastname. ' ' .$request->other_names,
            'email'=>$request->email,
            'password'=>$password,
            'nin'=>$request->nin,
            'contact'=>$request->contact,
            'village'=>$request->village,
            'parish'=>$request->parish,
            'sub-county'=>$request->subCounty,
            'district'=>$request->district,
            'role'=>'admin',
            'status'=>'Active',
            'group_id'=>$request->group
        ])
        ;
        if($save){
            return redirect(route('groups.addGroupAdmin'))->with('message', 'User Added successfully!');
        }else{
            return redirect(route('groups.addGroupAdmin'))->with('errorMessage', 'User not added, Please contact your system admin!');
        }

    }
    public function saveGroupLeader(Request $request){
        $password = Hash::make($request->lastname.'@'.random_int(100,1000));
        // dd($password);
        $save = DB::table('users')
        ->insert([
            'name'=>$request->surname. ' ' .$request->lastname. ' ' .$request->other_names,
            'email'=>$request->email,
            'password'=>$password,
            'nin'=>$request->nin,
            'contact'=>$request->contact,
            'village'=>$request->village,
            'parish'=>$request->parish,
            'sub-county'=>$request->subCounty,
            'district'=>$request->district,
            'role'=>$request->role,
            'status'=>'Active',
            'group_id'=>Auth::user()->group_id
        ])
        ;
        if($save){
            return redirect(route('groups.saveGroupLeaders'))->with('message', 'User Added successfully!');
        }else{
            return redirect(route('groups.saveGroupLeaders'))->with('errorMessage', 'User not added, Please contact your system admin!');
        }

    }
    public function saveMember(Request $request){
        $password = Hash::make($request->lastname.'@'.random_int(100,1000));
        // dd($password);
        $save = DB::table('users')
        ->insert([
            'name'=>$request->surname. ' ' .$request->lastname. ' ' .$request->other_names,
            'email'=>$request->email,
            'password'=>$password,
            'nin'=>$request->nin,
            'contact'=>$request->contact,
            'village'=>$request->village,
            'parish'=>$request->parish,
            'sub-county'=>$request->subCounty,
            'district'=>$request->district,
            'role'=>'member',
            'status'=>'Active',
            'group_id'=>Auth::user()->group_id
        ])
        ;
        if($save){
            return redirect(route('admin.register'))->with('message', 'User Added successfully!');
        }else{
            return redirect(route('admin.register'))->with('errorMessage', 'User not added, Please contact your system admin!');
        }

    }
    public function registration(){
        return view('addMembers');
    }
    public function groupLeaders(){
        return view('addGroupLeaders');
    }
}
