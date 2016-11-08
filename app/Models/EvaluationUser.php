<?php

namespace App\Models;


use Eloquent as Model;

/**
 * Class EvaluationUserEvaluator
 * @package App\Models
 */
class EvaluationUser extends BaseModel
{

    
    public $fillable = [
        'evaluation_id',
        'primary_consultant_id',
        'secondary_consultant_id',
        'competitor_id',
        'status',
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    public function primaryConsultant()
    {
        return $this->belongsTo('App\Models\User', 'primary_consultant_id');
    }
    
    public function secondaryConsultant()
    {
        return $this->belongsTo('App\Models\User','secondary_consultant_id');
    }
    
    public function competitor()
    {
        return $this->belongsTo('App\Models\User', 'competitor_id');
    }
    
    public function evaluation()
    {
        return $this->belongsTo('App\Models\Evaluation');
    }





}
