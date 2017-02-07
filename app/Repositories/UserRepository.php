<?php

namespace App\Repositories;

use App\Models\User;
use App\Library\EmailSend;
use App\Models\Language;
use InfyOm\Generator\Common\BaseRepository;

class UserRepository extends AdminBaseRepository
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

    
    
    
    public function getRole($tipo){
        if (strtolower($tipo) == 'participante')
            return 3;
        if (strtolower($tipo) == 'consultor')
            return 4;
        return 0;
    }

    public function saveFromExcel($row, $client_id = 4)
    {
        $response = array();
        if(isset($row->email)){
            $user = $this->model->firstOrNew(['email' => $row->email]);
            $user->name = $row->nombre;
            $user->code = $row->codigo;
            $user->last_name = $row->apellido;
            $user->email = $row->email;
            $user->client_id = $client_id;
            $user->dni = $row->dni;
            $user->country = $row->pais;
            $user->city = $row->ciudad;
            $user->role_id = $this->getRole($row->tipo);
            $user->area = $row->area;
            $user->save();

            if ($user->role_id == 3){ // es participante
                $response['competitor_id'] = $user->id;
                if ($row->consultor){
                    $consultor = $this->model->firstOrCreate(array('email' => $row->consultor));
                    $response['consultant_id'] = $consultor->id;
                    $response['consultant_type'] = $row->tipo_consultor;
                }
            }
            else
                if ($user->role_id == 4){ // es consultor
                    $response['consultant_id'] = $user->id;
                    $response['consultant_type'] = $row->tipo_consultor;
                }
        }
        
        return $response;


    }
}
