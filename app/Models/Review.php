<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviewers';
    protected $fillable = [
        'reviewer_id',
        'user_id',
        'remarks',
        'star'
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewer () {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
