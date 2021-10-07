<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>ONDEZX</title>
    <style type="text/css"></style>
</head>
<body style="background-image: url(image/l1.jpg);background-repeat:no-repeat;

   background-size:cover;background-attachment: fixed;
    background-position: center;"  >
    <main class="login-form" >
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-header">
                      <div class="text-center">
                        <b>Login</b>
                      </div>
                    </div>
                    <div class="card-body">
                    <div class="text-center">
                      <img src="image/logo.png">
                    </div>
                    <br>
                     <br>
                       @if (session('login_error'))
                            <div class="alert alert-danger">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('login_error') }}
                            </div>
                        @endif
                        @if (session('password_Change'))
                            <div class="alert alert-danger">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('password_Change') }}
                            </div>
                        @endif
                        <form method="post" action="{{ url('login') }}">
                         {{ csrf_field() }}
                                                      
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-4">
                                    <input type="email" id="EmployeeEmail" class="form-control" name="EmployeeEmail" value="{{old('EmployeeEmail')}}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-4">
                                    <input type="password" id="EmployeePassword" class="form-control" name="EmployeePassword"  required>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-5">
                            <p id="verification_msg" style="display:none;color: red">User Name/Password is Incorrect</p>
                                <button type="submit" class="btn btn-primary" style=" background-color: #f98a00:" id="loginsubmit">
                                    Login
                                </button>
                            </div></form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</main>

 <script>
$(document).ready(function(event){
 
 $('#validate_form').on('submit', function(event){
  event.preventDefault();
  var EmployeeEmailAddress=$('#EmployeeEmailAddress').val();
  alert(EmployeeEmailAddress);
 });
});
</script>
</body>
</html>