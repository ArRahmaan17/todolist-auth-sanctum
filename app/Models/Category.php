<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['category_name'];

    static function getAllCategories()
    {
        return self::all();
    }

    static function storeNewCategory(array $category)
    {
        return self::create($category);
    }

    static function findSpecifiedRecord(int $id)
    {
        return self::find($id);
    }

    static function updateSpecifiedRecord(array $updatedRecord)
    {
        return self::find($updatedRecord['id'])->update($updatedRecord);
    }

    static function destroySpecifiedRecord(int $id)
    {
        return self::find($id)->delete();
    }
}
