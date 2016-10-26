<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateMessageRequest;
use App\Criteria\ClientCriteria;
use App\Criteria\ClientEmptyCriteria;
use App\Http\Requests\UpdateMessageRequest;
use App\Repositories\MessageRepository;
use App\Repositories\LanguageRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MessageController extends AdminBaseController
{
    /** @var  MessageRepository */
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepo)
    {
        $this->messageRepository = $messageRepo;
        parent::__construct();
        if ($this->superadmin)
          $this->clients->prepend('Todos', '');
    }

    /**
     * Display a listing of the Message.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->messageRepository->pushCriteria(new ClientCriteria($this->superadmin));
        $this->messageRepository->pushCriteria(new ClientEmptyCriteria($this->superadmin));
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
        $languages = $this->languageRepository->all();
        return view('admin.messages.create')->with('languages', $languages)
                                            ->with('clients', $this->clients)
                                            ->with('disabled', NULL);
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

        Flash::success($this->dictionary->translate('Mensaje guardado correctamente'));

        return redirect(route('admin.messages.index'));
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
        $languages = $this->languageRepository->all();

        if (empty($message)) {
            Flash::error($this->dictionary->translate('Mensaje no encontrado'));
            return redirect(route('admin.messages.index'));
        }

        $disabled = (!$message->client_id && !$this->superadmin) ? 'disabled' : 'false';
        return view('admin.messages.edit')->with('message', $message)
                                          ->with('languages', $languages)
                                          ->with('clients', $this->clients)
                                          ->with('disabled', $disabled);
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
            Flash::error($this->dictionary->translate('Mensaje no encontrado'));

            return redirect(route('admin.messages.index'));
        }

        $message = $this->messageRepository->update($request->all(), $id);

        Flash::success($this->dictionary->translate('Mensaje actualizado correctamente'));

        return redirect(route('admin.messages.index'));
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
            Flash::error($this->dictionary->translate('Mensaje no encontrado'));

            return redirect(route('messages.index'));
        }

        $this->messageRepository->delete($id);

        Flash::success($this->dictionary->translate('Mensaje eliminado correctamente'));

        return redirect(route('messages.index'));
    }
}
