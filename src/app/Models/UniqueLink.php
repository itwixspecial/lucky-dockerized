<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniqueLink extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'link', 'expiration_date'];

    public function plays()
    {
        return $this->hasMany(GameHistory::class);
    }

    public function isExpired()
    {
        return now()->gt($this->expiration_date);
    }

    public function gameHistories()
    {
        return $this->hasMany(GameHistory::class);
    }
}
