<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    const LIMIT = 512;


    protected $fillable = [
        'title',
        'phone',
        'description',
        'image',
        'user_id'
    ];
    protected $guarded = [];


    public function User()
    {
        return $this->belongsTo(User::class)->select('name');
    }

    public function getDescriptionAttribute($value)
    {
        return Str::limit($value, Post::LIMIT );
    }

}
