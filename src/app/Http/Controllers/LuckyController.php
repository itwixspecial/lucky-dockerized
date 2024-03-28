<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\HandlesUniqueLinks;
use App\Services\GameService;

class LuckyController extends Controller
{
    use HandlesUniqueLinks;

    public function imFeelingLucky($link, GameService $gameService)
    {
        $uniqueLink = $this->checkUniqueLink($link);

        $gameResult = $gameService->determineResult();

        $uniqueLink->gameHistories()->create([
            'unique_link_id' => $uniqueLink->id,
            'number' => $gameResult['randomNumber'],
            'result' => $gameResult['result'],
            'amount' => $gameResult['amount'],
        ]);

        return view('page-a', [
            'uniqueLink' => $uniqueLink,
            'randomNumber' => $gameResult['randomNumber'],
            'result' => $gameResult['result'],
            'amount' => $gameResult['amount'],
        ]);
    }
}
