<?php

namespace App\Services;

class GameService
{
    public function determineResult(): array
    {   
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

        return compact('randomNumber', 'result', 'amount');
    }
}