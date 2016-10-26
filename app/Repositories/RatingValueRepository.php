<?php

namespace App\Repositories;

use App\Models\Value;
use InfyOm\Generator\Common\BaseRepository;

class RatingValueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'value'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Value::class;
    }
}
