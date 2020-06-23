@extends('Layout.head')
<style type="text/css">
	.nav-color{
        background-color: #4dff4d;
    }
</style>
<style type="text/css">
  body{
    margin: 0;
    font-size: .9rem;
    font-weight: 400;
    line-height: 1.6;
    color: #212529;
    text-align: left;
    background-color: #f5f8fa;
}

.navbar-laravel
{
    box-shadow: 0 2px 4px rgba(0,0,0,.04);
}

.navbar-brand , .nav-link, .my-form, .login-form
{
    font-family: Raleway, sans-serif;
}

.my-form
{
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.my-form .row
{
    margin-left: 0;
    margin-right: 0;
}

.login-form
{
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.login-form .row
{
    margin-left: 0;
    margin-right: 0;
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
    @if($userdata->role == "student")
      <li><a href="{{ url('edit',$profiledata->userId) }}"><span class="glyphicon glyphicon-user"></span> Edit profile</a></li>
    @endif

    @if($userdata->role == "admin")
      <li><a href="{{ url('/view_students') }}"><span class="glyphicon glyphicon-user"></span> Students</a></li>

      <li><a href="{{ url('/Register-students') }}"><span class="glyphicon glyphicon-user"></span> Add Students</a></li>
    @endif
      <li><a href="{{ url('/Logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
</section>

@if($userdata->role == "student")
<section style="text-align: center;">
  <div>
    <h3>Welcome to your profile</h3>
  </div>

  @if (Session::has('success'))
      <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
      </div>
      @endif
<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="name" class="form-control" name="full-name" value="{{ $profiledata->stdName }}" readonly="readonly">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email-address" value="{{ $profiledata->email }}" readonly="readonly">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="address" class="form-control" value="{{ $profiledata->address }}" readonly="readonly">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phnumber" class="col-md-4 col-form-label text-md-right">Phone number</label>
                                    <div class="col-md-6">
                                        <input type="text" id="phnumber" class="form-control" value="{{ $profiledata->phone }}" readonly="readonly">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="course" class="col-md-4 col-form-label text-md-right">Course</label>
                                    <div class="col-md-6">
                                        <input type="text" id="course" class="form-control" value="{{ $profiledata->course }}" readonly="readonly">
                                    </div>
                                </div>

                                @if($profiledata->cname != "")
                                 <div class="form-group row">
                                <label for="certificate" class="col-md-4 col-form-label text-md-right" >Certificate:</label>  
                                <div class="col-md-6">
                                <img  src="{{ asset('/storage/certificate/'.$profiledata->cname) }}"  width="100" alt="">  

                                <button class="dwnld-page-btn"><a href="{{ URL::to('download',$profiledata->userId) }}">Download <i class="fa fa-download"></i></a></button>              
                                 </div>
                                </div>
                                @endif
                                </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>

</section>
@endif
@endsection
