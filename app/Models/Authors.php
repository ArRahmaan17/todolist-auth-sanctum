<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;

    static function getAllAuthors()
    {
        return self::all();
    }

    static function createAuthors(array $data)
    {
        return self::create($data);
    }

    static function showSpecifiedAuthors(int $id)
    {
        return self::find($id);
    }
    static function updateAuthors(array $data, int $id)
    {
        return self::find($id)->update($data);
    }
    static function deleteAuthors(int $id)
    {
        return self::find($id)->delete();
    }
}
