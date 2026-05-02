<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poll extends Model
{
    protected $fillable = ['question', 'active', 'opens_at', 'closes_at'];

    protected $casts = [
        'active' => 'boolean',
        'opens_at' => 'datetime',
        'closes_at' => 'datetime',
    ];

    public function options(): HasMany
    {
        return $this->hasMany(PollOption::class)->orderBy('position');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(PollVote::class);
    }

    public function totalVotes(): int
    {
        return (int) $this->options->sum('vote_count');
    }
}
