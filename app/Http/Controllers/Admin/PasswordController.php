<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StorePassword;

class PasswordController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('admin.password.edit');

    }

    /**
     * Update the admin password
     *
     * @param  StorePassword $request
     * @return \Illuminate\Http\Response
     */
    public function update(StorePassword $request)
    {
        $user = User::where('email', 'info@serdcespb.ru')->first();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $request->session()->flash('success', 'Пароль успешно изменен!');

        return redirect()->route('admin.password.edit');
    }

}
