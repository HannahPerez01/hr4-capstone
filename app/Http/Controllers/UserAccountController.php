<?php
namespace App\Http\Controllers;

use App\Enum\UserRoleEnum;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAccountController extends Controller
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users     = $this->user->where('role', '!=', UserRoleEnum::EMPLOYEE->value)->get();
        $roleEnums = UserRoleEnum::toOptions();

        return view('content.pages.user-account', [
            'users'     => $users,
            'roleEnums' => $roleEnums,
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = $this->user->create([
            'name'     => $request->name,
            'password' => $request->password,
            'email'    => $request->email,
            'role'     => $request->role,
        ]);

        if (! $user) {
            return redirect()->back()->with('error', 'Failed to create user');
        }

        return redirect()->back()->with('success', 'User created successfully');
    }

    public function edit(string $id)
    {
        $user      = $this->user->find($id);
        $roleEnums = UserRoleEnum::toOptions();

        return view('content.pages.user-account-edit', [
            'user'      => $user,
            'roleEnums' => $roleEnums,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = $this->user->find($id)->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
        ]);

        if (! $user) {
            return redirect()->back()->with('error', 'Failed to update user');
        }

        return redirect()->route('user-account')->with('success', 'User updated successfully');
    }

    public function destroy(string $id)
    {
        $user = $this->user->find($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
