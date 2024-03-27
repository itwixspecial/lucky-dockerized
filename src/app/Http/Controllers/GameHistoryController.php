<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\HandlesUniqueLinks;

class GameHistoryController extends Controller
{
    use HandlesUniqueLinks;

    /**
     * Display the game history for a unique link.
     *
     * @param  string  $link
     * @return \Illuminate\View\View
     */
    public function index($link)
    {
        $uniqueLink = $this->checkUniqueLink($link);
        $history = $uniqueLink->plays()->orderBy('id', 'desc')->take(3)->get();

        return view('page-a', [
            'uniqueLink' => $uniqueLink,
            'history' => $history,
        ]);
    }
}
