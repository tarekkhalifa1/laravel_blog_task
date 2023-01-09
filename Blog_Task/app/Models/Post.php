<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'image',
        'author_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class);

    } //end of author method


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

} // end of post class
