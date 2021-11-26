<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminGuestAccController extends Controller
{
    public function index (){
        $users = DB::table('users')
        ->where('admin', '!=', 1)
        ->get();

        return view('admin/manageaccounts/manageguest')->with(compact('users'));

    }

    public function modifyguestacc (Request $request){
        $users = DB::table('users')
        ->where('admin', '!=', 1)
        ->get();

        if ($request->input('deleteguestacc') !== null) {
            DB::table('users')
            ->where('id', $request->input('deleteguestacc'))
            ->delete();

            return redirect(route('adminguestacc').'?success=Guest Account has been deleted.');


        }

        if($request->input('editguestacc') !== null){
            $edituser = DB::table('users')
            ->where('id', $request->input('editguestacc'))
            ->first();
            $edit = true;

            return view('admin/manageaccounts/manageguest')->with(compact('users', 'edituser', 'edit'));

        }

        if ($request->input('submitedit') !== null) {
            $request->validate([
                'password' => 'required'

            ]);

            DB::table('users')
            ->where('id', $request->input('submitedit'))
            ->update(['password' => Hash::make($request->input('password'))]);

            return redirect(route('adminguestacc').'?success=Guest Account password has been edited.');


        }

        if($request->input('addguestacc') !== null){
            $add = true;

            return view('admin/manageaccounts/manageguest')->with(compact('users', 'add'));

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
                return redirect(route('adminguestacc').'?error=Email is already taken.');
            }
            DB::table('users')
            ->insert([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'admin' => 0
            ]);

            return redirect(route('adminguestacc').'?success=Guest Account password has been created.');


        }




        return redirect(route('adminguestacc'));

    }
}
