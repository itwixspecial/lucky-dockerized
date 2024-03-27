<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UniqueLink;
use App\Http\Traits\HandlesUniqueLinks;

class LuckyController extends Controller
{
    use HandlesUniqueLinks;

    /**
     * Handle the "I'm Feeling Lucky" request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $link
     * @return \Illuminate\View\View
     */
    public function imFeelingLucky(Request $request, $link)
    {
        $uniqueLink = $this->checkUniqueLink($link);

        $randomNumber = rand(1, 1000);

        if ($randomNumber % 2 == 0) {
            $result = 'Win';

            $amountConditions = [
                900 => 0.7,
                600 => 0.5,
                300 => 0.3,
                0 => 0.1,
            ];

            foreach ($amountConditions as $condition => $value) {
                if ($randomNumber > $condition) {
                    $amount = $randomNumber * $value;
                    break;
                }
            }
        } else {
            $result = 'Lose';
            $amount = 0;
        }

        $uniqueLink->gameHistories()->create([
            'unique_link_id' => $uniqueLink->id,
            'number' => $randomNumber,
            'result' => $result,
            'amount' => $amount,
        ]);

        return view('page-a', [
            'uniqueLink' => $uniqueLink,
            'randomNumber' => $randomNumber,
            'result' => $result,
            'amount' => $amount,
        ]);
    }
}
