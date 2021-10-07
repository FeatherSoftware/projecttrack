<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class LoginController extends Controller
{
    public function login(Request $request) {
    	
    	$input=$request->all();

    	
    	$EmployeeEmail=$input['EmployeeEmail'];
    	$EmployeePassword=$input['EmployeePassword'];
        
    	$EmployeeLogIn=DB::table('employee')->where([['EmployeeEmail', '=', $EmployeeEmail],['EmployeePassword', '=', $EmployeePassword]])->first();
    	
    	
    	if($EmployeeLogIn){
                $EmployeeID=$EmployeeLogIn->EmployeeID;
                $EmployeeRole=$EmployeeLogIn->EmployeeRole;
                session(['EmployeeID' => $EmployeeID]);
                session(['EmployeeRole' => $EmployeeRole]);
                //dd($EmployeeRole);
                $date=date("Y-m-d");
                $EmployeeAttendanceFirst=DB::table('employee_attendance')->where([['EmployeeAttendanceEmpID', '=', $EmployeeID],['EmployeeAttendanceDate', '=', $date]])->first();
                
                if($EmployeeRole=='Admin')
                {
                     return redirect('/employeeTable')->with('EmployeeEmail',$EmployeeEmail);
                }
                else{
                          if($EmployeeAttendanceFirst==null)
                        {
                        return redirect('/employeeattendance')->with('EmployeeEmail',$EmployeeEmail);
                        }
                        else{
                         return redirect('/attendanceTable')->with('EmployeeEmail',$EmployeeEmail);
                        }
                }
              
    	 
    	}
    	else{
    		 return back()->with('login_error','Username/Password is in correct');
    	}
     
   }
}
