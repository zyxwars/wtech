<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Product extends Model
{
//    https://laravel.com/docs/12.x/eloquent-relationships#one-to-many
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

//    https://laravel.com/docs/12.x/eloquent-relationships#one-to-many-inverse
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

}
