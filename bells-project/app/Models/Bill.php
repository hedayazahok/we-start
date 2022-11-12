<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable=['id','user_by','cust_name','invoice_no','total_cost','status'];

    public function User()
    {
        return $this->belongsTo(user::class);
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function invoiceNo($id)
    {
        $start = 0; // 0 = A, 702 or 703 = AAA, adjust accordingly
        $letters_value = $start + (ceil($id / 999) - 1);
        $numbers = ($id % 999 === 0) ? 999 : $id % 999;

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base = strlen($characters);
        $letters = '';

        // while there are still positive integers to divide
        while ($letters_value) {
            $current = $letters_value % $base;
            $letters = $characters[$current] . $letters;
            $letters_value = floor($letters_value / $base);
        }

    return $letters.'-'.sprintf('%03d', $numbers);

    }

    public function dateformate(){
    return Carbon::parse($this->created_at)->format('M,d-Y');
    }
}
