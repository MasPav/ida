<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'description', 'parent_id'];
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
    public static function destroy($id) {
        $category = self::find($id);
        if(is_null($category->parent_id)) {
            self::where('parent_id', $id)->delete();
        }
        return $category->delete();
    }
}
