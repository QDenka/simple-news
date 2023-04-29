<?php

namespace App\Models\News;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'news_categories', 'news_id', 'category_id');
    }

    /**
     * @return Builder
     */
    public function scopeWithUser(): Builder
    {
        return $this->where('user_id', Auth::id());
    }
}
