<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UniqueLink;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'phonenumber' => 'required|string|max:15|unique:users,phonenumber',
        ], [
            'phonenumber.unique' => 'The phone number has already been taken.',
        ]);

        try {
            $user = User::create([
                'name' => $request->input('username'),
                'phonenumber' => $request->input('phonenumber'),
            ]);
    
            $uniqueLink = UniqueLink::create([
                'user_id' => $user->id,
                'link' => Str::random(32), // Generate a random link
                'expiration_date' => now()->addDays(7), // Link expires in 7 days
            ]);
    
            return view('registration-success')->with('link', $uniqueLink->link);
        } catch (\Exception $e) {
            return redirect()->route('register')->withErrors(['errorMessage' => $e->getMessage()]);
        }
    }
}
