<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Hash;
use DB;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ///if(Auth::user()->admin) {
            $users = DB::table('users')
                        //->where('admin', '=', 0)
                        //->orderBy('created_at', 'DESC')
                        ->paginate(20);

            return view('users.index', compact('users'));
        //}
        //else {
          //  return redirect('/home');
        //}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //if(Auth::user()->admin) {
            return view('users.create');
        //}
        //else {
          //  return redirect('/home');
        //}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if(Auth::user()->admin) {

            $validatedData = $request->validate([
                'name' => 'required:max:40',
                'email' => 'required|unique:users|max:190',
                'password' => 'required|min:3|max:6',
                //'role' => 'required|max:40'
            ]);
            
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            if($request->hasFile('image')) {
              
              $file = $request->file('image') ;
              $fileName = $file->getClientOriginalName() ;
              $destinationPath = public_path().'/images' ;
              $file->move($destinationPath,$fileName);
              $user->image = $fileName;
              
            }
            $user->save();

            return redirect()->to('/users')->with('success', 'User Created Successfully');
            
        //} 
        //else {
            //r//return redirect('/home');
        //}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //if(Auth::user()->admin) {
            $user = User::find($id);
            return view('users.view', compact('user'));
        //}
        //else {
          //  return redirect('/home');
        //}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //if(Auth::user()->admin) {
            $user = User::findOrFail($id);
            //$user_role = DB::table('roles')->where('user_id', '=', $id)->first();
            return view('users.edit', compact('user'));

        //}
        //else {
          //  return redirect('/home');
       // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //if(Auth::user()->admin) {

            $validatedData = $request->validate([
                'name' => 'required:max:40',
                'email' => 'required|max:190',
                'password' => 'nullable|min:3|max:6',
                //'role' => 'required',
            ]);

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            //$user->birth_date = $request->birth_date;
            //$user->gender = $request->gender; 
            //$user->country = $request->country;
            if($user->password) {
                $user->password = Hash::make($request->password);
            }
            if($request->hasFile('image')) {
              $user->image = $request->image->store('images');
            }
            $user->role = $request->role;
            $user->save();

            //$role = Role::where('user_id', '=', $id)->firstOrFail();
            
            //$role->permission = $request->permission;
            //$role->save();

            return redirect()->to('/users')->with('success', 'User Updated Successfully');
       // }
        //else {
          //  return redirect('/home');
        //}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //if(Auth::user()->admin) {
            $user = User::find($id);
            //$role = Role::where('user_id', '=', $id)->firstOrFail();
            //$role->delete();
            $user->delete();
            return redirect()->to('/users')->with('success', 'User Deleted Successfully');
       // }
        //else {
          //  return redirect('/home');
        //}
    }
    public function modifyStatus(Request $request)
    {
        $user = User::find($request->id);
        
        if ($user->statu == 'Désactivé') {
            # code...
            $user->statu = 'Active';
            $user->save();
            return 'User Actived Successfully';
        }else {
            $user->statu = 'Désactivé';
            $user->save();
            return 'User Desactived Successfully';
        }
        
        
        # code...
    }

    public function modifyPassword(Request $request)
    {

        $user = User::find($request->id);
    # code...
        
        if(Hash::make($request->oldpass) == $user->password) {
            $user->password = Hash::make($request->newpass);
            
            $user->save();
            return 'User Password Modified Successfully';
        }
    }
}
