<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Exercise
 * @package App\Models
 */
class Document extends Model
{

    
    public $fillable = [
        'name',
        'evaluation_id'
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'evaluation_id' => 'integer'
    ];
    

}
