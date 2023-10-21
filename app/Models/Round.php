<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Round extends Model
{
    use HasFactory;

	public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

	public function contestants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'contestants');
    }
}
