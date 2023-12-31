<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Race extends Model
{
    use HasFactory;

	protected $fillable = ['name','year'];

	public function rounds(): HasMany
    {
        return $this->hasMany(Round::class);
    }
}
