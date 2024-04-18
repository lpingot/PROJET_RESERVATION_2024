<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representation extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'show_id',
        'when',
        'location_id',
    ];

   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'representations';

   /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * Get the actual location of the representation
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    
    /**
     * Get the show of the representation
     */
    public function show()
    {
        return $this->belongsTo(Show::class);
    }
    public function userRepresenations()
    {
        return $this->hasMany(UserRepresentation::class);
    }
    public function users()
    {
        // Ici aussi, spécifiez 'user_representation' comme le nom de la table pivot
        return $this->belongsToMany(User::class, 'user_representation');
    }
    
    
}
