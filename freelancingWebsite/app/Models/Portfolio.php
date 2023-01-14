<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }
    public function files()
    {
        return $this->morphMany(Image::class, 'imageable')->where('feature',0);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('feature',1);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getExec_DateAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('M d, Y');
    }
    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('M d, Y');
    }

}
