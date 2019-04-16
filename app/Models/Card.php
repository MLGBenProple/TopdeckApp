<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
	public function user_inventorys(){
		return $this->belongsToMany('App\User', 'card_user', 'user_id', 'card_id');
	}

	public function user_wishlists(){
		return $this->belongsToMany('App\User', 'wishlist', 'user_id', 'card_id');
	}
}
