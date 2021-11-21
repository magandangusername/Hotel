<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCancellationsController extends Controller
{
    public function index (){
        $cancellations = DB::table('cancellation_requests')
        ->where('approval_status', '!=', 'approved')
        ->where('approval_status', '!=', 'denied')
        ->get();

        return view('admin/managereservations/cancellations')->with(compact('cancellations'));

    }

    public function approvedeny (Request $request){
        $cancellations = DB::table('cancellation_requests')
        ->where('approval_status', '!=', 'approved')
        ->where('approval_status', '!=', 'denied')
        ->get();

        if($request->input('deny') == 'deny') {
            DB::table('cancellation_requests')
            ->where('id', $request->input('id'))
            ->update([
                'approval_status' => 'denied',
                'approved_denied_on' => date("Y-m-d H:s:i", strtotime('now'))
            ]);
            return redirect('admin/cancellation?success=Cancellation has been denied!');
        }
        if($request->input('approve') == 'approve') {
            DB::table('cancellation_requests')
            ->where('id', $request->input('id'))
            ->update([
                'approval_status' => 'approved',
                'approved_denied_on' => date("Y-m-d H:s:i", strtotime('now'))
            ]);
            return redirect('admin/cancellation?success=Cancellation has been approved!');
        }

        // return view('admin/managereservations/cancellations')->with(compact('cancellations'));
        return redirect('admin/cancellation');

    }
}
