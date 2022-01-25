<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function post() { // bcs I named the method 'post', Laravel assumes the foreign key is called 'post_id',
                             //which is true in this case
        return $this->belongsTo(Post::class);
    }


    public function author() { // bcs I named the method 'author', Laravel assumes the foreign key is called 'author_id',
                                //which is not true in this case, so I have to explicitly specify the column name
        return $this->belongsTo(User::class, 'user_id');
    }
}
