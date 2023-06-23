<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LeaveApplications;
use App\Models\MonthlyAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mpdf\Tag\Em;

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
        $currentDate = date('Y-m-d'); // Get the current date

  /*     $employees = Employee::with(['leaveApplications' => function ($query) use ($currentDate) {
            $query->where('start_date', '<=', $currentDate)
                ->where(function ($query) use ($currentDate) {
                    $query->where('end_date', '>=', $currentDate)
                        ->orWhereNull('end_date');
                });
        }])
            ->get()
            ->map(function ($employee) use ($currentDate) {
                $employee->isWorking = !$employee->leaveApplications->isEmpty() || $employee->leaveApplications->max('end_date') < $currentDate;
                return $employee;
            });
*/
        $employees = Employee::with(['leaveApplications' => function ($query) {
            $query->orderBy('start_date', 'desc');
        }])->get();


        return view('dashboard.people.employees.index')->with('employees',$employees);
    }

    public function create()
    {
        $emloyee = new Employee();
        return view('dashboard.people.employees.create')->with('employee',$emloyee);
    }

    public function store(Request $request)
    {
        $employee_exists = Employee::where('CNAS',$request->CNAS)->get();
        if($employee_exists->isEmpty()){
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->surname = $request->surname;
            $employee->birthdate = $request->birthdate;
            $employee->address = $request->address;
            $employee->NIN = $request->NIN;
            $employee->NCN = $request->NCN;
            $employee->CNAS = $request->CNAS;
            $employee->card_issue_date = $request->card_issue_date;
            $employee->card_issue_place = $request->card_issue_place;
            $employee->birthplace = $request->birthplace;
            $employee->save();
            $leave_application = new LeaveApplications();
            $leave_application->start_date = $request->start_date;
            $leave_application->employee_id = $employee->id;
            $leave_application->cnas_start_date = $request->start_date;
            $leave_application->save();

            $month = date('m', strtotime($request->start_date));
            $year = date('Y', strtotime($request->start_date));
            $attendances = MonthlyAttendance::where('month',$month)->where('year',$year)->get();

            if($attendances->isEmpty()){
                $attendance = new MonthlyAttendance();
                $attendance->month = $month;
                $attendance->year = $year;
                $attendance->save();
            }

            $startDate = Carbon::parse(date('Y-m-01', strtotime($request->start_date)));
            $endDate = Carbon::parse(date('Y-m-t', strtotime($request->start_date)));

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
            session()->flash('type', 'success');
            session()->flash('message', 'Employee created successfully.');

            return redirect('dash/employees');
        }else{
            session()->flash('type', 'warning');
            session()->flash('message', 'Employee Already Exists successfully.');

            return view('dashboard.people.employees.create')->with('employee',$request);
        }
        /*else{
            // Check if employee has an attendance record for today
            $startDate = Carbon::parse(date('Y-m-01', strtotime($request->start_date)));
            $endDate = Carbon::parse(date('Y-m-t', strtotime($request->start_date)));

            $attendanceDates = [];
            $existingRecord = Attendance::where('employee_id', $employee_exists->first()->id)
                ->where('attendance_date', $request->start_date)
                ->orderBy('attendance_date', 'desc')
                ->get();
            if($existingRecord->isEmpty()){
                // all month
                // Generate attendance dates
                while ($startDate->lte($endDate)) {
                    $attendanceDates[] = $startDate->toDateString();
                    $startDate->addDay();
                }

                // Create attendance records for the employee
                foreach ($attendanceDates as $date) {
                    $attendance = new Attendance();
                    $attendance->employee_id = $employee_exists->first()->id;
                    $attendance->attendance_date = $date;
                    // Set default values for other columns if needed
                    $attendance->save();
                }


            }
            $leave_application = new LeaveApplications();
            $leave_application->start_date = $request->start_date;
            $leave_application->employee_id = $employee_exists->first()->id;
            $leave_application->cnas_start_date = $request->start_date;
            $leave_application->save();

            $month = date('m', strtotime($request->start_date));
            $year = date('Y', strtotime($request->start_date));
            $attendances = MonthlyAttendance::where('month',$month)->where('year',$year)->get();

            if($attendances->isEmpty()){
                $attendance = new MonthlyAttendance();
                $attendance->month = $month;
                $attendance->year = $year;
                $attendance->save();
            }
        }*/


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

    public function leave(Request $request){
        $employee = Employee::find($request->employee_id);
        $leave_record = LeaveApplications::where('employee_id',$employee->id)->where('end_date',null)->get()->first();

        $leave_record->end_date = $request->end_date;
        $leave_record->cnas_end_date = $request->end_date;
        $leave_record->save();

        session()->flash('type', 'success');
        session()->flash('message', 'Employee left successfully.');
        return redirect()->back();
    }

    public function return(Request $request){
        $employee = Employee::find($request->employee_id);


        $leave_app = new LeaveApplications();
        $leave_app->start_date = $request->start_date;
        $leave_app->employee_id = $request->employee_id;
        $leave_app->cnas_start_date = $request->start_date;
        $leave_app->save();

        session()->flash('type', 'success');
        session()->flash('message', 'Employee returned successfully.');
        return redirect()->back();
    }






}


