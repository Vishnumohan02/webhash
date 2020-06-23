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
      
      <li><a href="{{ url('/Logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
</section>

<section>
    <div class="container-fluid">
         <!-- START DATATABLE 1 -->
         <form name="list" id="list" method="post" action="" >
             {{ csrf_field() }}
             <input type="hidden" name="action" id="action" value="">
         <div class="row">
                <div class="col-lg-12">
                     <div class="panel panel-default">
                            <div class="panel-body">
                                
                                 <table id="datatable1" class="table table-bordered table-hover">
                                        <thead>
                                             <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Course</th>
                                                    
                                                    
                                                    <th class="sort-numeric">Edit</th>
                                                    <th>Delete</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                            <!-- InsetTbody -->
                                            @foreach ($studentslists as $studentslist)
                                                <tr class="gradeX">
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    
                                                    <td>{{ $studentslist->stdName }}</td>
                                                    <td>{{ $studentslist->course }}</td>
                                                    
                                                   
                                                    <td class="row list-icon">
                                                        <a href="{{ URL::to('student_edit',$studentslist->userId) }}" class="btn btn-success edtbtn"> Edit </a>
                                                    </td>

                                                    <td class="row list-icon">
                                                        <a href="{{ URL::to('delete',$studentslist->userId) }}" class="btn btn-danger deletebtn"> Delete </a>
                                                    </td>                                                
                                             </tr>
                                            @endforeach
                                        </tbody>
                                 </table>
                            </div>
                     </div>
                </div>
         </div>
         </form>
         <!-- END DATATABLE 1 -->
    </div>
</section>


@endsection
