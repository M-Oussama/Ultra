<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\EmployeeMonthlyPayroll;
use App\Models\LeaveApplications;
use App\Models\MonthlyAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
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

        $current_month = Carbon::now()->format('m');
        $current_year = Carbon::now()->format('Y');

        $attendances_monthly_exists = MonthlyAttendance::where('month',$current_month)->where('year',$current_year)->get();

        if($attendances_monthly_exists->isEmpty())
                 $this->createMonthlyAttendance($current_month,$current_year);

        $attendances = MonthlyAttendance::all();

        /**  years since 2010 till now */
        $currentYear = date('Y');
        $currentMonth = date('m');

        $years = range(2010, $currentYear);

        /**
         * $months
         */
        $months = range(1, $currentMonth);
        $monthNames = array_map(function ($month) {
            return date('F', mktime(0, 0, 0, $month, 1));
        }, $months);

        return view('dashboard.people.employees.attendances.month')->with('attendances',$attendances)->with('months',$monthNames)->with('years',$years);
    }
    public function createMonthlyAttendance($month,$year){

        $attendances = MonthlyAttendance::where('month',$month)->where('year',$year)->get();

        if($attendances->isEmpty()){
            $attendance = new MonthlyAttendance();
            $attendance->month = $month;
            $attendance->year = $year;
            $attendance->save();
        }
        $this->createEmployeeAttendance($month,$year);
    }

    public function createEmployeeAttendance($month,$year){

        $startDate = new \DateTimeImmutable("$year-$month-01");
        $_startDate = new \DateTimeImmutable("$year-$month-01");
        $endDate = $startDate->modify('last day of this month');

        $attendanceDates = [];

        while ($startDate <= $endDate) {
            $attendanceDates[] = $startDate->format('Y-m-d');
            $startDate = $startDate->modify('+1 day');
        }

        $leave_apps = LeaveApplications::with('employee')->whereDate('start_date','<=',$endDate)->whereDate('end_date','<=',$endDate)->get();


        foreach ($leave_apps as $leave_app){
            // Create attendance records for the employee
            $attendance_exists = Attendance::whereIn('attendance_date',$attendanceDates)->where('employee_id',$leave_app->employee->id)->get();

            if($attendance_exists->isEmpty()){
                foreach ($attendanceDates as $date) {
                    $attendance = new Attendance();
                    $attendance->employee_id = $leave_app->employee->id;
                    $attendance->attendance_date = $date;
                    // Set default values for other columns if needed
                    $attendance->save();
                }
            }

        }

    }

    public function getMonthlyAttendance($month,$year)
    {


        $startDate = Carbon::create($year, $month, 1);
        $endDate = $startDate->copy()->lastOfMonth();
        $daysInMonth = $endDate->diffInDays($startDate) + 1;

        $dates = [];

        for ($day = 0; $day < $daysInMonth; $day++) {
            $date = $startDate->copy()->addDays($day);
            $dates[] = $date->format('Y-m-d');
        }

        $this->createMonthlyAttendance($month,$year);



        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();


        $attendances = Employee::whereHas('attendances', function ($query) use ($startDate,$endDate) {
            $query->whereDate('attendance_date', '>=', $startDate)
                ->whereDate('attendance_date', '<=', $endDate);
        })
            ->with(['attendances' => function ($query) use ($startDate, $endDate) {
                $query->whereDate('attendance_date', '>=', $startDate)
                    ->whereDate('attendance_date', '<=', $endDate);
            }])->get();


        return view('dashboard.people.employees.attendances.index')->with('attendances',$attendances)->with('dates',$dates)->with('month',$month)->with('year',$year);
    }

    public function updateAttendance(Request $request){
        $month = $request->month;
        $year = $request->year;
        $employees_attendances =   Employee::with(['attendances' => function ($query) use ($year, $month) {
            $query->whereYear('attendance_date', $year)
                ->whereMonth('attendance_date', $month);
        }])->get();


        foreach ($employees_attendances as $employee){
            foreach ($employee->attendances as $attendance){
                $attendance->status = $request->has('attendance'.$attendance->id) ? 1 : 0;;
                $attendance->save();
            }
        }



        return redirect("/dash/attendances");
    }

    public function create($month,$year){

        $attendances = MonthlyAttendance::where('month',$month)->where('year',$year)->get();
        return $attendances->isEmpty();

        return redirect('dash/attendances/'.$month.'/'.$year);
    }

    public function getSalaryPage($id){

        $attendance = MonthlyAttendance::find($id);
        $year = $attendance->year;
        $month = $attendance->month;

        $employees_attendances = Employee::with(['attendances' => function ($query) use ($year, $month) {
            $query->whereYear('attendance_date', $year)
                ->whereMonth('attendance_date', $month);
        }])->with(['monthlyPayroll' => function ($query) use ($id){
            $query->where('monthly_attendances_id', $id);

        }])->get();
        foreach ($employees_attendances as $employee){

            if($employee->monthlyPayroll->isEmpty()){
                $monthly_payroll = new EmployeeMonthlyPayroll();
                $monthly_payroll->employee_id = $employee->id;
                $monthly_payroll->monthly_attendances_id = $attendance->id;
                $monthly_payroll->save();
            }

        }

        $employees_attendances = Employee::with(['attendances' => function ($query) use ($year, $month) {
            $query->whereYear('attendance_date', $year)
                ->whereMonth('attendance_date', $month);
        }])->with(['monthlyPayroll' => function ($query) use ($id){
            $query->where('monthly_attendances_id', $id);

        }])->get();



        return view('dashboard.people.employees.attendances.salary')
            ->with('attendance',$attendance)
            ->with('employees',$employees_attendances);

    }

    public function submitSalary(Request $request){

        $id = $request->attendance_id;
        $attendance = MonthlyAttendance::find($id);
        $year = $attendance->year;
        $month = $attendance->month;




        $employees = Employee::with(['attendances' => function ($query) use ($year, $month) {
            $query->whereYear('attendance_date', $year)
                ->whereMonth('attendance_date', $month);
        }])->with(['monthlyPayroll' => function ($query) use ($id){
            $query->where('monthly_attendances_id', $id);

        }])->get();
        foreach ($employees as $employee){
            $employee->monthlyPayroll->first()->salary = $request->input('salary'.$employee->id);
            $employee->monthlyPayroll->first()->save();
        }

        $attendance->cnas_contributions = $request->cnas_contributions;
        $attendance->save();

        session()->flash('type', 'success');
        session()->flash('message', 'Monthly Salary Updated successfully.');
        return redirect("dash/attendances");

    }
}
