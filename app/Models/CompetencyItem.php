<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Behaviour
 * @package App\Models
 */
class CompetencyItem extends BaseModel
{

    public $fillable = [
        'positive',
        'negative',
        'competition_id',
        'import_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'competition_id' => 'integer',
        'import_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    

}
