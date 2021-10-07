<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;


class EmployeeController extends Controller
{
     public function employeeTable(Request $request) {
        $employee=DB::table('employee')->where('IsDelete',Null)->get();
       
         return view('Employee/employeeTable')->with('employee', $employee);

     }
      public function AddEmployee(Request $request) 
      {
       
        
         return view('Employee/AddEmployee');

     }
     public function dashboard(Request $request) 
      {
        $date=date("Y-m-d");
        $Employee=DB::table('employee')->where('EmployeeID','!=',1)->get();
      
       
         return view('dashboard')->with('Employee',$Employee);

     }
      public function SubmitEmployee(Request $request) 
      {
       
           
  
         $input=$request->all();
         $EmployeeName=$input['EmployeeName'];
          $EmployeeEmail=$input['EmployeeEmail'];
          $EmployeePassword=$input['EmployeePassword'];
          $EmployeePhoneNumber=$input['EmployeePhoneNumber'];
          $EmployeeAddress=$input['EmployeeAddress'];
          $EmployeeDepartment=$input['EmployeeDepartment'];
          $EmployeeRole=$input['EmployeeRole'];

        $imageName = time().'.'.$request->image->extension();  
   
        $request->image->move(public_path('images'), $imageName);


         DB::table('employee')->insert(['EmployeeName' => $EmployeeName, 'EmployeeEmail' => $EmployeeEmail,'EmployeePassword'=>$EmployeePassword,'EmployeePhoneNumber'=>$EmployeePhoneNumber,'EmployeeAddress'=>$EmployeeAddress,'EmployeeDepartment'=>$EmployeeDepartment,'EmployeeRole'=>$EmployeeRole,'CreatedOn'=> date("Y-m-d H:i:s"),'CreatedBy'=>'Admin','EmployeeImage'=>$imageName]);
         return redirect('employeeTable')->with('message', 'Employee Added Successfully');

     }
     public function ChangePassword(Request $request)
      {
                $EmpID=Session::get('EmployeeID');
                $Employee=DB::table('employee')->where('EmployeeID', $EmpID)->first();
                 return view('Employee/ChangePassword')->with('Employee',$Employee);
        }
     public function UpdatePassword(Request $request)
      {
          $input=$request->all();
          //dd($input);
                $EmployeeID=$input['EmployeeID'];
                $EmployeePassword=$input['EmployeePassword'];
                $Employee=DB::table('employee')->where('EmployeeID', $EmployeeID)->update(['EmployeePassword'=>$EmployeePassword]);
                 return redirect('/')->with('password_Change','Success! Login With Your New Password');
        }
     public function EditEmployee($ID,Request $request)
      {
               
                $Employee=DB::table('employee')->where('EmployeeID', $ID)->first();
                 return view('Employee/EditEmployee')->with('Employee',$Employee);
        }
       public function UpdateEmployee(Request $request)
      {
          $input=$request->all();
          //dd($input);
                $EmployeeID=$input['EmployeeID'];

                 $EmployeeName=$input['EmployeeName'];
                    $EmployeeEmail=$input['EmployeeEmail'];
                   
                    $EmployeePhoneNumber=$input['EmployeePhoneNumber'];
                    $EmployeeAddress=$input['EmployeeAddress'];
                    $EmployeeDepartment=$input['EmployeeDepartment'];
                    $EmployeeRole=$input['EmployeeRole'];
                $Employee=DB::table('employee')->where('EmployeeID', $EmployeeID)->update(['EmployeeName' => $EmployeeName, 'EmployeeEmail' => $EmployeeEmail,'EmployeePhoneNumber'=>$EmployeePhoneNumber,'EmployeeAddress'=>$EmployeeAddress,'EmployeeDepartment'=>$EmployeeDepartment,'EmployeeRole'=>$EmployeeRole]);
                 return redirect('employeeTable')->with('message','Success! Your Data Updated Successfully');
          }
           public function DeleteEmployee($ID,Request $request)
      {
               
                $Employee=DB::table('employee')->where('EmployeeID', $ID)->update(['IsDelete'=>1]);
                  return redirect('employeeTable')->with('message','Success! Your Data Deleted Successfully');
        }
}
