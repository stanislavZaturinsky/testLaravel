<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Addresses;

class AddressesController extends Controller
{
    public function create($userId)
    {
        return view('addresses.create', ['userId' => $userId]);
    }

    public function store(Addresses $addressModel, $userId, Request $request)
    {
        $this->validate($request, Addresses::rules(), Addresses::messages());

        if($addressModel->create($request->all())) {
            return redirect('/users/show/' . $userId)->with('success', 'Address created successfully');
        } else {
            return redirect('/users/show/' . $userId)->with('danger', 'Address not created');
        }
    }

    public function edit($id)
    {
        $address = Addresses::find($id);

        if (!$address) {
            return redirect('/')->with('error', 'Address #' . $id . ' doesn\'t exist');
        }

        return view('addresses.edit', ['address' => $address, 'userId' => $address->user_id]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, Addresses::rules(), Addresses::messages());

        $address = Addresses::find($id);
        if($address->update($request->all())) {
            return redirect('/users/show/' . $address->user_id)->with('success', 'Address updated successfully');
        } else {
            return redirect('/users/show/' . $address->user_id)->with('danger', 'Address not updated');
        }
    }

    public function delete($id)
    {
        $address = Addresses::find($id);

        if (!$address) {
            return redirect('/')->with('error', 'Address #' . $id . ' doesn\'t exist');
        }

        $userId = $address->user_id;
        $address->delete();
        return redirect('/users/show/' . $userId)->with('success', 'Address #' . $id . ' deleted successfully');
    }
}
