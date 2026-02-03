<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['category_name'];

    public static function getAllCategories()
    {
        return self::all();
    }

    public static function storeNewCategory(array $category)
    {
        return self::create($category);
    }

    public static function findSpecifiedRecord(int $id)
    {
        return self::find($id);
    }

    public static function updateSpecifiedRecord(array $updatedRecord)
    {
        return self::find($updatedRecord['id'])->update($updatedRecord);
    }

    public static function destroySpecifiedRecord(int $id)
    {
        return self::find($id)->delete();
    }
}
