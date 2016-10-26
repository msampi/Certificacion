<?php

namespace App\Repositories;

use App\Models\EvaluationUserEvaluator;
use InfyOm\Generator\Common\BaseRepository;
use App\Criteria\EqualCriteria;
use App\Library\EmailSend;
use App\Models\User;


class EvaluationUserEvaluatorRepository extends AdminBaseRepository
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
        return EvaluationUserEvaluator::class;
    }

    public function getLastEvaluation($user_id)
    {
        $recent =  $this->model->where('user_id','=', $user_id )->orderBy('created_at','desc')->first();
        if(!$recent)
            abort(503);
        else
            return $recent->evaluation_id;
    }

    public function create(array $input)
    {
        if ($new_post_id = $this->saveNewPost($input))
            $input['post_id'] = $new_post_id;
        return parent::create($input);

    }

    public function update(array $input, $id)
    {
        if ($new_post_id = $this->saveNewPost($input))
            $input['post_id'] = $new_post_id;
        return parent::update($input, $id);

    }

    private function generatePass()
    {
        $str1 = "";
        $str2 = "";
        $str3 = "";
        $str4 = "";

        #if ( $letras_mayusculas  )
            $str1= "ABCDEFGHIJKLMNOPQRSTUVWXYZA";
        #if ( $letras_minusculas )
            $str2= "abcdefghijklmnopqrstuvwxyza";
        #if ( $numeros )
            $str3= "123456789012345678901234567";
        #if ( $caracteres )
            $str4= "!@#$%^&*()-=+*!@#$%^&*()_+*";

        $cad = "";

        for( $i=1; $i<=2; $i++ )
            $cad .= substr( $str1, rand( 0, 25 ), 1 );
        for( $i=1; $i<=2; $i++ )
            $cad .= substr( $str2, rand( 0, 25 ), 1 );
        for( $i=1; $i<=2; $i++ )
            $cad .= substr( $str3, rand( 0, 25 ), 1 );
        for( $i=1; $i<=2; $i++ )
            $cad .= substr( $str4, rand( 0, 25 ), 1 );

        return $cad;
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
