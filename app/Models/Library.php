<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;
    protected $table = 'libraries';
    protected $fillable = ['library_name', 'library_address', 'library_email', 'library_owner', 'library_phone_number'];

    static function getAllLibraries()
    {
        return self::all();
    }

    static function storeAccount(array $newAccount)
    {
        if (!self::create($newAccount)) {
            return false;
        }
        return true;
    }

    static function showSpecifiedLibrary(Int $id)
    {
        return self::find($id);
    }

    static function destroySpecifiedLibrary(Int $id)
    {
        return self::where('id', $id)->delete();
    }

    static function updateSpecifiedLibrary(Int $id, array $data)
    {
        return self::where('id', $id)->update($data);
    }

    static function searchLibrary(array $filter)
    {
        if ($filter['name'] != '') {
            $queryFilter = self::where('library_name', 'like', "%" . $filter['name'] . "%");
        }
        if ($filter['address'] != '') {
            $queryFilter->where('library_address', 'like', "%" . $filter['address'] . "%");
        }
        return $queryFilter->get();
    }
}
