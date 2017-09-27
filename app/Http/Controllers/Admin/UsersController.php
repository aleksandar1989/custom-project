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
    public function index()
    {
        //  get all users with roles
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Create new user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store new user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserValidation $request)
    {

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'status' => $request->input('status'),
            'password' => bcrypt($request->input('password')),
        ]);

        if ($user) {

            // sync roles
            $user->roles()->sync($request->input('role'));
            // upload avatar
            if ($request->file('avatar')) {
                $image = $request->file('avatar');
                $image_name ='avatar-'.$user->id.'.'.$image->getClientOriginalExtension();
                // get folder path
                $destinationPath = public_path('/images/users/');
                $image->move($destinationPath, $image_name);
                $user->setMeta('avatar', '/images/users/'.$image_name);
            }
            $notification = array(
                'message' => 'User is created successfully!',
                'type' => 'success'
            );

            return redirect('/admin/users')->with($notification);
        } else {
            $notification = array(
                'message' => 'User doesn\'t create!',
                'type' => 'error'
            );

            return redirect('admin/users/' . $user->id . '/edit')->with($notification);
        }
    }

    /**
     * Edit user
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        // get user by id
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserValidation $request, $id)
    {
        // get user by id
        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->status = $request->input('status');

        if($request->input('password')){
            $user->password = bcrypt($request->input('password'));
        }

        if($user->update()) {
            $user->roles()->sync($request->input('role'));

            $image = $request->file('avatar');

            // upload avatar
            if($image) {
                //  delete old avatar
                if( $user->meta('avatar') && file_exists(public_path($user->meta('avatar'))) ) {
                    unlink(public_path($user->meta('avatar')));
                }
                $user->unsetMeta('avatar');

                $image_name ='avatar-'.$user->id.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/users/');
                $image->move($destinationPath, $image_name);
                $user->setMeta('avatar', '/images/users/'.$image_name);
            }

            $notification = array(
                'message' => 'User is  successfully updated!',
                'type' => 'success'
            );

        } else{
            $notification = array(
                'message' => 'User doesn\'t update!',
                'type' => 'error'
            );

        }

        return redirect()->back()->with($notification);

    }


    /**
     * Delete user
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
        // get user
        $user = User::findOrFail($id);

        if($user->delete()) {
            //  delete avatar
            if( $user->meta('avatar') && file_exists(public_path($user->meta('avatar'))) ) {
                unlink(public_path($user->meta('avatar')));
            }
            $user->unsetMeta('avatar');

            $message = [
                'message' => 'User has been deleted.',
                'type' => 'success'
            ];
        } else {
            $message = [
                'message' => 'User has not been deleted.',
                'type' => 'danger'
            ];
        }

        return redirect()->back()->with($message);
    }
}
