<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable=['id','bill_id','item_name','quantity','price','cost'];
    public function Bill()
    {
        return $this->belongsTo(Bill::class);
    }

}
