<?php

namespace App\Repositories;

use App\Models\Client;
use InfyOm\Generator\Common\BaseRepository;

class ClientRepository extends AdminBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Client::class;
    }


    public function getClients() {
        return Client::doesntHave('Posts')->lists('name','id');
    }
}
