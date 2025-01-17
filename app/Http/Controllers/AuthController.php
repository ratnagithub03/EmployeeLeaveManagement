<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(Request $request){
        // dd($request);
        $data=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'age'=>$request->age,
            'phone'=>$request->phone,
            'role'=>$request->role,
            'maxleave'=>$request->maxleave,
            'gender'=>$request->gender,
            'status'=>'inactive'
        ]);
        if($data){
            return redirect('/register')->with('result','Registered Successfully');
        }
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $credentials=$request->only('email','password');
        if(Auth::attempt($credentials)){
            $name=Auth::user()->name;
            $status=Auth::user()->status;
            $role=Auth::user()->role;
            $userid=Auth::user()->id;
            Session::put('name',$name);
            Session::put('role',$role);
            Session::put('userid',$userid);
            if($status=='active'){
                if($role=='admin' || $role=='Admin'){
                    return view('admin');
                }elseif($role=='Hr' || $role=='hr'){
                    return view('Hr');
                }else{
                    return view('Employee');
                }
            }else{
                return redirect('/login')->with('result','You are not an active user');
            }
        }else{
            return redirect('/login')->with('result','Credential mis-match');
        }
    }

    
    public function changeStatus($id){
        $data=User::find($id);
        if($data->status=='inactive'){
            $data->status='active';
        }else{
            $data->status='inactive';
        }
        $data->save();
        return redirect('/viewUser');
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }
    public function forgotPassword(Request $request){
    $email=$request->email;
    $phone=$request->phone;
    $password=$request->password;
    $user=User::where('email','=',$email)->where('phone','=',$phone)->first();
    if(!user)
    {
        return redirect('/forgotPassword')->with('result','Invalid credentials'); 
}else{
    $update=User::where('email','=',$email)->where('phone','=',$phone)->update(['password'=>Hash::make($password)]);
 if($update){
    return redirect('/login')->with('result','Password updated successfully');
     }
   }
}
 public function changePassword(Request $request){
    $oldPassword=$request->oldPassword;
    $newPassword=$request->newPassword;
    $user_id=$request->user_id;
    $user=User::find($user_id);
    if(Hash::check($oldPassword,$user->password)){
        $change=User::find($user_id)->update(['password'=>Hash::make($newPassword)]);
        if($change){
            if($user->role=='Admin'){
                return redirect('adminhome')->with('result','Password changed Successfully');
            }elseif($user->role=='Hr'){
                return redirect('hrchangePassword')->with('result', 'Password changed Successfully');
         }else{
              return view('/employeeHome')->with('result', 'Password changed Successfully');
         }
        
        }else{
            return redirect('/hrchangePassword')->with('result','Invalid old password');
         }
    }

    
}

// public function editProfile(Request $request){
//     if($image=$request->file('file')){
//         $name=time().'.'.$image->getClientOriginalExtension();
//         // $destinationPath=public_path('/images/profile_pic');
//         $image->storeAs('public/images/profile_pic', $name);
//         User::find($request->user_id)->update(['photo'=>$name]);
//         return redirect('/Employee')->with('result','Profile pic uploaded successfully');
//      }
//    }

public function editProfile()
    {
        // Fetch the currently authenticated employee
        $employee = Auth::user();

        // Pass employee data to the edit profile view
        return view('employee.editProfile', compact('employee'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $employee = Auth::user();

        // Update employee data
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($employee->photo) {
                Storage::delete('public/' . $employee->photo);
            }

            // Store the new photo
            $path = $request->file('photo')->store('photos', 'public');
            $employee->photo = $path;
        }

        $employee->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }



   public function checkUser(Request $request){
    $user=User::where('email','=',$request->email)->where('phone','=',$request->phone)->first();
    if($user){
        return view('resetPassword')->with('userid',$user->id);
    }else{
        return redirect('login')->with('message','Invalid User');
    }
   }
   public function resetPassword(Request $request){
    $user=User::find($request->id)->update(['password'=>Hash::make($request->newpassword)]);
    if($user){
        return redirect('/login')->with('message','Password Updated Successfully');
    }else{
        return redirect('/login')->with('message','Invalid User');
    }
   }
}

