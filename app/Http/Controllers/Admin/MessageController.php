<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Repositories\MessageRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Client;

class MessageController extends AdminController
{
    /** @var  MessageRepository */
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepo)
    {
        $this->messageRepository = $messageRepo;
       
    }

    /**
     * Display a listing of the Message.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    
        $messages = $this->messageRepository->all();

        return view('admin.messages.index')
                      ->with('messages', $messages);
    }

    /**
     * Show the form for creating a new Message.
     *
     * @return Response
     */
    public function create()
    {
       
        return view('admin.messages.create')->with('clients', Client::lists('name','id')->prepend('Todos', ''));
    }

    /**
     * Store a newly created Message in storage.
     *
     * @param CreateMessageRequest $request
     *
     * @return Response
     */
    public function store(CreateMessageRequest $request)
    {
        $input = $request->all();

        $message = $this->messageRepository->create($input);

        Flash::success('Mensaje guardado correctamente');

        return redirect(route('messages.index'));
    }

    /**
     * Show the form for editing the specified Message.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $message = $this->messageRepository->findWithoutFail($id);
    
        if (empty($message)) {
            Flash::error('Mensaje no encontrado');
            return redirect(route('messages.index'));
        }

        
        return view('admin.messages.edit')->with('message', $message)
                                          ->with('clients', Client::lists('name','id')->prepend('Todos', ''));
    }

    /**
     * Update the specified Message in storage.
     *
     * @param  int              $id
     * @param UpdateMessageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMessageRequest $request)
    {
        $message = $this->messageRepository->findWithoutFail($id);

        if (empty($message)) {
            Flash::error('Mensaje no encontrado');

            return redirect(route('messages.index'));
        }

        $message = $this->messageRepository->update($request->all(), $id);

        Flash::success('Mensaje actualizado correctamente');

        return redirect(route('messages.index'));
    }

    /**
     * Remove the specified Message from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $message = $this->messageRepository->findWithoutFail($id);

        if (empty($message)) {
            Flash::error('Mensaje no encontrado');

            return redirect(route('messages.index'));
        }

        $this->messageRepository->delete($id);

        Flash::success('Mensaje eliminado correctamente');

        return redirect(route('messages.index'));
    }
}
