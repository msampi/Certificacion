<?php

namespace App\Repositories;

use App\Models\Exercise;
use InfyOm\Generator\Common\BaseRepository;

class ExerciseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Exercise::class;
    }
}
