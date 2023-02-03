<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location;
use Illuminate\Support\Facades\DB;

use App\Models\staff;
use App\Models\User;
use App\Models\Employee;

use App\Http\Requests;
use App\Models\Schedule;
use App\Models\Latetime;
use App\Models\Locations;
use App\Models\Leave;
use App\Models\leaveStatus;
use App\Models\notification;
use App\Models\Attendance;

use App\Models\Admin;

class UserAuth extends Controller
{
    public function login(Request $req)
    {   
        $username = $req->username;
        $password = md5($req->password);
        $excpt = 'Incorrect username or password';
        $excptDV = 'Incorrect device';
        $excptLC = 'Incorrect Location';

        //$ip = $req->ip();
        //$ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
        $ip = '41.216.172.90';

        $MAC = $_COOKIE['user'];

        $userInfo = Location::get($ip);

        //dd($userInfo);

        if($ip == '41.216.172.90')
        {
            $user = Admin::where('name', $username)->count();

            if($user == 1)
            {
                $users = Admin::where('name', $username)->where('password', $password)->count();

                if($users == 1)
                {
                    $users = Admin::where('name', $username)->where('dataType', 'Admin')->count();
                
                    if($users)
                    {
                        $req->session()->put('username', $username);
                        $req->session()->put('Admin', $username);

                        $sql = "SELECT count(*) as timein FROM `schedules` WHERE username = '$username' AND date(time_in) = date(now())";

                        $results = DB::select($sql);

                        foreach($results as $result)
                        {
                            $checks = $result->timein;
                        }

                        if($checks == 0)
                        {
                            $timeIn = DB::select("INSERT INTO schedules(username, time_in) VALUES ('$username', NOW())");
                        }        

                        $users = Admin::where('name', $username)->where('mac_address', $MAC)->count();

                        if($users == 1)
                        {
                            $MAC = rand(1, 100000);
            
                            $cookie_name = "user";
                            $cookie_value = $MAC;
                            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                
                            $req->session()->put('MAC', $MAC);

                            $sql = "UPDATE users SET mac_address = '$MAC' WHERE name = '$username'";

                            $results = DB::select($sql);

                            return view("admin.account", compact("username"));
                        }

                        else
                        {
                            return view("auth.login", compact("excptDV"));
                        }
                    }

                    else
                    {
                        $req->session()->put('username', $username);

                        $sql = "SELECT count(*) as timein FROM `schedules` WHERE username = '$username' AND date(time_in) = date(now())";

                        $results = DB::select($sql);

                        foreach($results as $result)
                        {
                            $checks = $result->timein;
                        }

                        if($checks == 0)
                        {
                            $timeIn = DB::select("INSERT INTO schedules(username, time_in) VALUES ('$username', NOW())");
                        }        

                        //Dashboard statistics 
                        $totalEmp =  count(Employee::all());
                        $AllAttendance = count(Attendance::whereAttendance_date(date("Y-m-d"))->get());
                        $ontimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('1')->get());
                        $latetimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('0')->get());
                            
                        if($AllAttendance > 0)
                        {
                            $percentageOntime = str_split(($ontimeEmp/ $AllAttendance)*100, 4)[0];
                        }
                        
                        else 
                        {
                            $percentageOntime = 0;
                        }
                        
                        $data = [$totalEmp, $ontimeEmp, $latetimeEmp, $percentageOntime];
                        
                        $users = Admin::where('name', $username)->where('mac_address', $MAC)->count();

                        if($users == 1)
                        {
                            $MAC = rand(1, 100000);
            
                            $cookie_name = "user";
                            $cookie_value = $MAC;
                            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                
                            $req->session()->put('MAC', $MAC);

                            $sql = "UPDATE users SET mac_address = '$MAC' WHERE name = '$username'";

                            $results = DB::select($sql);
                            
                            return view('layouts.clockIn')->with(['data' => $data]);
                        }

                        else
                        {
                            return view("auth.login", compact("excptDV"));
                        }
                    }
                }

                else
                {
                    return view("auth.login", compact("excpt"));
                }
            }

            else
            {
                $user = staff::where('username', $username)->count();

                $pass = md5('remote+12');

                if($user != 0 && $password == $pass)
                {
                    return view("auth.amsLp", compact("username"));
                }

                elseif($user != 0 && $password != 'remote+12')
                {
                    return view("auth.login", compact("excpt"));
                }
                
                elseif($user == 0)
                {
                    return view("auth.login", compact("excpt"));
                }
            }
        }

        else
        {
            return view("auth.login", compact("excptLC"));
        }
    }

    public function clockOut(Request $request)
    {
        $username = $request->session()->get('username');

        $sql = "UPDATE schedules SET time_out = NOW() WHERE username = '$username' AND date(time_in) = date(now())";

        $results = DB::select($sql);

        return view("auth.login");
    }

    public function location(Request $request)
    {
        $ip = $request->ip();

        $ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
        $ip = '41.216.172.90';
        
        $MAC = exec('getmac');
        $MAC = strtok($MAC, ' ');

        $userInfo = Location::get($ip);

        dd($userInfo);

        $user = new Locations;   
        $user->latitude = $userInfo->latitude;
        $user->mac = $MAC;
        $user->longitude = $userInfo->longitude;
        
        $user->save(); 
    }

    public function fldLv(Request $request, $id)
    {
        $ip = $request->ip();
        dd($ip, $id); 
    }

    public function leave(Request $request)
    {
        $ip = $request->ip();

        $user = new Leave;   
        $user->username = $request->username;
        $user->Designation = $request->designation;
        $user->Department = $request->dept;
        $user->Branch = $request->branch;
        $user->Email = $request->email;
        $user->phone_no = $request->workphone;
        $user->leave_year = $request->year;
        $user->leave_type = $request->lvtype;
        $user->pay_allowance = $request->allowance;
        $user->Reason = $request->reason;
        $user->hod = $request->hod;
        $user->rlv = $request->rlv;
        $user->start_day = $request->c_day;
        $user->start_month = $request->c_month;
        $user->start_year = $request->c_year;
        $user->resumption_day = $request->r_day;
        $user->resumption_month = $request->r_month;
        $user->resumption_year = $request->r_year;
        $user->type = $request->type;
        
        $user->save();

        $username = $request->username;

        $sql = "SELECT * FROM leaves WHERE username = '$username' order by id desc limit 1";

        $results = DB::select($sql);

        foreach($results as $result)
        {
            $id = $result->id;
        }

        $user = new notification;

        $user->username = $request->username;
        $user->receiver = $request->hod;
        $user->type = 'Leave Request';
        $user->leave_id = $id;

        $user->save();

        $totalEmp =  count(Employee::all());
        $AllAttendance = count(Attendance::whereAttendance_date(date("Y-m-d"))->get());
        $ontimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('1')->get());
        $latetimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('0')->get());

        if($AllAttendance > 0){
            $percentageOntime = str_split(($ontimeEmp/ $AllAttendance)*100, 4)[0];
        }
        else {
            $percentageOntime = 0;
        }
        
        $data = [$totalEmp, $ontimeEmp, $latetimeEmp, $percentageOntime];

        return view('layouts.index')->with(['data' => $data]);
    }

    public function accountLogs(Request $req)
    {   
        $user = Admin::where('name', $req->username)->count();
        $excptDV = 'Incorrect device';

        if($user == 0)
        {
            $user = staff::where('username', $req->username)->count();
        
            $username = $req->username; 
            $password = $req->password;
            $rPassword = $req->rPassword;
            
            if($password = $rPassword)
            {
                if($user > 0)
                {
                    $MAC = rand(1, 100000);
            
                    $cookie_name = "user";
                    $cookie_value = $MAC;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        
                    $req->session()->put('MAC', $MAC);

                    $user = staff::where('username', $req->username)->where('usertype', 'ADMIN')->count();
                    
                    if($user > 0)
                    {
                        $user = new Admin;   
                        $user->name = $req->username;
                        $user->password = md5($password);
                        $user->mac_address = $MAC;
                        $user->dataType = 'ADMIN';
        
                        $user->save();
                    }

                    else
                    {
                        $user = new Admin;   
                        $user->name = $req->username;
                        $user->password = md5($password);
                        $user->mac_address = $MAC;
                        $user->dataType = 'STAFF';
        
                        $user->save();
                    }
                
                    // Admin::where('username', $username)
                    //     ->update([
                    //         'password' => md5($password),
                    //         'dataType' => 'ADMIN'
                    // ]);    
                
                        //should have kept this in a function, was pressed for time. 1

                    $req->session()->put('username', $username);

                    $sql = "SELECT count(*) as timein FROM `schedules` WHERE username = '$username' AND date(time_in) = date(now())";

                    $results = DB::select($sql);

                    foreach($results as $result)
                    {
                        $checks = $result->timein;
                    }

                    if($checks == 0)
                    {
                        $timeIn = DB::select("INSERT INTO schedules(username, time_in) VALUES ('$username', NOW())");
                    }        

                    //Dashboard statistics 
                    $totalEmp =  count(Employee::all());
                    $AllAttendance = count(Attendance::whereAttendance_date(date("Y-m-d"))->get());
                    $ontimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('1')->get());
                    $latetimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('0')->get());
                        
                    if($AllAttendance > 0)
                    {
                        $percentageOntime = str_split(($ontimeEmp/ $AllAttendance)*100, 4)[0];
                    }
                    
                    else 
                    {
                        $percentageOntime = 0;
                    }
                    
                    $data = [$totalEmp, $ontimeEmp, $latetimeEmp, $percentageOntime];
                    
                    return view('layouts.clockIn')->with(['data' => $data]);
                }  
            }
        }
    }

    public function prcLv(Request $req, $id)
    {
        $results = Leave::where('id', $id)->get();
        
        $notify = notification::where('receiver', $req->session()->get('username'))->orderBy('id', 'DESC')->take(10)->get();
        $count = count($notify);

        return view('layouts.Aleave')->with(['notes' => $results, 'notify' => $notify, 'count' => $count ]);
    }

    public function pLeave(Request $req)
    {    
        $username = $req->session()->get('username');
        $lid = $req->lid;

        $to = Leave::where('id', $lid)->get();

        foreach($to as $to)
        {
            $to = $to['username'];
        }

        $chk = staff::where('username', $req->hod)->where('usertype', 'ADMIN')->count();

        if($chk > 0)
        {
            return view('layouts.fsleave')->with(['username' => $username, 'to' => $to, 'lid' => $lid]);
        }

        else
        {
            $user = new notification;
        
            $user->username = $req->username;
            $user->receiver = $req->hod;
            $user->type = 'Leave Request';
            $user->leave_id = $req->lid;

            $user->save();

            $totalEmp =  count(Employee::all());
            $AllAttendance = count(Attendance::whereAttendance_date(date("Y-m-d"))->get());
            $ontimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('1')->get());
            $latetimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('0')->get());

            if($AllAttendance > 0){
                $percentageOntime = str_split(($ontimeEmp/ $AllAttendance)*100, 4)[0];
            }
            else {
                $percentageOntime = 0;
            }
            
            $data = [$totalEmp, $ontimeEmp, $latetimeEmp, $percentageOntime];

            return view('layouts.index')->with(['data' => $data]);
        }
    }

    public function fsLeave(Request $req)
    {    
        $lid = $req->lid;

        $sql = "SELECT count(*) as count FROM leave_status WHERE leave_id = '$lid'";

        $results = DB::select($sql);

        foreach($results as $result)
        {
            $count = $result->count;
        }

        if($count == 0)
        {
            $user = new leaveStatus;
    
            $user->from = $req->from;
            $user->to = $req->to;
            $user->subject = $req->subject;
            $user->leave_id = $req->lid;
            $user->response = $req->reason;
            $user->status = "Approved";

            $user->save();

            $user = new notification;
            
            $user->username = $req->from;
            $user->receiver = $req->to;
            $user->type = 'Leave Approval';
            $user->leave_id = $req->lid;

            $user->save();


            $totalEmp =  count(Employee::all());
            $AllAttendance = count(Attendance::whereAttendance_date(date("Y-m-d"))->get());
            $ontimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('1')->get());
            $latetimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('0')->get());

            if($AllAttendance > 0){
                $percentageOntime = str_split(($ontimeEmp/ $AllAttendance)*100, 4)[0];
            }
            else {
                $percentageOntime = 0;
            }
            
            $data = [$totalEmp, $ontimeEmp, $latetimeEmp, $percentageOntime];

            return view('layouts.index')->with(['data' => $data]);    
        }

        else
        {
            dd("You have processed this leave request");
        }
    }

    public function lsLeave(Request $req, $id)
    {
        $sql = "SELECT * FROM leave_status WHERE leave_id = '$id'";

        $results = DB::select($sql);

        return view('layouts.lsleave')->with(['results' => $results]);
    }
}
