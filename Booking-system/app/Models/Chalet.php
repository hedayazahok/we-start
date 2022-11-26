<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chalet extends Model
{
    use HasFactory;
    protected $fillable=['name','details','price','address','created_at','status'];
    protected $dates = [
        'created_at'
    ];
    public $booking_nums=0;
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

     public function booking_nums()
    {
        $booking_nums=$this->bookings()->count();
    }

    public function getPriceAttribute($value)
    {
        $now = Carbon::now();
        $day = Carbon::parse($now)->format('l');
        if($day=='Friday' ||$day=='Thursday'){
           return  $this->attributes['price']+50;

        }else{
            return   $this->attributes['price'];

        }


    }

    public function setPriceAttribute()
    {
        $now = Carbon::now();
        $day = Carbon::parse($now)->format('l');
        if($day=='Friday' ||$day=='Thursday'){

            $this->attributes['price']=  $this->attributes['price']+50;

        }else{
            $this->attributes['price']= $this->attributes['price'];

        }


    }

    public function getStatusAttribute($value){
        $now=Carbon::now();
        $isBooked = $this->bookings()
        ->Where(fn ($q) => $q->where('arrival_date', '<', $now)->where('departure_date', '>', $now))
        ->exists();

        if( $isBooked){
            return 1;
        }
        return 0;
    }



















}

