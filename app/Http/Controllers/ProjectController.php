<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;


class ProjectController extends Controller
{
     public function projectTable(Request $request) {
        $project=DB::table('project')->where('IsDelete',Null)->get();
       
         return view('Project/projectTable')->with('project', $project);

     }
      public function AddProject(Request $request) 
      {
         $employee=DB::table('employee')->where('IsDelete',Null)->where('EmployeeID','!=',1)->get();
         $client=DB::table('client')->where('IsDelete',Null)->get();
        
         return view('Project/AddProject')->with('employee', $employee)->with('client',$client);

     }
     
      public function SubmitProject(Request $request) 
      {
       
           
  
         $input=$request->all();
        
         $ProjectName=$input['ProjectName'];
         $ProjectStartDate = str_replace('/', '-', $input['ProjectStartDate']);
        $ProjectStartDate= date('Y-m-d', strtotime($ProjectStartDate));
          
           $ProjectEstimatedDate = str_replace('/', '-', $input['ProjectEstimatedDate']);
        $ProjectEstimatedDate= date('Y-m-d', strtotime($ProjectEstimatedDate));
          $ProjectDescription=$input['ProjectDescription'];
          $ProjectAssignEmployee=$input['ProjectAssignEmployee'];
          $ProjectClientName=$input['ProjectClientName'];
         
         DB::table('project')->insert(['ProjectName' => $ProjectName,'ProjectClientName'=>$ProjectClientName,'ProjectStartDate' => $ProjectStartDate,'ProjectEstimatedDate'=>$ProjectEstimatedDate,'ProjectDescription'=>$ProjectDescription,'ProjectAssignEmployee'=>$ProjectAssignEmployee,'CreatedOn'=> date("Y-m-d H:i:s"),'CreatedBy'=>'Admin']);
         return redirect('projectTable')->with('message', 'Project Added Successfully');

     }
     
     public function EditProject($ID,Request $request)
      {
               
                $Project=DB::table('project')->where('ProjectID', $ID)->first();
                $employee=DB::table('employee')->where('IsDelete',Null)->get();
                 return view('Project/EditProject')->with('Project',$Project)->with('employee',$employee);
        }
       public function UpdateProject(Request $request)
      {
          $input=$request->all();
          //dd($input);
                $ProjectID=$input['ProjectID'];

                $ProjectName=$input['ProjectName'];
                $ProjectStartDate=$input['ProjectStartDate'];
                $ProjectEstimatedDate=$input['ProjectEstimatedDate'];
                $ProjectDescription=$input['ProjectDescription'];
                $ProjectAssignEmployee=$input['ProjectAssignEmployee'];
                $Employee=DB::table('project')->where('ProjectID', $ProjectID)->update(['ProjectName' => $ProjectName, 'ProjectStartDate' => $ProjectStartDate,'ProjectEstimatedDate'=>$ProjectEstimatedDate,'ProjectDescription'=>$ProjectDescription,'ProjectAssignEmployee'=>$ProjectAssignEmployee,'ModifiedOn'=> date("Y-m-d H:i:s"),'ModifiedBy'=>'Admin']);
                 return redirect('projectTable')->with('message','Success! Your Data Updated Successfully');
          }
           public function DeleteProject($ID,Request $request)
      {
               
                $Employee=DB::table('project')->where('ProjectID', $ID)->update(['IsDelete'=>1]);
                  return redirect('projectTable')->with('message','Success! Your Data Deleted Successfully');
        }
         public function clientTable(Request $request) {
        $client=DB::table('client')->where('IsDelete',Null)->get();
       
         return view('Client/clientTable')->with('client', $client);

     }
      public function AddClient(Request $request) 
      {
         $client=DB::table('client')->where('IsDelete',Null)->get();
        
         return view('Client/AddClient')->with('client', $client);

     }
     
      public function SubmitClient(Request $request) 
      {
       
           
  
         $input=$request->all();
         
         $ClientName=$input['ClientName'];
          $ClientEmail=$input['ClientEmail'];
          $ClientPassword=$input['ClientPassword'];
          $ClientPhoneNumber=$input['ClientPhoneNumber'];
         
         DB::table('client')->insert(['ClientName' => $ClientName, 'ClientEmail' => $ClientEmail,'ClientPassword'=>$ClientPassword,'CreatedOn'=> date("Y-m-d H:i:s"),'CreatedBy'=>'Admin','ClientPhoneNumber' => $ClientPhoneNumber]);
         return redirect('clientTable')->with('message', 'Client Added Successfully');

     }
     
     public function EditClient($ID,Request $request)
      {
               
                $client=DB::table('client')->where('ClientID', $ID)->first();
               
                 return view('Client/EditClient')->with('client',$client);
        }
       public function UpdateClient(Request $request)
      {
          $input=$request->all();
          //dd($input);
                $ClientID=$input['ClientID'];

               $ClientName=$input['ClientName'];
          $ClientEmail=$input['ClientEmail'];
          $ClientPassword=$input['ClientPassword'];
          $ClientPhoneNumber=$input['ClientPhoneNumber'];
                $Employee=DB::table('client')->where('ClientID', $ClientID)->update(['ClientName' => $ClientName, 'ClientEmail' => $ClientEmail,'ClientPassword'=>$ClientPassword,'ModifiedOn'=> date("Y-m-d H:i:s"),'ModifiedBy'=>'Admin','ClientPhoneNumber' => $ClientPhoneNumber]);
                 return redirect('clientTable')->with('message','Success! Your Data Updated Successfully');
          }
           public function DeleteClient($ID,Request $request)
      {
               
                $Employee=DB::table('client')->where('ClientID', $ID)->update(['IsDelete'=>1]);
                  return redirect('clientTable')->with('message','Success! Your Data Deleted Successfully');
        }
        public function client(Request $request) {
          return view('Client\client');

        }
        public function clientLogin(Request $request) {
      
      $input=$request->all();

      
      $ClientEmail=$input['ClientEmail'];
      $ClientPassword=$input['ClientPassword'];
        
      $ClientLogIn=DB::table('client')->where([['ClientEmail', '=', $ClientEmail],['ClientPassword', '=', $ClientPassword]])->first();
      
      
      if($ClientLogIn){
               
                       
                         return redirect('/ProjectTicket');
                       
              
       
      }
      else{
         return back()->with('login_error','Username/Password is incorrect');
      }
     
   }

    public function ProjectEmployee(Request $request) {
      $input=$request->all();
         $EmpID=Session::get('EmployeeID');
         $Employee=DB::table('employee')->where('EmployeeID',$EmpID)->first();
         $EmployeeName= $Employee->EmployeeName;
         $project=DB::table('project')->where('ProjectAssignEmployee',$EmployeeName)->get();
          return view('Project/ProjectEmployee')->with('project', $project);

        }
    public function ProjectStart($id,Request $request) {
          $ProjectStartedTime=date('Y-m-d h:i:s');
          $ProjectEmployee=DB::table('project')->where('ProjectID',$id)->update(['IsStarted'=>'Started','ProjectStartedTime'=>$ProjectStartedTime]);

          return back()->with('message', 'Project Started Successfully');;

        }
  public function ProjectComplete($id,Request $request) {
    
         
          $ProjectEmployee=DB::table('project')->where('ProjectID',$id)->first();
         $ProjectStartedTime= $ProjectEmployee->ProjectStartedTime;
         $ProjectEndTime=date('Y-m-d H:i:s');
         $ProjectTimeDifference=(new Carbon($ProjectEndTime))->diff(new Carbon($ProjectStartedTime))->format('%h:%I');
        //dd($ProjectTimeDifference);
         $ProjectEmployee=DB::table('project')->where('ProjectID',$id)->update(['IsStarted'=>'Completed','ProjectEndTime'=>$ProjectEndTime,'ProjectTotalHours'=>$ProjectTimeDifference]);
          return back()->with('message', 'Project Completed Successfully');;

        }
}
