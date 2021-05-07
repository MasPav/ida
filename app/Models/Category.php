<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subCategories()
    {
        return $this->hasMany(self::class, 'parent_id')->with('subCategories');
    }
    public function parentCategory()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function getCreatedAtAttribute($value)
    {
        return date("d M Y", strtotime($value));
    }
    public function getUpdatedAtAttribute($value)
    {
        return date("d M Y", strtotime($value));
    }
    public function getOnlySubCategories()
    {
        return $this->where('parent_id', '<>', 'NULL')->get();
    }
}
