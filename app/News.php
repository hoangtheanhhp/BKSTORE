<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table ='news';
	protected $guarded =[];

	public function category()
	{
		return $this->belongsTo('App\Category','cat_id');
	}
}
