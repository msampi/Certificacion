<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Repositories\CompetencyRepository;
use App\Repositories\AutoperceptionRepository;
use App\Repositories\QuestionaryRepository;
use App\Http\Requests;
use App\Models\Client;
use App\Library\ExcelImport;
use Illuminate\Http\Request;
use Flash;


class HomeController extends AdminController
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $competencyRepository;
    private $autoperceptionRepository;
    private $questionaryRepository;
    
    public function __construct(CompetencyRepository $competencyRepo,
                                AutoperceptionRepository $autoperceptionRepo,
                                QuestionaryRepository $questionaryRepo)
    {

        $this->competencyRepository = $competencyRepo;
        $this->autoperceptionRepository = $autoperceptionRepo;
        $this->questionaryRepository = $questionaryRepo;

    }
    public function index()
    {
        return view('admin.home')->with('clients',Client::lists('name','id')->prepend('Todos',0));
    }
    
    public function upload(Request $request)
    {
        $excel = new ExcelImport(NULL,NULL,$this->competencyRepository, $this->autoperceptionRepository, $this->questionaryRepository );
        $excel->setClient($request->get('client_id'));
        
        $excel->importData($request->file('data_excel'));
        
        if ($excel->hasErrors())
            Flash::error('Problemas encontrados en archivos de importacion:<br>'.$excel->getErrors());
        else
            Flash::success('Importación realizada exitosamente');
        return view('admin.home')->with('clients',Client::lists('name','id')->prepend('Todos',0));
        
    }
}
