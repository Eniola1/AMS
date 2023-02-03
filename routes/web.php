<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FingerDevicesControlller;
use App\Http\Controllers\UserAuth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Attendance;
use App\Models\Latetime;
use App\Models\Employee;
use App\Models\notification;
use App\Models\Schedule;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('attended/{user_id}', '\App\Http\Controllers\AttendanceController@attended' )->name('attended');
Route::get('attended-before/{user_id}', '\App\Http\Controllers\AttendanceController@attendedBefore' )->name('attendedBefore');

Route::get('/amsLp', function () {
    return view('auth.amsLp');
});

Route::get('/account', function () {
    return view('admin.account');
});

Route::get('/Aleave', function (Request $req) {
    return view('layouts.rleave')->with(['username' => $req->session()->get('username')]);
});

Auth::routes(['register' => false, 'reset' => false]);

Route::post("IGI", [UserAuth::class, 'login']);
Route::post("Leave", [UserAuth::class, 'leave']);
Route::post("aCheck", [UserAuth::class, 'accountLogs']);
Route::get("clockOut", [UserAuth::class, 'clockOut']);
Route::post("clockOut", [UserAuth::class, 'clockOut']);
Route::get("location", [UserAuth::class, 'location']);


Route::group(['middleware'=> ['aProtectedPage']],function(){
    
});

Route::group(['middleware'=> ['protectedPage']],function(){

    Route::resource('/employees', '\App\Http\Controllers\EmployeeController');
    Route::resource('/employees', '\App\Http\Controllers\EmployeeController');
    
    Route::get('/employee', function (Request $req) {

        $notify = notification::where('receiver', $req->session()->get('username'))->orderBy('id', 'DESC')->take(10)->get();
        $count = count($notify);
        
        return view('layouts.clockIn')->with(['notify' => $notify, 'count'=> $count]);
    });

    Route::get('/clockIn', function (Request $req) {

        $notify = notification::where('receiver', $req->session()->get('username'))->orderBy('id', 'DESC')->take(10)->get();
        $count = count($notify);

        return view('layouts.clockIn')->with(['notify' => $notify, 'count'=> $count]);
    });

    Route::get('/Echeckin', function () {
        return view('layouts.echeckin');
    });

    Route::get('/ncheckin', function () {
        return view('layouts.ncheckin');
    });
    
    Route::get('/rcheckin', function () {
        return view('layouts.rcheckin')->with(['latetimes' => Latetime::all()]);
    });

    Route::get('/scheckin', function () {
        return view('layouts.scheckin')->with(['latetimes' => Latetime::all()]);
    });

    Route::get('/Eleave', function (Request $req) {

        $dept = "";
        return view('layouts.eLeave')->with(['username' => $req->session()->get('username')]);
    });

    Route::get("pleave/{id}", [UserAuth::class, 'prcLv']);

    Route::get("lsleave/{id}", [UserAuth::class, 'lsleave']);

    Route::post("/pleave/prLeave", [UserAuth::class, 'pleave']);

    Route::post("/pleave/fsLeave", [UserAuth::class, 'fsleave']);

    Route::get("fleave/{id}", [UserAuth::class, 'fldLv']);

    Route::get('/Echeck', '\App\Http\Controllers\CheckController@employee')->name('check');

    Route::get('/Esheet', '\App\Http\Controllers\CheckController@sheetReports')->name('sheet-report');

    Route::get('/Eovertime', function () {
        return view('layouts.eOvertime');
    });

    Route::get('emp', function () {
        
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
    });

    Route::get('/Eattendance', function () {
        return view('layouts.check')->with(['employees' => Employee::all()]);;
    });

    Route::get('/Elatetime', function () {
        return view('layouts.late')->with(['latetimes' => Latetime::all()]);
    });

    Route::get('/Elogs', function (Request $request) {
        $username = $request->session()->get('username'); 
        return view('layouts.logs')->with(['attendances' => Schedule::all()->where('username', $username)]);
    });

    Route::get('/attendance', function () {
        if(session()->has('Admin'))
        {
            return view('admin.attendance')->with(['attendances' => Schedule::all()]);
        }
        
        else
        {
            return redirect('login');
        } 
    });
});

//Route::group(['middleware' => ['auth', 'Role'], 'roles' => ['admin']], function () {
    Route::get('/admin', '\App\Http\Controllers\AdminController@index')->name('admin');
    //Route::get('/attendance', '\App\Http\Controllers\AttendanceController@index')->name('attendance');

    Route::get('/latetime', '\App\Http\Controllers\AttendanceController@indexLatetime')->name('indexLatetime');
    Route::get('/leave', '\App\Http\Controllers\LeaveController@index')->name('leave');
    Route::get('/overtime', '\App\Http\Controllers\LeaveController@indexOvertime')->name('indexOvertime');

    Route::resource('/schedule', '\App\Http\Controllers\ScheduleController');

    Route::get('/check', '\App\Http\Controllers\CheckController@index')->name('check');

    Route::get('/sheet-report', '\App\Http\Controllers\CheckController@sheetReport')->name('sheet-report');
    Route::post('check-store','\App\Http\Controllers\CheckController@CheckStore')->name('check_store');
    
    // Fingerprint Devices
    Route::resource('/finger_device', '\App\Http\Controllers\BiometricDeviceController');

    Route::delete('finger_device/destroy', '\App\Http\Controllers\BiometricDeviceController@massDestroy')->name('finger_device.massDestroy');
    Route::get('finger_device/{fingerDevice}/employees/add', '\App\Http\Controllers\BiometricDeviceController@addEmployee')->name('finger_device.add.employee');
    Route::get('finger_device/{fingerDevice}/get/attendance', '\App\Http\Controllers\BiometricDeviceController@getAttendance')->name('finger_device.get.attendance');
    // Temp Clear Attendance route
    Route::get('finger_device/clear/attendance', function () {
        $midnight = \Carbon\Carbon::createFromTime(23, 50, 00);
        $diff = now()->diffInMinutes($midnight);
        dispatch(new ClearAttendanceJob())->delay(now()->addMinutes($diff));
        toast("Attendance Clearance Queue will run in 11:50 P.M}!", "success");

        return back();
    })->name('finger_device.clear.attendance'); 

//});

Route::group(['middleware' => ['auth']], function () {

    //Route::get('/home', 'HomeController@index')->name('home');

});

// Route::get('/attendance/assign', function () {
//     return view('attendance_leave_login');
// })->name('attendance.login');

// Route::post('/attendance/assign', '\App\Http\Controllers\AttendanceController@assign')->name('attendance.assign');


// Route::get('/leave/assign', function () {
//     return view('attendance_leave_login');
// })->name('leave.login');

// Route::post('/leave/assign', '\App\Http\Controllers\LeaveController@assign')->name('leave.assign');


// Route::get('{any}', 'App\http\controllers\VeltrixController@index');