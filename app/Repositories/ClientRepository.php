<?php

namespace App\Repositories;

use App\Models\Client;
use InfyOm\Generator\Common\BaseRepository;

class ClientRepository extends BaseRepository
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

    /**
     * Gets the client count.
     *
     * @return     <type>  The client count.
     */
    public function getClientCount() {
        return $this->all()->count();
    }    

    public function getClients() {
        return Client::doesntHave('Posts')->lists('name','id');
    }
}
