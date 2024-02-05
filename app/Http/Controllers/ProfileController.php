<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Member;
use App\Models\Groups;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

     public function home(): View
     {
        $id=Auth::user()->id;
        
        // $data = $data->intersect(Post::whereIn('user_id', $id)->get());
        $data = Member::addSelect(['group_name'=>Groups::select('group_name')
        ->whereColumn('group_id','groups.id')
    ])->get();
        // $data = Post::where('user_id',$id)->get(['id','post']);
        return view('welcome',['data'=>$data]);
     }
    
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
