<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct(protected UserRepositoryInterface  $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store', 'addPermissionToRole', 'givePermissionToRole']]);
        $this->middleware('permission:user-edit', ['only' => ['update', 'edit']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $users =$this->userRepository->getAllUsers();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {

        $roles = Role::pluck('name', 'name')->all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(AdminRequest $request)
    {  
        $attributes = $request->only([
            'name',
            'email',
            'roles'
        ]);
        $attributes['password'] = bcrypt($request->password);

       $this->userRepository->createUser($attributes)->syncRoles($request->roles);
       
        return to_route('users.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(User $user)
    {
        $user = User::findOrFail($user->id);
        $roles = Role::pluck('name')->all();
        $userRoles = $user->roles->pluck('name')->all();

        return view('admin.users.edit', compact('user', 'roles','userRoles' ));
    }

    public function update(Request $request, User $user)
    {
        $attributes = $request->only([
            'name',
            'email',
        ]);

        if (!empty($request->password)) {
            $attributes['password'] = bcrypt($request->password);
        }

        $this->userRepository->updateUser($user, $attributes);
        $user->syncRoles($request->roles);

        return to_route('users.index');
    }

    public function destroy(User $user)
    {
        $this->userRepository->deleteUser($user);
        return to_route('users.index');
    }
    public function logout()
    {
        return redirect('login');
    }


}
