<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function messages()
    {
        return $this->hasMany(Message::class,'user_id','id');


    }
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function financial_transactions(){
        return $this->hasMany(Financial_transaction::class);

    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function get_refunds($value){
        $year = Carbon::now()->format('Y');
        $refunds=User::where('type','admin')->whereYear('updated_at', $year)
    ->whereMonth('updated_at', $value)
    ->sum('wallet');


    }

    




}
