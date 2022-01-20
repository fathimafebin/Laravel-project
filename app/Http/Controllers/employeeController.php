<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Redirect;
use Session;
use function response;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
             'name' => 'required',
            'email' => 'required|unique:employees',
            'company_name' => 'required',
            'contact_no' => 'required',
            'location' => 'required', 
        ]);
//        $request->validate([
//            'name' => 'required',
//            'email' => 'required|unique:employees',
//            'company_name' => 'required',
//            'contact_no' => 'required',
//            'location' => 'required', 
//        ]);
          if ($validator->fails()) {
            return response(['status' => 'false', 'message' => $validator->errors()]);
        }
        $registration_id = rand(100000,999999);
        $employee = new Employee();
        $employee->name = $request->input('name');;
        $employee->email= $request->input('email');
        $employee->company_name = $request->input('company_name');
        $employee->contact_number = $request->input('contact_no');
        $employee->location= $request->input('location');
        $employee->registration_id = $registration_id;
        $employee->save();
        Session::flash('message', "Saved  successfully");
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Employee  $employee
     * @return Response
     */
    public function show(Employee $employee)
    {
       
       
        $employees = Employee::paginate(10);
      
        return view('dashboard/registered_employees', compact('employees'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Employee  $employee
     * @return Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Employee  $employee
     * @return Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Employee  $employee
     * @return Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
     public function search(Employee $employee)
    {
     $employees = Employee::paginate(10);
      
    $q = Input::get ( 'q' );

    $users = Employee::where('registration_id',$q)->first();
    
    if($users !== 0){
        
    return view('Dashboard.search_result',compact('users'));
    
    }
    else{
        return view ('Dashboard.search_result',compact('users'))->withMessage('No Details found. Try to search again !');
    }

    }

}
