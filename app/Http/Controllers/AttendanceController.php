<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    public function employeeattendance(Request $request) {
    	
    	$EmpID=Session::get('EmployeeID');
        $Employee=DB::table('employee')->where('EmployeeID', $EmpID)->get();
        //dd($Employee);
        
        return view('addattendance')->with('Employee', $Employee);;
   }
    public function addAttendance(Request $request) {
    	$input=$request->all();
    	$EmployeeAttendanceEmpID=$input['EmpID'];
    	
    	
    	$EmployeeAttendanceDate=date('Y-m-d', strtotime($input['EmployeeAttendanceCheckIn']));
    	$EmployeeAttendanceCheckIN=date('h:i', strtotime($input['EmployeeAttendanceCheckIn']));
    	//dd($input['EmployeeAttendanceCheckIn']);
    	DB::table('employee_attendance')->insert(['EmployeeAttendanceEmpID' => $EmployeeAttendanceEmpID, 'EmployeeAttendanceDate' => $EmployeeAttendanceDate,'EmployeeAttendanceCheckIN'=>$EmployeeAttendanceCheckIN,'EmployeeAttendanceType'=>'Present','CreatedOn'=> date("Y-m-d H:i:s"),'CreatedBy'=>$EmployeeAttendanceEmpID]);
       

         return redirect('/attendanceTable')->with('message', 'Have a Good Day and Start Your Nice Work');
       

    }
     public function attendanceTable(Request $request) {
        
        $EmpID=Session::get('EmployeeID');
        $date=date("Y-m-d");
        

        $EmployeeAttendance=DB::table('employee_attendance')->where('EmployeeAttendanceEmpID', $EmpID)->orderBy('EmployeeAttendanceID', 'DESC')->get();
         $EmployeeAttendanceFirst=DB::table('employee_attendance')->where([['EmployeeAttendanceEmpID', '=', $EmpID],['EmployeeAttendanceDate', '=', $date]])->first();
         $Employee=DB::table('employee')->where('EmployeeID',$EmpID)->first();
        //dd($Employee);
        
        return view('attendanceTable')->with('Employee', $Employee)->with('EmployeeAttendance',$EmployeeAttendance)->with('EmployeeAttendanceFirst',$EmployeeAttendanceFirst);
   }
  
    public function updateAttendance(Request $request) {
       $input=$request->all();
        $EmployeeAttendanceEmpID=Session::get('EmployeeID');
        $EmployeeAttendanceID=$input['EmployeeAttendanceID'];
        $date=date("Y-m-d");
        $EmployeeAttendanceDate=date('Y-m-d', strtotime($input['EmployeeAttendanceCheckOut']));
        $EmployeeAttendanceCheckOut=date('h:i', strtotime($input['EmployeeAttendanceCheckOut']));
        DB::table('employee_attendance')->where([['EmployeeAttendanceEmpID', '=', $EmployeeAttendanceEmpID],['EmployeeAttendanceID','=',$EmployeeAttendanceID],['EmployeeAttendanceDate', '=', $date]])->update(['EmployeeAttendanceDate' => $EmployeeAttendanceDate,'EmployeeAttendanceCheckOut'=>$EmployeeAttendanceCheckOut]);
        
        return redirect()
                        ->back()
                        ->with('success', 'Your message has been sent successfully!');
       
   }
    public function attendanceTrack(Request $request) {
       $input=$request->all();
        
        $date=date("Y-m-d");
        
        $EmpValue=DB::table('employee_attendance')->join('employee', 'employee.EmployeeID', '=', 'employee_attendance.EmployeeAttendanceID')->where('EmployeeAttendanceDate',$date)->get();
        //dd($EmpValue);
        
        return redirect()
                        ->back()
                        ->with('success', 'Your message has been sent successfully!');
       
   }
}
