<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Cases;
use App\Models\CategoryForms;
use App\Models\CategoryStagesChecklist;
use App\Models\Permisions;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Models\Categories;

class UsersController extends Controller
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
    public function index($role)
    {
        hasPermissions([$role.'_list']);
        $data = User::where('role','=',$role)->orderBy('name','asc')->paginate(20);
        return view('portal.users.list',['data'=>$data,'role'=>$role]);
    }
    function userProfile($id){
        $user = User::whereId($id)->first();

        $cases = [];
        hasPermissions([strtolower($user->role).'_view',strtolower($user->role).'_edit']);
        if($user->role == 'Staff'){
            $cases = Cases::where('staff_id','=',$user->id)->with('category_info','client_info','staff_info')->where('status','!=','Draft')->orderBy('id','desc')->paginate(20);
        }
        if($user->role == 'Client'){
            $cases = Cases::where('client_id','=',$user->id)->with('category_info','client_info','staff_info')->where('status','!=','Draft')->orderBy('id','desc')->paginate(20);
        }
        $staff_users = User::where('role','=','Staff')->where('status','=','1')->pluck('name','id')->toArray();

        return view('portal.users.profile',['user'=>$user,'cases'=>$cases,'staff_users'=>$staff_users]);
    }
    function updateUserStatus(){
        $post = \request()->all();
        $status = '0';
        if($post['status'] == 'true'){
            $status = '1';
        }
        $user = User::whereId($post['user_id'])->update(['status'=>$status]);
        return ['success'=>'true','message'=>'User Status Update Successfully.'];
    }
    function editUser($id){

        Session::flash('activeTab','updateProfileTab');
        return redirect()->to(route('userProfile',$id));
    }
    function addUser(){
        $post = \request()->all();

        $options = array(
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:8,255',
        );

        $validation = Validator::make( $post, $options );
        if($validation->fails()){
            Session::flash('activeModal','addUserModal');
            return redirect()->back()->withInput()->withErrors($validation->messages());
        }
        hasPermissions([strtolower($post['role']).'_add']);
        $data = [];
        $data['name'] = $post['name'];
        $data['email'] = $post['email'];
        $data['password'] = bcrypt($post['password']);
        $data['role'] = $post['role'];
        $id = User::insertGetId($data);
        return redirect()->to(route('userProfile',$id))->with('success','User Created Successfully.');
    }
    function userPermissions($role='admin'){
        hasPermissions(['grant_access_view']);
        $data = [];
        $allow_permissions = Permisions::select('permissions')->where('role','=',ucfirst($role))->first();
        $allow_permissions = json_decode($allow_permissions->permissions,1);
        $permissionsset = getPermissionsSet();
        if($role == 'client'){
            $clientPermissionsset = $permissionsset;
            $permissionsset = [];
            $permissionsset['applications'] = $clientPermissionsset['applications'];
        }
        if($role == 'admin'){
            unset($permissionsset['applications']);
        }


        return view('portal.users.permissions',['data'=>$data,'role'=>$role,'permissions_data'=>$permissionsset,'allow_permissions'=>$allow_permissions]);
    }
    function updatePermissions(){
        hasPermissions(['grant_access_update']);
        $post = \request()->all();
        $options = array(
            'role' => 'required'
        );

        $validation = Validator::make( $post, $options );
        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation->messages());
        }
        $data = [];
        $data['role'] = ucfirst($post['role']);
        $data['permissions'] = isset($post['permissions'])?json_encode($post['permissions']):json_encode([]);
        Permisions::updateOrCreate(['role'=>$data['role']],$data);
        return redirect()->back()->with('success','Permissions Set Successfully.');
    }
}
