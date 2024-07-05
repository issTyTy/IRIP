<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\DTO\UserDTO;
use App\Repository\UserRepository;
use App\Repository\Interfaces\IUserRepository;


class UserController extends Controller
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


// showing all data
    public function all(){
return response()->json(User::all());
}

//selecting
public function show($id)
{
  return response()->json(User::findOrFail($id));
}

//deleteing
public function delete($id)
{
 $User = User::findOrFail($id);
 $User -> delete();
 return response()->json([
'message' => 'has been deleted'
]);
}

// storing
public function insert(UserRequest $UserRequest){

$userDTO = UserDTO::from($UserRequest->all());
$user = $this->userRepository->createUser($userDTO);
return response()->json([
'message' => 'new record has been created'
], 201);
}


// edit/update
public function update(Request $request, $id)
{
 $User = User::findOrFail($id);
 $data = $request->validate([
'name' => 'required',
'email' => 'required',
'password'=>'required'
]);

$User->name = $data['name'];
$User->description = $data['description'];
$User->password = $data['password'];

$User->save();

return response()->json([
'message' => 'record updated'
], 201);

}
}
