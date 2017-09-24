<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserValidation;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display all users
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        //  get all users with roles
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Create new user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('admin.users.create');
    }

    /**
     * Store new user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserValidation $request) {
        return $request->all();
    }

    /**
     * Edit user
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {

    }

    /**
     * Update user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UserRequest $request) {

    }

    /**
     * Delete user
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {

    }

}
