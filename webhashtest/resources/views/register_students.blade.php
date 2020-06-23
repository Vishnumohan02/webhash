@extends('Layout.head')

<style type="text/css">
  .nav-color{
        background-color: #4dff4d;
    }
</style>




@section('content')

<section>
  <nav class="navbar  nav-color">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="active"><a href="/">Home</a></li>
      
    </ul>
      <ul class="nav navbar-nav navbar-right">
      
      <li><a href="{{ url('/Logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
</section>
<div class="container">
  <h2 class="reg-head">Student Registration</h2>
  <p id="error"></p>
 
@if (Session::has('success'))
      <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
      </div>
      @endif

  <form id="form" name="form" method="post" action="{{ URL::to('students_register') }}" data-toggle="validator" class="contact-form text-left" enctype="multipart/form-data">
        {{ csrf_field() }}

    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" style="width: 500px;" id="name" placeholder="Enter Name" name="name" required maxlength="250">
    </div> 
    <div class="form-group">
      <label for="address">Address:</label>
      <input type="textarea" class="form-control" style="width: 500px;" id="address" placeholder="Enter Address" name="address" required maxlength="500">
    </div> 
    <div class="form-group">
      <label for="phnumber">Phone number:</label>
      <input type="text" class="form-control" style="width: 500px;" id="phnumber" placeholder="Enter Phone number" name="phnumber" required maxlength="250">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" style="width: 500px;" id="email" placeholder="Enter mail" name="email" required maxlength="100">
    </div>
    <div class="form-group">
      <label for="course">Course:</label>
      <input type="course" class="form-control" style="width: 500px;" id="course" placeholder="Enter Course" name="course" required maxlength="100">
    </div>
    <div class="form-group">
      <label for="uname">Username:</label>
      <input type="uname" class="form-control" style="width: 500px;" id="uname" placeholder="Enter Username" name="uname" required maxlength="50" >
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" style="width: 500px;" id="password" placeholder="Enter password" name="password" required maxlength="50" >
    </div>
    <div class="form-group">
      <label for="confirmpassword">Confirm Password:</label>
      <input type="password" class="form-control" style="width: 500px;" id="confirmpassword" placeholder="Confirm password" name="confirmpassword" required maxlength="50">
    </div>
    <div class="form-group ">
        <label for="certificate">Certificate:</label>                  
                <input class="form-control" style="width: 500px;" type="file" name="certificate" id="certificate">
    </div>
    
  
    <input type="submit" id="register" value="Register" class="btn btn-primary" name="register">
</form>
</div>
@endsection

@section('script')
<script type="text/javascript">

  $(document).ready(function(){
        $( "#form" ).validate({
                       rules: {
                      name: {
                               required: true
                              },
                      address: {
                               required: true
                              },
                      phnumber: {
                               required: true,
                               
                              },
                      password: {
                               required:true,
                               minlength: 5
                              },
                      confirmpassword: {
                               required:true,
                               minlength: 5,
                               equalTo : "#password"
                              },
                      email: {
                               required:true,
                               email:true
                             },
                      course: {
                               required: true
                              }
                      
                              },

                      messages: {
                      name: {
                              required: "Enter your username!"
                               },
                      address: {
                              required: "Enter your Address!"
                               },
                      phnumber: {
                              required: "Enter your Phone number!"
                               },
                      email: {
                              required:"Enter your email!",
                              email:"Invalid email"
                              },
                      course: {
                              required: "Enter your Course!"
                               },
                      uname: {
                              required: "Enter your Username!"
                               },
                      password: {
                              required:"Enter your password!",
                              minlength:"Minimum 5 characters!"
                              },
                      confirmpassword: {
                              required:"Confirm password!"
                              }
                                }
                    });
            });
</script>

@endsection