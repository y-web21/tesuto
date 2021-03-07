<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'author'];

    /**
     * Get the uploadImage associated with the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function uploadImage(): HasOne
    {
        return $this->hasOne(UploadImage::class,'id' ,'featured_image_id');
    }

    /**
     * Get the user associated with the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author');
    }

    /**
     * Get the articleStatus associated with the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function articleStatus(): HasOne
    {
        return $this->hasOne(ArticleStatus::class, 'status_id', 'status');
    }

    public function scopePublish($query, int $status = 1){
        return $query->where('status', '=', $status);
    }
}
