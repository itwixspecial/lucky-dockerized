<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use App\Models\UniqueLink;

trait HandlesUniqueLinks
{
    protected function checkUniqueLink($link)
    {
        $uniqueLink = UniqueLink::where('link', $link)->first();

        if (!$uniqueLink || $uniqueLink->expiration_date < now()) {
            abort(404);
        }

        return $uniqueLink;
    }
}