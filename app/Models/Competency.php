<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Competition
 * @package App\Models
 */
class Competency extends BaseModel
{

    public $fillable = [
        'import_id',
        'name',
        'description',
        'reference',
        'client_id',
        'competency_group_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'import_id' => 'integer',
        'name' => 'string',
        'reference' => 'text',
        'description' => 'string',
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

    public function items()
    {
        return $this->hasMany('App\Models\CompetencyItem');
    }
    
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
    
    public function setClientIdAttribute($value)
    {
        $this->attributes['client_id'] = $value ?: null;
    }
    

}
