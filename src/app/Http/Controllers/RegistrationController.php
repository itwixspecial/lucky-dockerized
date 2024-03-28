<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UniqueLink;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
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
