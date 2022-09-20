<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_type',
        'model_id',
        'value',
        'user_id',
    ];

    public function model () {
        return $this->morphTo();
    }
}
