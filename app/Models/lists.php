<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class lists extends Model
{
    use HasFactory;
    protected $fillable = [
        'list',
    ];

    static function showAllList()
    {
        return DB::table('lists')->get();
    }
    static function storeList(array $list)
    {
        return DB::table('lists')->insert($list);
    }
    static function specificList(Int $id)
    {
        return DB::table('lists')->find($id)->get();
    }
    static function updateSpecificList(array $updatedList)
    {
        return DB::table('lists')->find($updatedList['id'])->update($updatedList);
    }
}
