<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Salary;
use App\Allowance;
use App\Deduction;
use Storage;
use Log;


class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Salary::with('user')->get();
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
        $salary = Salary::create([
            'user_id' => $request->employee_id,
            'year' => $request->year,
            'month' => $request->month,
            'amount_paid' => $request->amount_paid,
            'paid_date' => $request->paid_date,
            'total_allowance' => $request->total_allowance,
            'overtime' => $request->overtime,
            'total_deduction' => $request->total_deduction,
        ]);

        if($request['allowances']){
            $allowance = json_decode($request['allowances']);
            foreach($allowance as $allowance){
                Allowance::create([
                    'salary_id' => $salary->id,
                    'description' => $allowance->description,
                    'amount' => $allowance->amount,
                ]);
            }        
        }

        if($request['deductions']){
            $deduction = json_decode($request['deductions']);
            foreach($deduction as $deduction){
                Deduction::create([
                    'salary_id' => $salary->id,
                    'description' => $deduction->description,
                    'amount' => $deduction->amount,
                ]);
            }        
        }
        
        return $salary->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Salary::where('id',$id)->with('user','allowance','deduction')->first();
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
        $salary = Salary::findOrfail($id);
        $salary->year = $request->year;
        $salary->month = $request->month;
        $salary->amount_paid = $request->amount_paid;
        $salary->paid_date = $request->paid_date;
        $salary->total_allowance = $request->total_allowance;
        $salary->overtime = $request->overtime;
        $salary->total_deduction = $request->total_deduction;
        $salary->save();

        Allowance::where('salary_id',$id)->delete();
        if($request['allowances']){
            $allowance = json_decode($request['allowances']);
            foreach($allowance as $allowance){
                Allowance::create([
                    'salary_id' => $salary->id,
                    'description' => $allowance->description,
                    'amount' => $allowance->amount,
                ]);
            }        
        }

        Deduction::where('salary_id',$id)->delete();
        if($request['deductions']){
            $deduction = json_decode($request['deductions']);
            foreach($deduction as $deduction){
                Deduction::create([
                    'salary_id' => $salary->id,
                    'description' => $deduction->description,
                    'amount' => $deduction->amount,
                ]);
            }        
        }

        return Salary::where('id',$id)->with('user','allowance','deduction')->first();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Salary::findOrFail($id)->delete();
        return 'Salary deleted';
    }
}
