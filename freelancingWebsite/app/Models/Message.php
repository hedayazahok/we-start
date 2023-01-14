<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getCreatedAtAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('M d, Y');
    }

    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class,'user_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
