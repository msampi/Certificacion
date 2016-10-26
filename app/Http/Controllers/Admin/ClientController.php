<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ClientController extends AdminBaseController
{
    /** @var  clientRepository */
    private $clientRepository;

    public function __construct(ClientRepository $clientRepo)
    {
        parent::__construct();
        $this->clientRepository = $clientRepo;
    }

    /**
     * Display a listing of the Client.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->clientRepository->pushCriteria(new RequestCriteria($request));
        $clients = $this->clientRepository->all();

        return view('admin.clients.index')
            ->with('clients', $clients);
    }

    /**
     * Show the form for creating a new Client.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created Client in storage.
     *
     * @param CreateClientRequest $request
     *
     * @return Response
     */
    public function store(CreateClientRequest $request)
    {
        $input = $request->all();

        $input['logo'] = $this->uploadImage($request, 'logo');

        $clients = $this->clientRepository->create($input);

        Flash::success($this->dictionary->translate('Cliente guardado correctamente'));

        return redirect()->route('clients.index');
    }


    /**
     * Show the form for editing the specified client.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $client = $this->clientRepository->findWithoutFail($id);

        if (empty($client)) {
            Flash::error($this->dictionary->translate('Cliente no encontrado'));

            return redirect(route('clients.index'));
        }


        return view('admin.clients.edit')->with('client', $client);
    }

    /**
     * Update the specified client in storage.
     *
     * @param  int              $id
     * @param UpdateClientRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClientRequest $request)
    {
        $client = $this->clientRepository->findWithoutFail($id);

        if (empty($client)) {
            Flash::error($this->dictionary->translate('Cliente no encontrado'));

            return redirect(route('clients.index'));
        }

        $input = $request->all();

        if ($image = $this->uploadImage($request, 'logo'))
            $input['logo'] = $image;

        $client = $this->clientRepository->update($input, $id);

        Flash::success($this->dictionary->translate('Cliente actualizado correctamente'));

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified client from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $client = $this->clientRepository->findWithoutFail($id);

        if (empty($client)) {
            Flash::error($this->dictionary->translate('Cliente no encontrado'));

            return redirect(route('clients.index'));
        }
        if ($client->logo && $client->logo != 'client.png')
          unlink(base_path() . '/public/uploads/' . $client->logo);

        $this->clientRepository->delete($id);

        Flash::success($this->dictionary->translate('Cliente eliminado correctamente'));

        return redirect(route('clients.index'));
    }
}
