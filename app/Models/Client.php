<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Client
 * @package App\Models
 */
class Client extends BaseModel
{

    public $table = 'clients';



    public $fillable = [
        'name',
        'logo',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'logo' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function Posts() {
        return $this->hasOne('App\Models\Post', 'client_id', 'id');
    }

    public function getLogoAttribute($value)
    {
        if (!$value)
            return 'client.png';
        return $value;
    }

}
