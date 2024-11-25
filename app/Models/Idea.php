<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    /* Attributes you do not want to be mass assigned */
    // protected $guarded = [
    //     'id',
    //     'created_at',
    //     'updated_at',
    // ];

    /* Attributes you want to be mass assigned */
    protected $fillable = [
        'user_id',
        'content',
        'likes',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
