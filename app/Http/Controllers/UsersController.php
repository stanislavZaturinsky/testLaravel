<?php

namespace App\Http\Controllers;

use App\Addresses;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller {

    public function index()
    {
        $users = DB::table('users')->paginate(10);
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Users $userModel, Addresses $addressModel, Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }

        $this->validate($request,
                        array_merge(Users::rules($request), Addresses::rules()),
                        array_merge(Users::messages(), Addresses::messages()));

        $userId = $userModel->create($request->all());
        if (isset($userId->id)) {
            $address = new Addresses([
                'postcode' => $request->get('postcode'),
                'country'  => $request->get('country'),
                'city'     => $request->get('city'),
                'street'   => $request->get('street'),
                'house'    => $request->get('house'),
                'office'   => $request->get('office'),
                'user_id'   => $userId->id
            ]);
            $address->save();

            \Session::flash('success', 'User created successfully');
            return response()->json(['success' => true]);
        } else {
            $request->session()->flash('alert-danger', 'User not saved');
        }
    }

    public function edit($id)
    {
        $user = Users::find($id);

        if (!$user) {
            return redirect('/')->with('error', 'User #' . $id . ' doesn\'t exist');
        }

        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, Users::rules($request), Users::messages());

        if(Users::find($id)->update($request->all())) {
            return redirect('/')->with('success', 'User #' . $id . ' updated successfully');
        } else {
            return redirect('/')->with('danger', 'User not updated');
        }
    }

    public function show($id)
    {
        $user      = Users::find($id);

        if (!$user) {
            return redirect('/')->with('error', 'User #' . $id . ' doesn\'t exist');
        }

        $addresses = Addresses::where('user_id', '=', $id)->paginate(5);

        return view('users.show', ['user' => $user, 'addresses' => $addresses]);
    }

    public function delete($id)
    {
        Users::findOrFail($id)->delete();
        return redirect('/')->with('success', 'User #' . $id . ' deleted successfully');
    }
}
