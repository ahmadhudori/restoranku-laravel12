<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'username',
		'fullname',
        'email',
        'password',
		'phone',
		'role_id',
		'deleted_at',
		'created_at',
		'updated_at',
    ];

	protected $dates = [
		'deleted_at'
	];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

	public function role()
	{
		return $this->belongsTo(Role::class, 'role_id');
	}

	public function orders()
	{
		return $this->hasMany(Order::class, 'user_id');
	}
}
