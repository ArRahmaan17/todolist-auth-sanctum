<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    protected $fillable = [
        'authors_name',
    ];

    public static function getAllAuthors()
    {
        return self::all();
    }

    public static function createAuthors(array $data)
    {
        return self::create($data);
    }

    public static function showSpecifiedAuthors(int $id)
    {
        return self::find($id);
    }

    public static function updateAuthors(array $data, int $id)
    {
        return self::find($id)->update($data);
    }

    public static function deleteAuthors(int $id)
    {
        return self::find($id)->delete();
    }
}
