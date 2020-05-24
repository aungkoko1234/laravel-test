<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    //
    protected $table = 'packs';
    protected $fillable = ['id','name','description','display_order','total_credit','validity_month','price','estimate_price','newbie_id','tag_id','type_id','alias_id'];

    public function newbie(){
        return $this->belongsTo(Newbie::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }

    public function alias(){
        return $this->belongsTo(Alias::class);
    }

}
