<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Questionary
 * @package App\Models
 */
class ExerciseAutoperception extends Model
{

    public $fillable = [
        'exercise_id',
        'autoperception_id',
        'number'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'exercise_id' => 'integer',
        'autoperception_id' => 'integer',
        'number' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    
    public function autoperception()
    {
        return $this->belongsTo('App\Models\Autoperception');
    }
}
