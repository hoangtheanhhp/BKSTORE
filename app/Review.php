<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $guard = [];

    public function products() {
        return $this->belongsTo(Products::class,'pro_id');
    }
    public function admin_users() {
        return $this->belongsTo(Admin_users::class,'admin_id');
    }
    //
}
