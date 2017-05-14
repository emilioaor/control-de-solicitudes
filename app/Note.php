<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    protected $fillable = [
        'content','user_id','source','source_label','route_admin','route_user','to_user'
    ];

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }
}
