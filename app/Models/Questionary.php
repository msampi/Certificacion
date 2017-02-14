<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Questionary
 * @package App\Models
 */
class Questionary extends Model
{

    public $table = 'questionaries';
    


    public $fillable = [
        'name',
        'instructions',
        'reference',
        'import_id',
        'client_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'import_id' => 'integer',
        'reference' => 'text',
        'client_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    
    public function questions()
    {
        return $this->hasMany('App\Models\Question');
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
