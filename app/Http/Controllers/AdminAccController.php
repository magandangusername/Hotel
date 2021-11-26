<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminAccController extends Controller
{
    public function index (){
        $admins = DB::table('users')
        ->where('admin', '=', 1)
        ->get();

        return view('admin/manageaccounts/manageadmin')->with(compact('admins'));

    }

    public function modifyadminacc (Request $request){
        $admins = DB::table('users')
        ->where('admin', '=', 1)
        ->get();

        if ($request->input('deleteadminacc') !== null) {
            DB::table('users')
            ->where('id', $request->input('deleteadminacc'))
            ->delete();

            return redirect(route('adminacc').'?success=Admin Account has been deleted.');


        }

        if($request->input('editadminacc') !== null){
            $editadmin = DB::table('users')
            ->where('id', $request->input('editadminacc'))
            ->first();
            $edit = true;

            return view('admin/manageaccounts/manageadmin')->with(compact('admins', 'editadmin', 'edit'));

        }

        if ($request->input('submitedit') !== null) {
            $request->validate([
                'password' => 'required'

            ]);

            DB::table('users')
            ->where('id', $request->input('submitedit'))
            ->update(['password' => Hash::make($request->input('password'))]);

            return redirect(route('adminacc').'?success=Admin Account password has been edited.');


        }

        if($request->input('addadminacc') !== null){
            $add = true;

            return view('admin/manageaccounts/manageadmin')->with(compact('admins', 'add'));

        }

        if ($request->input('submitadd') == "submitadd") {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);
            $check = DB::table('users')
            ->where('email', $request->input('email'))
            ->count();

            if($check >= 1){
                return redirect(route('adminacc').'?error=Email is already taken.');
            }

            DB::table('users')
            ->insert([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'admin' => 1
            ]);

            return redirect(route('adminacc').'?success=Admin Account password has been created.');


        }




        return redirect(route('adminacc'));

    }
}
