<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Exercise
 * @package App\Models
 */
class Exercise extends Model
{

    public $table = 'exercises';
    


    public $fillable = [
        'name',
        'instructions',
        'competitor_pdf',
        'consultant_pdf',
        'exercise_type_id',
        'client_id',
        'rating_id',
        'external_link',
        'simulation_id',
        'simulation_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'text',
        'instructions' => 'string',
        'competitor_pdf' => 'string',
        'consultant_pdf' => 'string',
        'rating_id' => 'integer',
        'client_id' => 'integer',
        'external_link' => 'string',
        'simulation_id' => 'integer',
        'simulation_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
        /*'competitor_pdf' => 'mimes:application/pdf',
        'cosultant_pdf' => 'mimes:application/pdf',*/
    ];
    
    public function type()
    {
        return $this->belongsTo('App\Models\ExerciseType','exercise_type_id');
    }
    
     public function rating()
    {
        return $this->belongsTo('App\Models\Rating');
    }
    
    public function setClientIdAttribute($value)
    {
        $this->attributes['client_id'] = $value ?: null;
    }
    
    public function competencyGroups()
    {
        return $this->belongsToMany('App\Models\CompetencyGroup','exercise_competencies')->withPivot('id')->orderBy('number');
    }
    
    public function getExerciseView()
    {
        switch ($this->exercise_type_id){
            case '1' : return 'roleplay'; break;
            case '2' : return 'autoperception'; break;
            case '3' : return 'knowledges'; break;
            case '4' : return 'competencies'; break;
            case '5' : return 'ecase'; break;
            case '6' : return 'link'; break;
        }
    }
    
    
    public function questionaries()
    {
        return $this->belongsToMany('App\Models\Questionary','exercise_questionaries')->withPivot('id');
    }
    
    public function autoperceptions()
    {
        return $this->belongsToMany('App\Models\Autoperception','exercise_autoperceptions')->withPivot('id');
    }
    

}
