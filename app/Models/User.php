<?php

namespace App\Models;

use App\Helpers\MoneyFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use NumberFormatter;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fullname',
        'phone',
        'balance',
        'email',
        'password',
        'currency',
        'verified',
        'twofactor',
        'logs',
        'smtp_unusual_activity',
        'smtp_new_browser'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'recoveryCode',
        'twofactorCode'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shops()
    {
        return $this->hasMany(Shop::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets_messages()
    {
        return $this->hasMany(TicketMessage::class, 'sender');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activityLogs()
    {
        return $this->hasMany(ActivityLogs::class, 'user_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getNameOrEmail()
    {
        return $this->fullname ? $this->fullname : $this->email;
    }

    public function getBalance()
    {
        return (new MoneyFormat)->money($this->balance);
    }

    public function getFullname()
    {
        return auth()->user()->fullname ? auth()->user()->fullname : __('Not available');
    }

    public function getPhone()
    {
        return auth()->user()->phone ? auth()->user()->phone : __('Not available');
    }

    public function getRegisterDate()
    {
        return date("d.m.Y", strtotime($this->created_at));
    }

    public function getRegisterDateTime()
    {
        return date("H:i", strtotime($this->created_at));
    }


}
