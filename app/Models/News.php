<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Cviebrock\EloquentSluggable\Sluggable;

class News extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = "news";
    protected $primaryKey = "id";

    public function setTitleAttribute($value)
    {
        // setter
        // return ucwords($value); // upper case each word's first char
        $this->attributes['title'] = ucwords($value);
    }


    // protected function title(): Attribute
    // {
    //     // getter
    //     return Attribute::make(
    //         get: fn ($value) => lcfirst($value),
    //     );
    // }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'separator' => '-',
                'onUpdate' => true,
                'unique' => true,
            ]
        ];
    }
}
