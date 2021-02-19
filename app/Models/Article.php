<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'author'];

    public function statusName(){
        return $this->hasOne(ArticleStatus::class);
        return $this->hasOne(ArticleStatus::class, 'id');
    }

    public function test(){
        return $this->id;
    }
}
