<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function relatedProducts($categoryId, $productId)
    {
        return $this->where('category_id', $categoryId)->where('id', '<>', $productId)->latest()->take(3)->get();
    }
    public function getCreatedAtAttribute($value)
    {
        return date("d M Y", strtotime($value));
    }
    public function getUpdatedAtAttribute($value)
    {
        return date("d M Y", strtotime($value));
    }
    public function getImagesAttribute($value)
    {
        return json_decode($value);
    }
}
