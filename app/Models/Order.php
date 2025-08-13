<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

	protected $fillable = [
		'order_code',
		'user_id',
		'subtotal',
		'tax',
		'grand_total',
		'status',
		'table_number',
		'payment_method',
		'note',
		'deleted_at',
		'created_at',
		'updated_at',
	];

	protected $dates = [
		'deleted_at',
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function orderItems()
	{
		return $this->hasMany(OrderItem::class, 'order_id');
	}
}
