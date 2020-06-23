<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\user;
use App\StudentDetails;
use App\StudentCertificate;
use Session;
use App\Libraries\Helper;
use File;

class AdminController extends Controller
{
   public function register()
    {
        return  view('Register');
    }

   public function store(Request $request)
    {

        $validator        = Validator::make($request->all(), [
            'uname'   => 'required',
            'password' => 'required',
            'email' => 'required|email'
        ]);
        if ($validator->fails()) {
           return back()->withErrors($validator);
        }

              $users                = new user;
              $users->name   = $request->input('uname');      
              $users->password   = bcrypt($request->input('password'));
              $users->email    = $request->input('email');
              $users->role     = "admin";

              // Save users
              $users->save();


              $data['success'] = "New admin created";

              return view('index',$data);
              return redirect()->view('index',$data);

    } 

    public function register_students()
    {
        return  view('register_students');
    }

    public function students_register(Request $request)
    {
      $validator        = Validator::make($request->all(), [
            'name'    => 'required',
            'address'  => 'required',
            'phnumber'  => 'required',
            'course'   => 'required',
            'uname'   => 'required',
            'password' => 'required',
            'email' => 'required|email'
        ]);
        if ($validator->fails()) {
           return back()->withErrors($validator);
          }

        if($request->file('certificate')) 
        {  //print_r($request->certificate->getClientOriginalName());exit;
            $file = $request->file('certificate');
            //print_r($file->get);exit;
            $filename = time() . '_' .$request->certificate->getClientOriginalName(); 
            $request->file('certificate')->storeAs('public/certificate', $filename);
            
            //Storage::put('certificate/'.$filename, $file);
        }

              $users                = new user;
              $users->name   = $request->input('uname');      
              $users->password   = bcrypt($request->input('password'));
              $users->email    = $request->input('email');
              $users->role     = "student";

              // Save users
              $users->save();

              $student_details  = new StudentDetails;
              $student_details->userId  = $users->id;
              $student_details->stdName = $request->input('name');
              $student_details->address  = $request->input('address');
              $student_details->phone  = $request->input('phnumber');
              $student_details->course = $request->input('course');

              $student_details->save();

              if(!empty($filename)){

              $student_certificate  = new StudentCertificate;
              $student_certificate->userId = $users->id;
              $student_certificate->cname  = $filename;

              $student_certificate->save();
            }
              Session::flash('success', 'New student registered');

              return  view('register_students');


    }

    public function profileedit($id)
    {
     // DB::enableQueryLog(); 

          $data['profiledata'] =  StudentDetails::leftjoin('users', 'student_details.userId','=', 'users.id')
                          -> select('userId','stdName','address','phone','course','users.email','users.password','users.name as uname')
                          ->where('userId',$id)
                           ->first();
     //$query = DB::getQueryLog(); print_r($query); exit;

            return view('editprofile',$data);

    }

    public function view()
    {
      // DB::enableQueryLog();
      

      $data['studentslists'] = StudentDetails::select('userId','stdName','course')
                            ->get();
      //$query = DB::getQueryLog(); print_r($query); exit;
      return view('viewstudents',$data);


    }

    public function student_edit($id)
    {



          $data['studentdata'] = user::leftjoin('student_details', 'users.id','=', 'student_details.userId')
                          ->leftjoin('student_certificate','users.id','=','student_certificate.userId')
                          -> select('student_details.userId','student_details.stdName','student_details.address','student_details.phone','student_details.course','users.email','users.password','student_certificate.cname','users.name as uname')
                          ->where('users.id',$id)
                           ->first();


            return view('editstudentprofile',$data);

    }

    public function download($id)
  {


      $download = StudentCertificate::where('userId',$id)->first();
      if(!is_null($download)) {
        $file = storage_path().'/app/public/certificate/'.$download->cname;
        if(file_exists($file)) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $filename = Helper::convert_to_slug($download->cname).'.'.$extension;
            $dname= substr($filename,11);

            return response()->download($file, $dname);
        } else {
            return redirect()->route('slug', $page->slug);
        }
      } else {
         return redirect()->route('slug', $page->slug);
      }
    
  }

  public function update(Request $request,$id)
  {

    if($request->file('certificate') != "")
    {

      $file = $request->file('certificate');
      $filename = time() . '_' .$request->certificate->getClientOriginalName(); 
      $request->file('certificate')->storeAs('public/certificate', $filename);
            
    }
    else
    {
      $filename = $request->input('oldcertificate');
    }

              $users                = user::where('id',$id)->first();
              $users->name   = $request->input('uname');      
              $users->password   = bcrypt($request->input('password'));
              $users->email    = $request->input('email');
              $users->role     = "student";


              $users->save();

              $student_details  = StudentDetails::where('userId',$id)->first();
              $student_details->userId  = $users->id;
              $student_details->stdName = $request->input('name');
              $student_details->address  = $request->input('address');
              $student_details->phone  = $request->input('phnumber');
              $student_details->course = $request->input('course');

              $student_details->save();

//DB::enableQueryLog();
              $student_certificate  = StudentCertificate::where('userId',$id)->first();
//$query = DB::getQueryLog(); print_r($query); exit;
              if($student_certificate == '' && $filename != "")
              {
              $student_certificate  = new StudentCertificate;
              $student_certificate->userId = $users->id;
              $student_certificate->cname  = $filename;
              $student_certificate->save();
              }
              if($student_certificate != '' && $filename != "")
              {
              $student_certificate->userId = $student_certificate->userId;
              $student_certificate->cname  = $filename;
              $student_certificate->save();
              }
              
              Session::flash('success', 'Student details updated');

              return redirect('view_students');


  }

  public function student_update(Request $request, $id)
  {
              $users           = user::where('id',$id)->first();
              $users->name   = $request->input('uname');      
              $users->password   = bcrypt($request->input('password'));
              $users->role     = "student";


              $users->save();

              $student_details  = StudentDetails::where('userId',$id)->first();
              $student_details->userId  = $users->id;
              $student_details->stdName = $request->input('name');
              $student_details->address  = $request->input('address');
              $student_details->phone  = $request->input('phnumber');

              $student_details->save();

              $data['userdata'] =  user::select('role','id')
                          ->where('id',$student_details->userId)
                           ->first();

              $data['profiledata'] = user::leftjoin('student_details', 'users.id','=', 'student_details.userId')
                          ->leftjoin('student_certificate','users.id','=','student_certificate.userId')
                          -> select('student_details.userId','student_details.stdName','student_details.address','student_details.phone','student_details.course','users.email','users.password','student_certificate.cname','users.name as uname')
                          ->where('users.id',$student_details->userId)
                           ->first();

              Session::flash('success', 'Your profile is updated');
              return view('profile',$data);


  }

  public function destroy_certificate($id)
  {
    $certificate = StudentCertificate::where('userId',$id)->delete();
    return response()->json([
        'code' => '100'
    ]);
  }

  public function delete($id)
  {
    $file = StudentCertificate::where('userId',$id)->first();
    if($file != "")
    {
    $filepath = asset('/storage/certificate/'.$file->cname);
    // print_r($filepath); exit;
    if (File::exists($filepath)) {
        File::delete($image_path);
       // unlink($image_path);
    }
    }

    StudentCertificate::where('userId',$id)->delete();
    StudentDetails::where('userId',$id)->delete();
    user::where('id',$id)->delete();

    $studentslists = StudentDetails::select('userId','stdName','course')
                            ->get();
      //$query = DB::getQueryLog(); print_r($query); exit;
      //return redirect('viewstudents',$data);
      
      return redirect()->action('AdminController@view');

  }


}
