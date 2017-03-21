<?php

namespace App\Library;

use App\Repositories\EvaluationUserRepository;
use App\Repositories\UserRepository;
use App\Repositories\CompetencyRepository;
use App\Repositories\AutoperceptionRepository;
use App\Repositories\QuestionaryRepository;
use App\Models\Rating;
use App\Models\Evaluation;

class ExcelImport {

    private $errors;
    private $evaluation_id;
    private $client_id;
    private $userRepository;
    private $evaluationUserRepository;
    private $competencyRepository;
    private $autoperceptionRepository;
    private $questionaryRepository;


    public function __construct(UserRepository $userRepo = NULL,
                                EvaluationUserRepository $evaluationUserRepo = NULL,
                                CompetencyRepository $competencyRepo = NULL,
                                AutoperceptionRepository $autoperceptionRepo = NULL,
                                QuestionaryRepository $questionaryRepo = NULL)
    {

        $this->errors = array();
        $this->userRepository = $userRepo;
        $this->evaluationUserRepository = $evaluationUserRepo;
        $this->competencyRepository = $competencyRepo;
        $this->autoperceptionRepository = $autoperceptionRepo;
        $this->questionaryRepository = $questionaryRepo;

    }

    public function setClient($client_id)
    {
        $this->client_id = $client_id;
    }
    
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
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

    public function validateUsersFields($row, $line)
    {
       if ($this->validEmail($row->email,$line))
                return true;
        return false;
    }
    
    public function validateCompetencyDataFields($row, $line)
    {
       $errors = false;
       if ($row->id_competencia == ''){
           $this->errors[$line][] = 'La competencia no tiene id de importacion'; 
           $errors = true;
       }
       if ($row->competencia == ''){
           $this->errors[$line][] = 'La competencia no tiene nombre'; 
           $errors = true;
       }
    
       if ($errors)
           return false;
       return true;
    }
    
    public function validateQuestionaryDataFields($row, $line)
    {
       $errors = false;
       if ($row->id_conocimiento == ''){
           $this->errors[$line][] = 'El formulario de conocimientos no tiene id de importacion'; 
           $errors = true;
       }
       if ($row->nombre == ''){
           $this->errors[$line][] = 'El formulario de conocimientos no tiene nombre'; 
           $errors = true;
       }
    
       if ($errors)
           return false;
       return true;
    }
    
    public function existRating($name)
    {
        $rating = Rating::where('name',$name)->first();
        if ($rating)
            return true;
        return false;
    }
    
    public function validateAutoperceptionDataFields($row, $line)
    {
       $errors = false;
       if ($row->id_autopercepcion == ''){
           $this->errors[$line][] = 'El formulario de autopercepcion no tiene id de importacion'; 
           $errors = true;
       }
       if ($row->nombre == ''){
           $this->errors[$line][] = 'El formulario de autopercepcion no tiene nombre'; 
           $errors = true;
       }
        
       if (!$this->existRating($row->rating)){
           $this->errors[$line][] = 'El rating no existe en formulario de autopercepcion'; 
           $errors = true;
       }
    
       if ($errors)
           return false;
       return true;
    }



    public function importUsers($users_file)
    {

        

        if ($users_file) :

            \Excel::selectSheets('DATOS USUARIOS')->load($users_file->getRealPath(), function($reader) {

                $line = 1; 
                
                foreach ($reader->all() as $row) :
                    
                    if ($this->validateUsersFields($row,$line)) :
                       
                       $data = $this->userRepository->saveFromExcel($row, $this->client_id);
                       $data['evaluation_id'] = $this->evaluation_id;
                       $this->evaluationUserRepository->saveFromExcel($data);


                    endif;

                    $line++;
                endforeach;

            });

        endif;

    }

   
    public function importData($evaluation_file)
    {

        if ($evaluation_file) :

            \Excel::selectSheets('COMPETENCIAS')->load($evaluation_file->getRealPath(), function($reader) {
                $line = 1;
                foreach ($reader->all() as $row) :
                    if ($this->validateCompetencyDataFields($row,$line)) :
                        $this->competencyRepository->saveFromExcel($row, $this->client_id);
                    endif;
                $line++;
                endforeach;


            });
            
        
        
            \Excel::selectSheets('CONOCIMIENTOS')->load($evaluation_file->getRealPath(), function($reader) {
                $line = 1;
                foreach ($reader->all() as $row) :
                    if ($this->validateQuestionaryDataFields($row,$line)) :
                        $this->questionaryRepository->saveFromExcel($row, $this->client_id);
                    endif;
                $line++;
                endforeach;


            });
        
            \Excel::selectSheets('AUTOPERCEPCION')->load($evaluation_file->getRealPath(), function($reader) {
                $line = 1;
                foreach ($reader->all() as $row) :

                    if ($this->validateAutoperceptionDataFields($row,$line)) :

                        $this->autoperceptionRepository->saveFromExcel($row, $this->client_id);

                    endif;
                $line++;
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
                 $result .= '- '.$error.' en la linea '.$line.'<br>';
             }


        return $result;
    }

}

?>
