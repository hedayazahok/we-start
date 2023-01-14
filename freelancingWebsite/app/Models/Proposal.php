<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Proposal extends Model
{
    use HasFactory,Notifiable;
    protected $guarded = [];

    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function contract(){
        return $this->hasOne(Contract::class);
    }
    public function files()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    public function files_proposal_completed()
    {
        return $this->morphMany(Image::class, 'imageable')->where('feature',1);
    }

}
