<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function userId(Request $request): View
    {
        return view('profile.id', [
            'user' => $request->user(),
        ]);
    }

    public function storeId(Request $request)
    {
        $data = $request->get('dataURL');
        $base64Image = base64_encode(file_get_contents($data));
        $image = Image::make($base64Image);
        $image->resize(1280,1230);
        $imagename = md5('test' . microtime()) . '.png';
        $image->save('uploads/tickets/'.$imagename);
        
        $response = [
            'success' => false,
            'message' => "Successful"
          ];
          return response()->json($response, 422);
    }

  
    public function generateCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->attending = rand(1000, 9999);
        $user->save();

   
        return redirect()->route('successCode')->with([
            'success' => 'Thank you for confirming attendance. Your code (' . $user->attending . ') has been generated successfully',
            'code' => $user->attending,
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
