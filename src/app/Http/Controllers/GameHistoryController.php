<?php

namespace App\Http\Controllers;

use App\Http\Traits\HandlesUniqueLinks;

class GameHistoryController extends Controller
{
    use HandlesUniqueLinks;

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
