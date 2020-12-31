<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Storage;
use Log;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        if($request->picture != null){
            $file_name =  time().'.'.preg_replace('/\s+/', '',$request->picture->getClientOriginalName());
            $request->picture->move('img/users/', $file_name);   

            $user = User::create([
                'employee_number' => $request->employee_number,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'address' => $request->address,
                'IC_number' => $request->IC_number,
                'contact' => $request->contact,
                'email' => $request->email,
                'name' => $request->name,
                'department' => $request->department,
                'basic_salary' => $request->basic_salary,
                'position' => $request->position,
                'date_start_work' => $request->date_start_work,
                'date_resigned' => $request->date_resigned,
                'EPF_number' => $request->EPF_number,
                'picture' => $file_name,
                'password' => bcrypt('password'),
            ]);
        }else{
            $user = User::create([
                'employee_number' => $request->employee_number,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'address' => $request->address,
                'IC_number' => $request->IC_number,
                'contact' => $request->contact,
                'email' => $request->email,
                'name' => $request->name,
                'department' => $request->department,
                'basic_salary' => $request->basic_salary,
                'position' => $request->position,
                'date_start_work' => $request->date_start_work,
                'date_resigned' => $request->date_resigned,
                'EPF_number' => $request->EPF_number,
                'picture' => 'avatar.png',
                'password' => bcrypt('password'),
            ]);
        }

        return $user->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrfail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user = User::findOrfail($id);
        $data = json_decode($request->employee);

        $user->employee_number = $data->employee_number;
        $user->firstname = $data->firstname;
        $user->lastname = $data->lastname;
        $user->address = $data->address;
        $user->IC_number = $data->IC_number;
        $user->contact = $data->contact;
        $user->email = $data->email;
        $user->name = $data->name;
        $user->department = $data->department;
        $user->basic_salary = $data->basic_salary;
        $user->position = $data->position;
        $user->date_start_work = $data->date_start_work;
        $user->date_resigned = $data->date_resigned;
        $user->EPF_number = $data->EPF_number;

        if($request->picture != null){
            if($user->picture != 'avatar.png'){
                $path = public_path()."/img/users/".$user->picture;
                try{
                    unlink($path);
                }catch(\Exception $e){
                    Log::error($e->getMessage());
                }
            }
            $file_name =  time().'.'.preg_replace('/\s+/', '',$request->picture->getClientOriginalName());
            $request->picture->move('img/users/', $file_name);
            $user->picture = $file_name;
        }

        $user->save();

        return $user;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return 'Employee deleted';
    }
}
