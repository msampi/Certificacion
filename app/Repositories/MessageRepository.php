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

    public function getRoleUserMessages($superadmin)
    {
      if ($superadmin)
        return $this->model->listCurrentLang('id', 'subject');
      else
        return $this->model->listCurrentClientLang('id', 'subject');

    }
}
