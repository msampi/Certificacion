<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Questionary
 * @package App\Models
 */
class ExerciseQuestionary extends Model
{

    public $fillable = [
        'exercise_id',
        'questionary_id',
        'order'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'exercise_id' => 'integer',
        'questionary_id' => 'integer',
        'order' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    
    public function questionary()
    {
        return $this->belongsTo('App\Models\Questionary');
    }
}
