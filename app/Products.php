<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
   	protected $table ='products';
	protected $guarded =[];
    public $incrementing = true;
	public function category()
	{
		return $this->belongsTo('App\Category','cat_id');
	}
	public function pro_details()
    {
        return $this->hasOne('App\Pro_details','pro_id');
    }
    public function detail_img()
    {
        return $this->hasMany('App\Detail_img','pro_id');
    }
    public function oders_detail()
    {
        return $this->hasOne('App\Oders_detail','pro_id');
    }

    public function Admin_users()
    {
        return $this->belongsToMany(Admin_users::class, 'admin_products', 'pro_id','admin_id')
            ->withTimestamps();
    }
}
