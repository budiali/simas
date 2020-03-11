<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Division;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dataUser = User::orderBy('created_at','DESC')->paginate(10);
        
        return view('user.index',compact('dataUser'));
    }

    public function create()
    {
        $getRole = Role::where('name','staff')->get();
        $roleUser = Role::orderBy('created_at','DESC')->get();

        $roles = Auth::user()->roles()->first();
        if($roles->name != 'administrator')
        {
            $divisions = Auth::user()->division()->get();
        } else {
            $divisions = Division::orderBy('created_at','DESC')->get();
        }

        return view('user.register' , compact('roleUser','getRole','divisions'));
    }
    
    public function create_user(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255|string',
            'email' => 'required|email|unique:users|string',
            'division' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation'
            
        ]);

        $createUser = User::create([
            'name' => $request->name ,
            'email' => $request->email ,
            'division_id' => $request->division ,
            'password' => Hash::make($request->password)
        ]);

        $createUser->roles()->attach($request->input('role'));

        return redirect('user')->with('success','New user successfully created!');
    }

    public function profile(Request $request)
    {
        $userProfile = User::find($request->id);
        $company = 'PT.Kurhanz Trans';
        return view('user.profile' , compact('userProfile','company'));
    }

    public function changePasswordForm()
    {
        return view('auth.changePassword');
    }

    public function changePassword(Request $request){
 
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
        // The passwords matches
        return redirect()->back()->with("error","Your current password does not match. Please try again.");
            // return response()->json(['errors' => ['current'=> ['Current password does not match']]], 422);
        }
         
        if(strcmp($request->get('old_password'), $request->get('new-password')) == 0){
        //Current password and new password are same
        return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
            // return response()->json(['errors' => ['current'=> ['New Password cannot be same as your current password']]], 422);
        }
        if(!(strcmp($request->get('new-password'), $request->get('new-password-confirm'))) == 0){https://stackoverflow.com/questions/15414373/syntax-error-for-permission-rb
                    //New password and confirm password are not same
        return redirect()->back()->with("error","New Password should be same as your confirmed password. Please retype new password.");
            // return response()->json(['errors' => ['current'=> ['New Password Confirm cannot be same as your current password']]], 422);
        }

        $validatedData = $request->validate([
            'old_password' => 'required',
            'new-password' => 'min:6|required_with:new-password-confirm|same:new-password-confirm',
                    ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
         
        return redirect()->back()->with("success","Password changed successfully !");
         
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);

        $user->delete();

        return redirect()->back()->with('success','User successfully deleted!');
    }

    public function edit(Request $request)
    {
        $userEdit = User::find($request->id);

        return view('user.edit',compact('userEdit'));
    }

    public function rolePermission(Request $request)
    {
        $role = $request->get('role');
        
        //Default, set dua buah variable dengan nilai null
        $permissions = null;
        $hasPermission = null;
        
        //Mengambil data role
        $roles = Role::all()->pluck('name');
        
        //apabila parameter role terpenuhi
        if (!empty($role)) {
            //select role berdasarkan namenya, ini sejenis dengan method find()
            $getRole = Role::findByName($role);
            
            //Query untuk mengambil permission yang telah dimiliki oleh role terkait
            $hasPermission = DB::table('role_has_permissions')
                ->select('permissions.name')
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                ->where('role_id', $getRole->id)->get()->pluck('name')->all();
            
            //Mengambil data permission
            $permissions = Permission::all()->pluck('name');
        }
        return view('user.role_permission', compact('roles', 'permissions', 'hasPermission'));
    }


    public function setRolePermission(Request $request, $role)
    {
        //select role berdasarkan namanya
        $role = Role::findByName($role);
        
        //fungsi syncPermission akan menghapus semua permissio yg dimiliki role tersebut
        //kemudian di-assign kembali sehingga tidak terjadi duplicate data
        $role->syncPermissions($request->permission);
        return redirect()->back()->with(['success' => 'Permission to Role Saved!']);
    }

    public function addPermission(Request $request)
    {
    $this->validate($request , [
        'name' => 'required|string|unique:permissions'
    ]);

    $permission = Permission::firstOrCreate([
        'name' => $request->nameDocuments 
    ]);

    return redirect()->back();

    }

    public function roles(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all()->pluck('name');
        return view('user.roles', compact('user', 'roles'));
    }

    public function setRole(Request $request , $id)
    {
        $this->validate($request , [

            'role' => 'required'

        ]);

        $user = User::findOrFail($id);

        $user->syncRoles($request->role);
        return redirect()->back()->with(['success' => 'Role is set.']);
    }

    public function edit_profile(Request $request)
    {
        $user = User::find($request->id);

        return view('user.edit_profile', compact('user'));
    }

    public function update_profile(Request $request)
    {
        $this->validate($request, [

            'name' => 'required',
            'email' => 'required|email'

        ]);

        $update = User::find($request->id);
        $update->name = $request->name;
        $update->email = $request->email;
        $update->save();

        return redirect()->back()->with('success','Profile succesfully updated!');

    }
 
}
