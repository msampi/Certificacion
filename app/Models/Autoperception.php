<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Competition
 * @package App\Models
 */
class Autoperception extends BaseModel
{

    public $fillable = [
        'name',
        'rating_id',
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
        'rating_id' => 'integer',
        'reference' => 'text',
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
        return $this->hasMany('App\Models\AutoperceptionItem');
    }
    public function rating()
    {
        return $this->belongsTo('App\Models\Rating');
    }
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    

}
