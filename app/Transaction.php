<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = ['user_id','pack_id','promo_id','gst','discount','sub_total','total'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pack(){
        return $this->belongsTo(Pack::class);
    }

    public function promo(){
        return $this->belongsTo(PromoCode::class);
    }

}
