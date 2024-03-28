<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use App\Http\Traits\HandlesUniqueLinks;
use App\Models\UniqueLink;

class UniqueLinkController extends Controller
{   
    use HandlesUniqueLinks;

    public function generate()
    {
        $user = auth()->user();
        $link = Str::random(32); //random link generation
        $expirationDate = now()->addDays(7); // link expire date

        // Check if the generated link already exists
        while (UniqueLink::where('link', $link)->exists()) {
            $link = Str::random(32); // Generate a new link
        }

        $user->uniqueLinks()->create([
            'user_id' => $user->id,
            'link' => $link,
            'expiration_date' => $expirationDate,
        ]);

        return redirect()->route('page-a', $link);
    }

    public function show($link)
    {
        $uniqueLink = $this->checkUniqueLink($link);

        return view('page-a')->with('uniqueLink', $uniqueLink);
    }

    public function regenerate($link)
    {
        $uniqueLink = $this->checkUniqueLink($link);

        $newLink = Str::random(32);
        $uniqueLink->update(['link' => $newLink]);

        return redirect()->route('page-a', $newLink);
    }

    public function deactivate($link)
    {
        $uniqueLink = $this->checkUniqueLink($link);

        $uniqueLink->expiration_date = now(); //set expiration date to now()
        $uniqueLink->save(); 

        return redirect()->route('register');
    }
}