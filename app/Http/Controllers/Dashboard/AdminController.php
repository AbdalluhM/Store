<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Admin::orderBy('id','DESC')->paginate(5);
        return view('dashboard.Admins.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.Admins.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $Admin = Admin::create($input);
        $Admin->assignRole($request->input('roles'));
        session()->flash('success','Role created successfully');
        return redirect()->route('users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Admin = Admin::find($id);
        return view('dashboard.Admins.show',compact('Admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::all();
        // $userRoles = $user->roles->pluck('name','name')->all();

        return view('dashboard.Admins.edit',compact('user','roles'));
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

        $validator=Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input =$request->all();
        // dd($input);
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }
        else{
            $input = Arr::except($input,array('password'));
        }

        $Admin = Admin::find($id);
        // dd($Admin);
        $Admin->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $Admin->assignRole($request->input('roles'));
        session()->flash('success','User Updated successfully');
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
        session()->flash('success','User Deleted successfully');
        return redirect()->route('users.index');

    }
}
