<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Competition
 * @package App\Models
 */
class CompetencyGroup extends BaseModel
{

    public $fillable = [
        'name',
        'client_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'client_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function competencies()
    {
        return $this->hasMany('App\Models\Competency');
    }

    

}
