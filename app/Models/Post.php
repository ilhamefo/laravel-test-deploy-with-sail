<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable;

    // protected $fillable = ['title', 'description'];
    protected $guarded = [];

    public function shouldBeSearchable()
    {
        return $this->published === 1;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
