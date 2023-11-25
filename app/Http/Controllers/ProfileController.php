<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
class ProfileController extends Controller
{
 
    public function indexProfile()
    {
        $users = User::where('id', '!=', 1)->get();
        return view('profile.profile', compact('users'));
    }

    public function edit($userId){
        $users = User::where('id', $userId)->get();
        return view('profile.edit', compact('users'));  
    }

    public function editSave (Request $request, $userId)
    {   
        $users = User::where('id',$userId)
        ->update([
            'name'  =>$request->name,
            'email' =>$request->email
        ]);
      
        return redirect()->route('indexProfile')->with('success', 'Editado com sucesso');
    }

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

    public function status($statusId)
    {
        $status = User::findOrFail($statusId);
        Gate::authorize('permission');
        $status->status = ($status->status == 1) ? 0 : 1;
        $status->save();
        return response()->json(['status' => $status->status]);
    }
}
