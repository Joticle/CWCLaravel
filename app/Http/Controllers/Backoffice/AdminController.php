<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Cases;
use App\Models\Faqs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Validator;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];

        return view('backoffice.dashboard',$data);
    }
    function logout(){
        Auth::logout();
        return redirect()->to(route('login'));
    }
    function profile(){
        $user = Auth::user();
        $staff_users = User::where('role','=','Staff')->where('status','=','1')->pluck('name','id')->toArray();

        $cases = [];
        if($user->role == 'Staff'){
            $cases = Cases::where('staff_id','=',$user->id)->with('category_info','client_info','staff_info')->where('status','!=','Draft')->orderBy('id','desc')->paginate(20);
        }
        if($user->role == 'Client'){
            $cases = Cases::where('client_id','=',$user->id)->with('category_info','client_info','staff_info')->where('status','!=','Draft')->orderBy('id','desc')->paginate(20);
        }

        return view('portal.users.profile',['user'=>$user,'staff_users'=>$staff_users,'cases'=>$cases]);
    }
    function updateProfilePassword(){
        $post = \request()->all();
        Session::flash('activeTab','updatePasswordTab');
        $options = array(
            'uid'=> 'required',
            'old_password' => 'required',
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required',
        );
        $validation = Validator::make( $post, $options );
        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation->messages());
        }
        $uid = $post['uid'];
        $user = User::whereId($uid)->first();
        $old_password = $post['old_password'];
        if (\Hash::check($old_password, $user->password)) {
            User::whereId($uid)->update(['password'=>bcrypt($post['password'])]);
            return redirect()->back()->with('success','Password Update Successfully');
        }
        return redirect()->back()->withInput()->withErrors(['Please Enter Valid Old Password']);
    }
    function updateProfile(){
        $post = \request()->all();
        //debug($post,1);
        Session::flash('activeTab','updateProfileTab');
        $options = array(
            'uid' => 'required',
            'name' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:4096',
        );
        $validation = Validator::make( $post, $options );
        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation->messages());
        }
        $data = [];
        $data['name'] = $post['name'];
        $data['birth_date'] = !empty($post['birth_date'])?date('Y-m-d',strtotime($post['birth_date'])):NULL;
        $data['phone_number'] = $post['phone_number'];
        $data['address'] = $post['address'];
        $data['gender'] = isset($post['gender'])?$post['gender']:NULL;

        if(\request()->file('thumbnail')){
            $dir_name = public_path('user');
            $file_extention = \request()->file('thumbnail')->getClientOriginalExtension();
            $fileName = rand().'profile.'.$file_extention;
            \request()->file('thumbnail')->move($dir_name, $fileName);
            $data['thumbnail'] = $fileName;
        }
        $uid = $post['uid'];
        //$user = User::whereId($uid)->first();
        User::whereId($uid)->update($data);
        return redirect()->back()->with('success','Profile Update Successfully');
    }
}
