<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Actionable, Notifiable, HasApiTokens;

    public static function boot()
    {
        parent::boot();

//        static::creating(function ($model) {
//            if (Auth::user()->client_id){
//                $model->client_id = Auth::user()->client_id;
//
//            }
//        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar', 'title', 'first_name', 'last_name', 'device_token', 'email', 'preferred_notification_channel', 'phone_number', 'code', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'password'
    ];

    public function user_type()
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class, 'id', 'user_id');
    }

    public function wallet()
    {
        return $this->hasMany(Wallet::class, 'id', 'user_id')->latest()->first();
    }

    public function vehicles()
    {
        return $this->hasMany(UserVehicle::class);
    }

    public function card_details()
    {
        return $this->hasMany(CardDetail::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class)->whereDate('end', '>', now());
    }

}
