<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];
   /* public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }*/

    public function files()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
    public function proposal()
    {
        return $this->hasOne(Proposal::class)->where('project_id',$this->id)->where('status','processing');
    }



    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function ($project) {
            $project->slug = $project->generateSlug($project->title);
            $project->save();
        });
    }

    private function generateSlug($title)
    {
        if (static::whereSlug($slug = Str::slug($title))->exists()) {
            $max = static::wheretitle($title)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }

    public function messages()
    {
        return $this->hasMany(Message::class,'project_id','id');


    }

}
