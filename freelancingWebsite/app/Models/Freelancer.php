<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Freelancer extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $guard = "freelancer";

    protected $fillable = [
        'name',
        'email',
        'password',
        'major',
        'country',
        'category_id',
        'bio',
        'skills',
        'role_id',
        'rating',
        'bids',
        'wallet',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class,'user_id','id');


    }
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function getRating(){
        $rating =Review::where('freelancer_id',$this->id)->pluck('star')->avg();
        return  $rating;
    }

    public function getCountRating(){
        $count =Review::where('freelancer_id',$this->id)->count();
        return  $count;
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('M d, Y');
    }
}
