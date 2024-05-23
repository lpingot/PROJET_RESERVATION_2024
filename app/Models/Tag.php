<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['tag'];

    protected $table = 'tags';

    public $timestamps = false;

    public function shows()
    {
        return $this->belongsToMany(Show::class);
    }

}
