<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logging extends Model
{
    //
    protected $table = 'loggings';
    protected $fillable = ['description','effectedTable','action','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
