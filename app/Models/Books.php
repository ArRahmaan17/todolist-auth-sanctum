<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'synopsis', 'quantity', 'status', 'author_id', 'category_id'];

    public static function getAllBooks()
    {
        return self::all();
    }

    public static function storeNewBook($newBooks)
    {
        return self::insert($newBooks);
    }
}
