<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
	use SoftDeletes, HasFactory;

	protected $fillable = [
		'name',
		'description',
		'price',
		'category_id',
		'image',
		'is_active',
		'deleted_at',
		'created_at',
		'updated_at',
	];

	protected $dates = [
		'deleted_at',
	];

	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id');
	}

	public function orderItems()
	{
		return $this->hasMany(OrderItem::class, 'item_id');
	}
}
