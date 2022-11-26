<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['path','chalet_id','main' ];


        public function chalet()
        {
            return $this->belongsTo(Chalet::class);
        }



}
