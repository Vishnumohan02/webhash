<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\user;
use App\StudentDetails;
use App\StudentCertificate;
use App\Model\UserOtp;
use Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profilelogin(Request $request)
    {
        $this->validate($request, [
            'uname' => 'required',
            'password' => 'required',
        ]);

        $lguname = $request->input('uname');

        
              if (Auth::attempt(['name' => $request->uname, 'password' => $request->password]))
              {

                $data['userdata'] =  user::select('role','id')
                          ->where('name',$lguname)
                           ->first();

                if($data['userdata']->role == "student")
                {
                  $data['profiledata'] = user::leftjoin('student_details', 'users.id','=', 'student_details.userId')
                          ->leftjoin('student_certificate','users.id','=','student_certificate.userId')
                          -> select('student_details.userId','student_details.stdName','student_details.address','student_details.phone','student_details.course','users.email','users.password','student_certificate.cname','users.name as uname')
                          ->where('users.id',$data['userdata']->id)
                           ->first();
                }

                return view('profile',$data);

              }
              else
              {
                $data['loginerror']  = "Failed";
                return view('login',$data);
              }
            

          
    }

    public function show($id)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

     public function canceledit($id)
    {

     // DB::enableQueryLog();

         $data['userdata'] =  user::select('role','id')
                          ->where('id',$id)
                           ->first();
 
          $data['profiledata'] = user::leftjoin('student_details', 'users.id','=', 'student_details.userId')
                          ->leftjoin('student_certificate','users.id','=','student_certificate.userId')
                          -> select('student_details.userId','student_details.stdName','student_details.address','student_details.phone','student_details.course','users.email','users.password','student_certificate.cname','users.name as uname')
                          ->where('users.id',$data['userdata']->id)
                           ->first();
          
     //$query = DB::getQueryLog(); print_r($query); exit;

           return view('profile',$data);

    }

    public function update(Request $request, $id)
    {
       $validator        = Validator::make($request->all(), [
            'uname'   => 'required',
            'email' => 'required|email',
            'dob' => 'required',
            'city' => 'required'
        ]);
        if ($validator->fails()) {
           return back()->withErrors($validator);
        }

              $users                = Users::where('id',$id)->first();
              $users->uname   = $request->input('uname');      

              // Save users
              $users->save();

              $user_details     = UserDetails::where('userId',$id)->first();
              $user_details->userId = $id;
              $user_details->email    = $request->input('email');
              $user_details->dob     = $request->input('dob');
              $user_details->city     = $request->input('city');

              $user_details->save();

              $data['userdata'] = Users::leftjoin('user_details','users.id','=','user_details.userId')
                           ->select('users.id','users.uname','user_details.email','user_details.dob','user_details.city')
                           ->where('users.id', $id )
                           ->first();

            return view('profile',$data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('Login');
    }
}
