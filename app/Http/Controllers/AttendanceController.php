<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
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

        $today = today();
        $dates = [];

        for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
        }

        $attendances =   Employee::with(['attendances' => function ($query) use ($current_year, $current_month) {
            $query->whereYear('attendance_date', $current_year)
                ->whereMonth('attendance_date', $current_month);
        }])->get();



        return view('dashboard.people.employees.attendances.index')->with('attendances',$attendances)->with('dates',$dates)->with('month',$current_month)->with('year',$current_year);
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
        return redirect()->back();
    }
}
