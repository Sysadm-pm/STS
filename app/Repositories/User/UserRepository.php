<?php
namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Carbon;
use Auth;
use DB;

/**
 * Class UserRepository
 * @package App\Repositories\User
 */
class UserRepository implements UserRepositoryContract
{

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return User::findOrFail($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * @return mixed
     */
    public function getAllUsersWithEmails()
    {
        return User::all()
        ->pluck('nameAndEmail', 'id');
    }

    /**
     * @param $requestData
     * @return static
     */
    public function create($requestData)
    {

        $user = New User();
        $user->name = $requestData->name;
        $user->email = $requestData->email;
        $user->address = $requestData->address;
        $user->password = bcrypt($requestData->password);
        $user->save();

        // Session::flash('flash_message', 'User successfully added!'); //Snippet in Master.blade.php
        return $user;
    }

    /**
     * @param $id
     * @param $requestData
     * @return mixed
     */
    public function update($id, $requestData)
    {
        $user = User::findorFail($id);
        $password = bcrypt($requestData->password);

            if ($requestData->password == "") {
                $input =  array_replace($requestData->except('password'));
            } else {
                $input =  array_replace($requestData->all(), ['password'=>"$password"]);
            }

        $user->fill($input)->save();

        // Session::flash('flash_message', 'User successfully updated!');

        return $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {

        try {
            $user = User::findorFail($id);
            $user->delete();
            // Session()->flash('flash_message', 'User successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            Session()->flash('flash_message_warning', 'User can NOT have, leads, clients, or tasks assigned when deleted');
        }
    }
}
