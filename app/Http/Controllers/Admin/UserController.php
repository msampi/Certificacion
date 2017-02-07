<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Library\EmailSend;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Client;
use App\Models\Role;
use Auth;


class UserController extends AdminController
{
    /** @var  UserRepository */
    private $userRepository;



    public function __construct(UserRepository $userRepo)
    {
        
        $this->userRepository = $userRepo;

    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$this->userRepository->pushCriteria(new ClientCriteria($this->superadmin));
        $users = $this->userRepository->all();

        return view('admin.users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {

        return View( 'admin.users.create', array(
                                        'clients' => Client::lists('name', 'id'),
                                        'roles' => Role::lists('name', 'id'),
                                        'action' => 'create'
                                     )
                        );
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {

        $this->validate($request, [
            'email' => 'required|unique:users',
            'code' => 'required|unique:users'
        ]);

        $input = $request->all();

        $input['image'] = $this->uploadFile($request, 'image');
        $pass = 'admin';
        $input['password'] = $pass;
        $user = $this->userRepository->create($input);
        /*if ($input['role_id'] == 2) :
            $email = new EmailSend($user->register_message_id, NULL, $user, $pass);
            $email->send();
        endif;*/


        Flash::success('El usuario se ha guardado correctamente');

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado');
            return redirect()->route('admin.users.index');
        }


        return View( 'admin.users.edit', array(
                                        'user' => $user,
                                        'clients' => Client::lists('name','id'),
                                        'roles' => Role::lists('name', 'id'),
                                        'action' => 'edit'
                                     )
                        );
    }



    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {

        $this->validate($request, [
            'email' => 'required|unique:users,email,'.$id,
            'code' => 'required|unique:users,code,'.$id,
        ]);


        $user = $this->userRepository->findWithoutFail($id);


        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect()->route('users.index');
        }

        $input = $request->all();

        if ($image = $this->uploadFile($request, 'image'))
            $input['image'] = $image;

        $user = $this->userRepository->update($input, $id);

        Flash::success('El usuario se ha editado correctamente');

        return redirect()->route('users.index');


    }



    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        if ($user->image && $user->image != 'user.png')
          unlink(base_path() . '/public/uploads/' . $user->image);

        $this->userRepository->delete($id);

        Flash::success('El usuario se ha eliminado correctamente');

        return redirect()->route('users.index');
    }
}
