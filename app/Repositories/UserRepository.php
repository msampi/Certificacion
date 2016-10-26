<?php

namespace App\Repositories;

use App\Models\User;
use App\Library\EmailSend;
use App\Models\Language;
use InfyOm\Generator\Common\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email'

    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    /**
     * Gets the user count.
     *
     * @return     <type>  The user count.
     */
    public function getUserCount() {
        return $this->all()->count();
    }

  
    public function getLanguageByPrefix($prefix)
    {
        $lang = Language::where('prefix',$prefix)->first();
        return $lang->id;
    }

    public function saveFromExcel($row, $client_id)
    {
        $response = array();

        $user = $this->model->firstOrNew(array('email' => $row->email));
        $user->name = $row->nombre;
        $user->code = $row->codigo;
        $user->last_name = $row->apellido;
        $user->email = $row->email;
        $user->client_id = $client_id;
        $user->dni = $row->dni;
        $user->language_id = $this->getLanguageByPrefix($row->idioma);
        $user->country = $row->pais;
        $user->city = $row->ciudad;
        $user->role_id = '3';
        $user->area = $row->area;
        $user->save();
        $response['user_id'] = $user->id;
        $response['post'] = $row->puesto;
        $response['category'] = $row->categoria;
        if ($row->evaluador){
            $evaluator = $this->model->firstOrCreate(array('email' => $row->evaluador));
            $response['evaluator_id'] = $evaluator->id;
        }

        return $response;


    }
}
