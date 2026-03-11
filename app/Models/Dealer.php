<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    protected $fillable =
    [
        'name',
        'gender',
        'online',
        'table_id',

    ];
    protected $table = "dealers";

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
