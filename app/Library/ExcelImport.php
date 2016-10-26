<?php

namespace App\Library;

use App\Repositories\EvaluationUserEvaluatorRepository;
use App\Repositories\UserRepository;
use App\Repositories\PostRepository;
use App\Repositories\PlanRepository;
use App\Repositories\ActionRepository;
use App\Repositories\CompetitionRepository;
use App\Repositories\ValorationRepository;
use App\Repositories\BehaviourRepository;
use App\Repositories\ObjectiveRepository;
use App\Models\Language;
use App\Models\Post;
use App\Models\Evaluation;

class ExcelImport {

    private $errors;
    private $evaluation_id;
    private $client_id;
    private $languages;
    private $userRepository;
    private $actionRepository;
    private $postRepository;
    private $planRepository;
    private $competitionRepository;
    private $behaviourRepository;
    private $valorationRepository;
    private $objectiveRepository;
    private $evaluationUserEvaluatorRepository;
    private $lang;

    public function __construct(UserRepository $userRepo,
                                EvaluationUserEvaluatorRepository $evaluationUserEvaluatorRepo,
                                CompetitionRepository $competitionRepo,
                                BehaviourRepository $behaviourRepo,
                                ValorationRepository $valorationRepo,
                                ObjectiveRepository $objectiveRepo,
                                PostRepository $postRepo,
                                PlanRepository $planRepo,
                                ActionRepository $actionRepo)
    {

        $this->errors = array();
        $this->languages = Language::lists('prefix');
        $this->userRepository = $userRepo;
        $this->postRepository = $postRepo;
        $this->evaluationUserEvaluatorRepository = $evaluationUserEvaluatorRepo;
        $this->competitionRepository = $competitionRepo;
        $this->behaviourRepository = $behaviourRepo;
        $this->valorationRepository = $valorationRepo;
        $this->objectiveRepository = $objectiveRepo;
        $this->planRepository = $planRepo;
        $this->actionRepository = $actionRepo;


    }

    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    public function setLanguage($language)
    {
        $this->lang = $language;
    }

    public function setEvaluationId($evaluation_id)
    {
        $this->evaluation_id = $evaluation_id;
    }



    private function validEmail($email, $line)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          return false;
          $this->errors[$line][] = 'Formato de email no válido';
        }
        return true;
    }

    private function validLanguage($lang, $line)
    {
        $lang = strtolower($lang);
        if ($this->languages->contains($lang))
            return true;
        else
        {
            $this->errors[$line][] = 'El idioma no existe';
            return false;
        }

    }

    private function emptyField($field, $field_name, $sheet, $line)
    {

        if ($field)
            return true;
        else
        {
            $this->errors[$line][] = 'La '.$sheet.' no tiene '.$field_name;
            return false;
        }

    }



    private function validPostName($row, $line)
    {

        if ($row->puesto)
            return true;
        else
        {
            $this->errors[$line][] = 'La competencia no tiene puesto';
            return false;
        }

    }


    public function validateUsersFields($row, $line)
    {
        if ($this->validLanguage($row->idioma,$line))
            if ($this->validEmail($row->email,$line))
                return true;
        return false;
    }

    public function validateCompetitionsFields($row, $line)
    {
        if ($this->emptyField($row->competencia, 'nombre', 'competencia', $line))
            if ($this->validPostName($row, $line))
                return true;
        return false;
    }

    public function validateValorationsFields($row, $line)
    {
        if ($this->emptyField($row->valor, 'nombre', 'valor', $line))
            if ($this->validPostName($row, $line))
                return true;
        return false;
    }

    public function validateObjectivesFields($row, $line)
    {
        if ($this->emptyField($row->objetivo, 'nombre', 'objetivo', $line))
            if ($this->validPostName($row, $line))
                return true;
        return false;
    }


    public function importUsers($users_file)
    {



        if ($users_file) :

            \Excel::selectSheets('PUESTOS')->load($users_file->getRealPath(), function($reader) {

                foreach ($reader->all() as $row) :

                        $this->postRepository->saveFromExcel($row, $this->evaluation_id, $this->lang, $this->client_id);

                endforeach;


            });

            \Excel::selectSheets('DATOS PARTICIPANTES')->load($users_file->getRealPath(), function($reader) {

                $line = 1;
                foreach ($reader->all() as $row) :

                    if ($this->validateUsersFields($row,$line)) :

                       $data = $this->userRepository->saveFromExcel($row, $this->client_id);
                       $data['evaluation_id'] = $this->evaluation_id;
                       $data['post_id'] = $this->getPostId($row->puesto);
                       $this->evaluationUserEvaluatorRepository->saveFromExcel($data);


                    endif;

                    $line++;
                endforeach;

            });

        endif;

    }

    public function getPostId($val){
        $post = Post::where('import_id',$val)->where('evaluation_id', $this->evaluation_id)->first();
        if ($post)
            return $post->id;
        return NULL;
    }

    public function importEvaluation($evaluation_file)
    {

        if ($evaluation_file) :

            \Excel::selectSheets('PUESTOS')->load($evaluation_file->getRealPath(), function($reader) {

                foreach ($reader->all() as $row) :

                        $this->postRepository->saveFromExcel($row, $this->evaluation_id, $this->lang, $this->client_id);


                endforeach;


            });

            \Excel::selectSheets('COMPETENCIAS')->load($evaluation_file->getRealPath(), function($reader) {
                $line = 1;
                foreach ($reader->all() as $row) :

                    if ($this->validateCompetitionsFields($row,$line)) :
                        $competition = $this->competitionRepository->saveFromExcel($row, $this->evaluation_id, $this->getPostId($row->puesto), $this->lang);

                        $this->behaviourRepository->saveFromExcel($row, $competition->id, $this->lang);

                    endif;
                $line++;
                endforeach;


            });

            \Excel::selectSheets('VALORES')->load($evaluation_file->getRealPath(), function($reader) {
                $line = 1;
                foreach ($reader->all() as $row) :

                    if ($this->validateValorationsFields($row,$line)) :

                        $this->valorationRepository->saveFromExcel($row, $this->evaluation_id, $this->getPostId($row->puesto), $this->lang);

                    endif;
                $line++;
                endforeach;


            });

            \Excel::selectSheets('OBJETIVOS')->load($evaluation_file->getRealPath(), function($reader) {
                $line = 1;
                foreach ($reader->all() as $row) :

                    if ($this->validateObjectivesFields($row,$line)) :

                        $this->objectiveRepository->saveFromExcel($row, $this->evaluation_id, $this->getPostId($row->puesto), $this->lang);

                    endif;
                $line++;
                endforeach;


            });

            \Excel::selectSheets('PDP')->load($evaluation_file->getRealPath(), function($reader) {

                foreach ($reader->all() as $row) :

                        $plan = $this->planRepository->saveFromExcel($row, $this->evaluation_id, $this->getPostId($row->puesto), $this->lang);

                        $this->actionRepository->saveFromExcel($row, $plan->id, $this->lang);

                endforeach;


            });

        endif;

    }

    public function hasErrors()
    {
        return (empty($this->errors)) ? false : true;
    }

    public function getErrors()
    {
        $result = null;
        foreach ($this->errors as $line => $errors)
             foreach ($errors as $error) {
                 $result .= '- '.$error.' en la linea '.$line.' (Archivo de participantes)<br>';
             }


        return $result;
    }

}

?>
