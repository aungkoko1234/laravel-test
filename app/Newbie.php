<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newbie extends Model
{
    //
        //
        protected $table = 'newbies';
        protected $fillable = ['newbie_first_attend','newbie_addition_credit','newbie_note'];

        public function packs(){
            return $this->hasMany(Pack::class);
        }

}
