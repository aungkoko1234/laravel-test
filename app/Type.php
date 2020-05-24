<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pack;

class Type extends Model
{
    //
    protected $table = 'types';
    protected $fillable = ['name'];

    public function packs(){
        return $this->hasMany(Pack::class);
    }
}
