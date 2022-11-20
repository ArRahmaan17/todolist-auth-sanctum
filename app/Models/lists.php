<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Int_;

class lists extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    static function showAllList()
    {
        return json_encode(DB::table('lists')->get());
    }
    static function storeList(array $list)
    {
        return DB::table('lists')->insert($list);
    }
    static function specificList(Int $id)
    {
        return json_encode(DB::table('lists')->where('id', $id)->first());
    }
    static function updateSpecificList(array $updatedList)
    {
        return DB::table('lists')->where('id', $updatedList['id'])->update($updatedList);
    }
    static function removeList(Int $id)
    {
        return DB::table('lists')->where('id', $id)->delete();
    }
}
