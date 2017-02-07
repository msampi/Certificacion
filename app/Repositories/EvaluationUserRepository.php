<?php

namespace App\Repositories;

use App\Models\EvaluationUser;
use InfyOm\Generator\Common\BaseRepository;
use App\Criteria\EqualCriteria;
use App\Library\EmailSend;
use App\Models\User;
use App\Models\EvaluationExcercise;
use App\Library\Ecases;
use Session;

class EvaluationUserRepository extends AdminBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'evaluation_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EvaluationUser::class;
    }

    public function create(array $input)
    {
    
        $evUser = $this->model->firstOrNew(['evaluation_id' => $input['evaluation_id'], 'competitor_id' => $input['competitor_id']]);
        $evUser->primary_consultant_id = $input['primary_consultant_id'];
        $evUser->secondary_consultant_id = $input['secondary_consultant_id'];
        $evUser->save();
        return $evUser;

    }

    public function update(array $input, $id)
    {
        
        $evUser = $this->model->firstOrNew(['evaluation_id' => $input['evaluation_id'], 'competitor_id' => $input['competitor_id']]);
        $evUser->primary_consultant_id = $input['primary_consultant_id'];
        $evUser->secondary_consultant_id = $input['secondary_consultant_id'];
        $evUser->save();
        return $evUser;

    }

    
    public function saveFromExcel($data)
    {
        
        if (isset($data['competitor_id']))
        {
            echo $data['competitor_id'];
            $ev = $this->model->firstOrNew(['competitor_id' => $data['competitor_id'],'evaluation_id' => $data['evaluation_id']]);
            if (isset($data['consultant_id']))
                if ($data['consultant_type'] == 'primario')
                    $ev->primary_consultant_id = $data['consultant_id'];
                else
                    $ev->secondary_consultant_id = $data['consultant_id'];
            $ev->save();
        }
    }
    
    public function consultantStarted($consultant_id)
    {
        $evaluation_user = $this->model->where(function ($query) use ($consultant_id) {
                                        $query->where('primary_consultant_id', $consultant_id)
                                              ->where('started', 1);
                                    })->orWhere(function ($query) use ($consultant_id) {
                                        $query->where('secondary_consultant_id', $consultant_id)
                                              ->where('started', 1);
                                    })->orWhere(function ($query) use ($consultant_id) {
                                        $query->where('competitor_id', $consultant_id)
                                              ->where('started', 1);
                                    })->get();
        if ($evaluation_user && $evaluation_user->isEmpty())
            return false;
        return true;
        
        
    }
    
    public function competitorStarted($competitor_id)
    {
        $evaluation_user = $this->model->where('competitor_id', $competitor_id)->where('started', 1)->get();
        if ($evaluation_user && $evaluation_user->isEmpty())
            return false;
        return true;
           
    }
    
    public function startConsultants($eu, $evaluation)
    {
        if (!$this->consultantStarted($eu->primary_consultant_id))
        {
            $user = User::find($eu->primary_consultant_id);
            if ($user){
                $email = new EmailSend($evaluation->register_message_id, NULL, $user, true);
                $email->send();
            }
            
            
        }
        if (!$this->consultantStarted($eu->secondary_consultant_id))
        {
            $user = User::find($eu->secondary_consultant_id);
            if ($user){
                $email = new EmailSend($evaluation->register_message_id, NULL, $user, true);
                $email->send();
            }
           
            
        }
    }
    
    

    public function startEvaluation($evaluation)
    {
        
        $evaluation_user = $this->findWhere(['evaluation_id' => $evaluation->id]);
        
        foreach ($evaluation_user as $eu) {
            if (!$eu->started)
            {
                /* envio a los consultores */
                
                $this->startConsultants($eu, $evaluation);
                
                $user = User::find($eu->competitor_id);
                if (!$this->competitorStarted($eu->competitor_id) && $user)
                {
                    
                    $email = new EmailSend($evaluation->register_message_id, NULL, $user, true);
                    $email->send();
                    $eu->started = 1;
                    $eu->save();
                   
                }
                $email = new EmailSend($evaluation->welcome_message_id, NULL, $user, false);
                $email->send();
          
            }
        
        }
    }
    
   



}
