<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);

    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getStartTimeAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('M d, Y');
    }
    public function getEndTimeAttribute($timestamp) {
        return Carbon::parse($timestamp)->format('M d, Y');
    }

}
