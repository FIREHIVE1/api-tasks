<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Group;
use App\User;
use App\userGroups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class GroupController
 *
 * @package App\Http\Controllers\v1
 */
class GroupController extends Controller
{
    /**
     * Get group list
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        try {
            $user = $this->validateSession();

            $userGroups = userGroups::where('user_id', $user->id)->get();
            $collection = collect();

            foreach ($userGroups as $ug) {
                $collection->push($ug->group_id);
            }

            $groups = Group::whereIn('id', $collection)->paginate(10);
            $groupsOwned = Group::where('owner_id', $user->id)->get();


            return $this->returnSuccess($groups);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Create a group
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $user = $this->validateSession();

            $rules = [
                'name' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if (!$validator->passes()) {
                return $this->returnBadRequest('Please fill all required fields');
            }

            $group = new Group();
            $group->name = $request->name;
            $group->owner_id = $user->id;
            $group->save();

            $userGroups = new userGroups();
            $userGroups->user_id = $user->id;
            $userGroups->group_id = $group->id;
            $userGroups->save();

            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Update group
     *
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $user = $this->validateSession();

            $group = Group::find($id);

            if ($group->owner_id !== $user->id) {
                return $this->returnError('You don\'t have permission to modify this group');
            }

            if ($request->has('name')) {
                $group->name = $request->name;
            }

            $group->save();

            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Delete group
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            $user = $this->validateSession();

            $group = Group::find($id);

            if ($group->owner_id !== $user->id) {
                return $this->returnError('You don\'t have permission to delete this group');
            }
            $userGroups = userGroups::where('group_id', $group->id);

            $group->delete();
            $userGroups->delete();
            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    public function getUsers($id){
        try {

            $group = Group::find($id);

            $users = userGroups::where('group_id',$group->id)->get();

            return $this->returnSuccess($users);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Add user to group
     * @param $id
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addUser($id, $user_id)
    {
        try {
            $user = $this->validateSession();

            $group = Group::find($id);

            if(!$check = userGroups::where('user_id',$user->id)->where('group_id',$group->id)->first()){
                return $this->returnError('You don\'t have permission to add people to this group');
            }

            $user_to_add = User::find($user_id);
            $userGroups = new userGroups();
            $userGroups->user_id = $user_to_add->id;
            $userGroups->group_id = $group->id;

            $userGroups->save();
            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Remove user from the group
     * @param $id
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeUser($id, $user_id)
    {
        try {
            $user = $this->validateSession();

            $group = Group::find($id);

            if ($group->owner_id !== $user->id) {
                return $this->returnError('You don\'t have permission to remove people from this group');
            }

            $user_to_remove = User::find($user_id);
            $userGroups = userGroups::Where('user_id',$user_to_remove->id);

            $userGroups->delete();
            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }
}


