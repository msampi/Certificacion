<?php

namespace App\Repositories;

use App\Models\EvaluationUser;
use InfyOm\Generator\Common\BaseRepository;
use App\Criteria\EqualCriteria;
use App\Library\EmailSend;
use App\Models\User;
use App\Models\EvaluationExcercise;


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
        
        return parent::create($input);
        

    }

    public function update(array $input, $id)
    {
        
        return parent::update($input, $id);

    }

    
    public function saveFromExcel($data)
    {
        $ev = $this->model->firstOrCreate(['user_id' => $data['user_id'],'evaluation_id' => $data['evaluation_id'], 'post_id' => $data['post_id']]);
        if (isset($data['evaluator_id']))
          $ev->evaluator_id = $data['evaluator_id'];
        $ev->user_id = $data['user_id'];
        $ev->evaluation_id = $data['evaluation_id'];
        $ev->post_id = $data['post_id'];
        $ev->save();
    }

    public function startEvaluation($evaluation)
    {
        $this->pushCriteria(new EqualCriteria('evaluation_id',$evaluation->id));
        $this->pushCriteria(new EqualCriteria('started',0));
        $eue = $this->all();

        foreach ($eue as $ev) {
          $user = User::where('id',$ev->user_id)->first();
          $pass = $this->generatePass();
          $user->password = $pass;
          $user->save();
          $email = new EmailSend($evaluation->register_message_id, NULL, $user, $pass);
          $email->send();
          $email = new EmailSend($evaluation->welcome_message_id, NULL, $user, NULL);
          $email->send();
          $ev->started = 1;
          $ev->save();

        }
    }



}
