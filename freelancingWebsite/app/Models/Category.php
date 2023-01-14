<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

}
