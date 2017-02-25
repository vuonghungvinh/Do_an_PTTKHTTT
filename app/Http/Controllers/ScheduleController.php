<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Schedule;
use App\Train;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
    	$trains = Train::all();
        $id=0;
        if ($request->id != Null){
            $id = $request->id;
            $schedules = Schedule::where("train_id", $request->id)->paginate(4);
            $schedules->setPath("/?id=".$request->id);
        } else {
            $schedules = Schedule::paginate(4);
        }
        
    	return view("schedule.index", ['trains' => $trains, 'schedules' => $schedules, 'id' => $id]);
    }
    public function add()
    {
    	$trains = Train::all();
    	return view("schedule.add", ['trains' => $trains]);
    }
    public function store(Request $request)
    {
    	$schedules = new Schedule;
        $validator = Validator::make($request->all(), $schedules->rules, $schedules->messages);
        if ($validator->fails()) {
        	$request->session()->flash('error', 'Thêm mới lịch trình không thành công!');
        	return redirect('schedule/add')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $tmp = Schedule::where('train_id', $request->train_id)->where(function($query) use ($request){
                $query->where('from_datetime', '<=', "'".$request->from_datetime."'")
                        ->where("to_datetime", ">=", "'".$request->from_datetime."'")
                        ->orwhereBetween('from_datetime', array("'".$request->from_datetime."'", "'".$request->to_datetime."'"));
            })->first();
            if (count($tmp)>0)
            {
                $request->session()->flash('error', 'Tàu đã có lịch trình trong khoảng thời gian bạn chọn!');
                return redirect('schedule/add')
                        ->withInput();
            } 
        	$schedule = new Schedule;
        	$schedule->name = $request->name;
        	$schedule->train_id = $request->train_id;
        	$schedule->from_address = $request->from_address;
        	$schedule->to_address = $request->to_address;
        	$schedule->from_datetime = $request->from_datetime;
        	$schedule->to_datetime = $request->to_datetime;
        	$schedule->distance = $request->distance;
        	$schedule->seats = $request->seats;
        	$schedule->note = $request->note;
        	$schedule->save();
        	$request->session()->flash('info', 'Thêm mới lịch trình thành công!');
        	return redirect('/');
        }
    }
    public function update($id)
    {
        $schedule = Schedule::findOrFail($id);
        $train = Train::all();
        return view("schedule.update", ['schedule' => $schedule, 'trains' => $train]);
    }
    public function storeupdate(Request $request)
    {
        $schedules = new Schedule;
        $validator = Validator::make($request->all(), $schedules->rules);
        if ($validator->fails()) {
            $request->session()->flash('error', 'Cập nhật lịch trình không thành công!');
            return redirect('schedule/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $tmp = Schedule::where('id', "<>", $request->id)->where('train_id', '=', $request->train_id)->where(function($query) use ($request){
                $query->where('from_datetime', '<=', "'".$request->from_datetime."'")
                        ->where("to_datetime", ">=", "'".$request->from_datetime."'")
                        ->orwhereBetween('from_datetime', array("'".$request->from_datetime."'", "'".$request->to_datetime."'"));
            })->first();
            if (count($tmp)>0)
            {
                $request->session()->flash('error', 'Tàu đã có lịch trình trong khoảng thời gian bạn chọn!');
                return redirect('schedule/'.$request->id)
                        ->withInput();
            }
            $schedule = Schedule::find($request->id);;
            $schedule->name = $request->name;
            $schedule->train_id = $request->train_id;
            $schedule->from_address = $request->from_address;
            $schedule->to_address = $request->to_address;
            $schedule->from_datetime = $request->from_datetime;
            $schedule->to_datetime = $request->to_datetime;
            $schedule->distance = $request->distance;
            $schedule->seats = $request->seats;
            $schedule->note = $request->note;
            $schedule->save();
            $request->session()->flash('info', 'Cập nhật lịch trình thành công!');
            return redirect('/');
        }
    }
    public function delete($id)
    {
        $schedule = Schedule::where('id', '=', $id);
        return $schedule->delete();
    }
}
