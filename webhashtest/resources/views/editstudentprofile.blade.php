@extends('layout.head')
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
      
      <li><a href="{{ url('/Logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
</section>

<section style="text-align: center;">
  <div>
    <h3>Edit student profile</h3>
  </div>
<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form id="form" name="form" method="post" action="{{ url('update',$studentdata->userId) }}" data-toggle="validator"  enctype="multipart/form-data" autocomplete="off">
       							 {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="name" class="form-control" name="name" value="{{ $studentdata->stdName }}" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="email" id="email" class="form-control" name="email" value="{{ $studentdata->email }}" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="address" name="address" class="form-control" value="{{ $studentdata->address }}" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phnumber" class="col-md-4 col-form-label text-md-right">Phone number</label>
                                    <div class="col-md-6">
                                        <input type="text" id="phnumber" name="phnumber" class="form-control" value="{{ $studentdata->phone }}" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="course" class="col-md-4 col-form-label text-md-right">Course</label>
                                    <div class="col-md-6">
                                        <input type="text" id="course" name="course" class="form-control" value="{{ $studentdata->course }}" >
                                    </div>
                                </div>

                  <div class="form-group row">
						        <label for="certificate" class="col-md-4 col-form-label text-md-right" >Certificate:</label>  
						        <div class="col-md-6">
                      @if($studentdata->cname != "")
                       <div id="certificate_display" class="col-md-6">
						        <img  src="{{ asset('/storage/certificate/'.$studentdata->cname) }}"  width="150" height="200" alt="">
                    <input type="hidden" name="userid" value="{{ $studentdata->userId }}">
                    <input type="hidden" name="tokenno" value="{{ csrf_token() }}">
                    <input type="hidden" name="oldcertificate" value="{{ $studentdata->cname }}">
                    <a onclick='destroy()' class="deleteProduct" data-id="{{$studentdata->userId}}" data-token="{{ csrf_token() }}" >Delete </a>
                     </div>
                       @endif  
                      @if($studentdata->cname == "")         
                <input class="form-control"  type="file" name="certificate" id="certificate">
                      @endif
					          </div>
							    </div>

                       <div class="form-group row">
                          <label for="uname" class="col-md-4 col-form-label text-md-right">Username</label>
                            <div class="col-md-6">
                              <input type="text" id="uname" name="uname" class="form-control" value="{{ $studentdata->uname }}" >
                            </div>
                       </div>

                         <div class="form-group row">
                          <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                              <input type="password" id="password" name="password" class="form-control" value="{{ $studentdata->password }}" >
                            </div>
                       </div>

                                <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                        Save
                                        </button>
                                       <a href="{{ url('cancel',$studentdata->id) }}" class="btn btn-danger"> 
                                        cancel
                                        </button>
                                    </a>
                                    </div>
                                    </form>
                                </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>

</section>

@endsection

@section('script')
<script type="text/javascript">

  $(document).ready(function(){
        $( "#form" ).validate({
                       rules: {
                      name: {
                               required: true
                              },
                      email: {
                               required:true,
                               email:true
                             },
                      address: {
                               required:true,
                              },
                      course: {
                               required:true,
                              }
                      
                              },

                      messages: {
                      name: {
                              required: "Enter your Name!"
                               },
                      email: {
                              required:"Enter your email!",
                              email:"Invalid email"
                              },
                      password: {
                              required:"Enter your password!",
                              minlength:"Minimum 5 characters!"
                              },
                      address: {
                              required:"Enter address!"
                              },
                      course: {
                              required:"Enter course!"
                              }
                                }
                    });
            });
</script>

<script type="text/javascript">


  function destroy(){
        var id = $('input[name="userid"]').val();
        var token = $('input[name="tokenno"]').val()
        $.ajax(
        {
            url: "certificate/delete/"+id,
            type: 'PUT',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
            success: function (response)
            {
                alert("Data deleted");
                location.reload();
            }
        });

    };

</script>

@endsection
