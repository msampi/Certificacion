<?php

namespace App\Repositories;

use App\Models\Message;
use InfyOm\Generator\Common\BaseRepository;
use Auth;

class MessageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'client_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Message::class;
    }

    
}
