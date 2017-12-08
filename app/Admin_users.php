<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin_users extends Authenticatable
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'level',  'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'admin_products', 'admin_id','pro_id')->withTimestamps();
    }
    public function oder()
    {
        return $this->hasMany('App\Oders', 'admin_id');
    }
    public function reviews(){
        return $this->hasMany(Review::class, 'admin_id');
    }
}


