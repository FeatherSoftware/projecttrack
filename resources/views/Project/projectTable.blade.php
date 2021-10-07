<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="icon" href="Favicon.png">
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></script>
     <script src="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


    <title>ONDEZX</title>
</head>
<body style="background-image: url(image/l1.jpg);background-repeat:no-repeat;

   background-size:cover;background-attachment: fixed;
    background-position: center;"  >
 
    <style type="text/css">
  .avatars{
    vertical-align: middle;
    width: 40px;
    position: relative;
    height: 40px;
    margin: 0 auto;
    top: -2px;
    border-radius: 50%;
  }
 /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel " style="background-color:  #984463;">
        <div class="container">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                       <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                           
                             
                             @if(Session::get('EmployeeRole')=='Admin')
                              <li class="nav-item active">
                                    <a class="nav-link" href="{{ url('dashboard') }}">Dashboard</a>
                            </li>
                             <li class="nav-item active">
                                    <a class="nav-link" href="{{ url('employeeTable') }}">Employee</a>
                            </li>
                             
                           <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Projects
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('projectTable') }}">Projects</a>
                    <a class="dropdown-item" href="{{ url('clientTable') }}">Clients</a>
                       
                      </div>
                    </li>
                             @endif

                       

                       
                </ul>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                </button>
                
    


                <div class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn btn-success text-white" href="#" id="navbarDropdownacc" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Myaccount</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ url('ChangePassword') }}">Change Password</a>
                            <a class="dropdown-item" href="{{ url('/') }}">Logout</a>
                        </div>
                    </li>
                    </ul>
                </div>
    </div>
   
    </nav>
<br>    

    <div class="container bg-light pb-5">
        <br>
       
        
    <br>
    <br>
    @if (session('message'))
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
@endif
   <a href="{{ url('AddProject') }}"><button type="button" class="btn btn-primary">Add Project</button></a>
   <br>
     <br>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Client Name</th> 
                    <th>Start Date</th>
                    <th>Estimated Date</th>
                     <th>Assign Employee</th>
                     <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                    
                    
                </tr>
            </thead>
            <tbody>
              @foreach($project as $ProjectTable)
              <tr>
               
                <td>{{$ProjectTable->ProjectName}}</td>
                <td>{{$ProjectTable->ProjectClientName}}</td>
                <td>{{date('d-m-Y', strtotime($ProjectTable->ProjectStartDate))}}</td>
                <td>{{date('d-m-Y', strtotime($ProjectTable->ProjectEstimatedDate))}}</td>
                 <td>{{$ProjectTable->ProjectAssignEmployee}}</td>
                  <td>{{$ProjectTable->ProjectDescription}}</td>
                  <td>{{$ProjectTable->IsStarted}}</td>

              
               <td style='white-space: nowrap'> 
                    <a href="{{ url('EditProject/'.$ProjectTable->ProjectID) }}">
                      <button type="button" class="btn btn-success">Edit</button>
                    </a>
                    
                     <a href="{{ url('DeleteProject/'.$ProjectTable->ProjectID) }}">
                      <button type="button" class="btn btn-danger">Delete</button>
                    </a>
                </td>
            </tr>
  
              @endforeach
              
            </tbody>
    
      </table>
        
    </div>


</body>


</html>