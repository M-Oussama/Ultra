<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
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

    public function index()
    {
        $employees = Employee::all();
        return view('dashboard.people.employees.index')->with('employees',$employees);
    }

    public function create()
    {
        return view('dashboard.people.employees.create');
    }

    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->surname = $request->surname;
        $employee->birthdate = $request->birthdate;
        $employee->address = $request->address;
        $employee->NIN = $request->NIN;
        $employee->NCN = $request->NCN;
        $employee->card_issue_date = $request->card_issue_date;
        $employee->card_issue_place = $request->card_issue_place;
        $employee->birthplace = $request->birthplace;
        $employee->save();


        $today = Carbon::now()->toDateString();

            // Check if employee has an attendance record for today
        $attendanceExists = Attendance::where('employee_id', $employee->id)
            ->where('attendance_date', $today)
            ->exists();

        if ($attendanceExists) {
            // Keep the previous record and start creating attendance from the next day until the last day of the month
            $lastDayOfMonth = Carbon::now()->endOfMonth()->toDateString();

            $existingRecord = Attendance::where('employee_id', $employee->id)
                ->where('attendance_date', '<=', $today)
                ->orderBy('attendance_date', 'desc')
                ->first();

            $startDate = Carbon::parse($existingRecord->attendance_date)->addDay()->toDateString();

            while ($startDate <= $lastDayOfMonth) {
                // Create attendance records for each day
                $attendance = new Attendance();
                $attendance->employee_id = $employee->id;
                $attendance->attendance_date = $startDate;
                // Set default values for other columns if needed
                $attendance->save();

                $startDate = Carbon::parse($startDate)->addDay()->toDateString();
            }
        }else{
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();

            $attendanceDates = [];

            // Generate attendance dates
            while ($startDate->lte($endDate)) {
                $attendanceDates[] = $startDate->toDateString();
                $startDate->addDay();
            }

            // Create attendance records for the employee
            foreach ($attendanceDates as $date) {
                $attendance = new Attendance();
                $attendance->employee_id = $employee->id;
                $attendance->attendance_date = $date;
                // Set default values for other columns if needed
                $attendance->save();
            }
        }

        session()->flash('type', 'success');
        session()->flash('message', 'Employee created successfully.');

        return redirect('dash/employees');
    }

    public function edit($id){
        $employee = Employee::find($id);
        return view('dashboard.people.employees.edit')->with('employee',$employee);

    }

    public function update(Request $request,$id)
    {
        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->surname = $request->surname;
        $employee->birthdate = $request->birthdate;
        $employee->address = $request->address;
        $employee->NIN = $request->NIN;
        $employee->NCN = $request->NCN;
        $employee->card_issue_date = $request->card_issue_date;
        $employee->card_issue_place = $request->card_issue_place;
        $employee->birthplace = $request->birthplace;
        $employee->save();
        session()->flash('type', 'success');
        session()->flash('message', 'Employee Edited successfully.');

        return redirect('dash/employees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        session()->flash('type', 'success');
        session()->flash('message', 'Employee deleted successfully.');
        return redirect()->back();
    }

    public function deleteMulti(Request $request){
        $ids = $request->input('ids');
        foreach ($ids as $id){
            Employee::find($id)->delete();
        }
        session()->flash('type', 'success');
        session()->flash('message', 'Employees deleted successfully.');
        return redirect()->back();
    }
}
