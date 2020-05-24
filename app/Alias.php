<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alias extends Model
{
    //
    protected $table = 'aliases';
    protected $fillable = ['name'];

    public function packs(){
        return $this->hasMany(Pack::class);
    }
}
