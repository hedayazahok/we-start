<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table='booking_operations';
    protected $fillable=['name','phone','price','arrival_date','departure_date','chalet_id','num_adult'];

    public function chalet()
    {
        return $this->belongsTo(Chalet::class,'chalet_id');
    }


}
