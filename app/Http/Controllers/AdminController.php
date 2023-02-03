<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Employee;
use App\Models\Latetime;
use App\Models\Attendance;
use App\Models\notification;


class AdminController extends Controller
{
    public function index(Request $req)
    {
        //Dashboard statistics 
        $totalEmp =  count(Employee::all());
        $AllAttendance = count(Attendance::whereAttendance_date(date("Y-m-d"))->get());
        $ontimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('1')->get());
        $latetimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('0')->get());

        $notify = notification::where('receiver', $req->session()->get('username'))->orderBy('id', 'DESC')->take(10)->get();
        $count = count($notify);
            
        if($AllAttendance > 0){
                $percentageOntime = str_split(($ontimeEmp/ $AllAttendance)*100, 4)[0];
            }else {
                $percentageOntime = 0 ;
            }
        
        $data = [$totalEmp, $ontimeEmp, $latetimeEmp, $percentageOntime];

        if(session()->has('Admin'))
        {
            return view('admin.index')->with(['data' => $data, 'notify' => $notify, 'count'=> $count]);
        }
        
        else
        {
            return redirect('login');
        }
    }
}
