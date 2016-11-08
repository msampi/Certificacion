<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Exercise
 * @package App\Models
 */
class ExerciseType extends Model
{
    
    public $fillable = [
        'name',
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        
    ];

    
}
