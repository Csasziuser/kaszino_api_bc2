<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'game',
        'min_bet',
        'max_bet',
    ];
    protected $table = "tables";
    
    public function dealers()
    {
        return $this->hasMany(Dealer::class);
    }
}
