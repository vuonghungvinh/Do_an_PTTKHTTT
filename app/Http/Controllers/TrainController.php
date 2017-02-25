<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Train;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class TrainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $trains = Train::paginate(4);
        return view('train.index', ['trains' => $trains]);
    }
    public function add()
    {
        return view("train.add");
    }
    public function store(Request $request)
    {
        $trains = new Train;
        $validator = Validator::make($request->all(), $trains->rules, $trains->messages);
        if ($validator->fails()) {
            $request->session()->flash('error', 'Thêm tàu mới không thành công!');
            return redirect('trains/add')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $train = new Train;
            $train->name = $request->name;
            $train->description = $request->description;
            $train->save();
            $request->session()->flash('info', 'Thêm tàu mới thành công!');
            return redirect('trains/');
        }
    }
    public function update($id)
    {
        $train = Train::findOrFail($id);
        return view("train.update", ['train' => $train]);
    }
    public function delete($id)
    {
        $train = Train::where('id', '=', $id);
        return $train->delete();
    }
    public function storeupdate(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
        ], [
            'name.required' => "Bạn chưa nhập tên tàu.",
            'name.max' => "Độ dài tối đa là 255 kí tự.",
            'description.required' => "Bạn chưa nhập mô tả."
        ]);
        if ($validator->fails()) {
            $request->session()->flash('error', 'Cập nhật tàu lỗi!');
            return redirect('trains/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $tmp = Train::wherenotin('id', [$request->id,])->where('name', '=', $request->name)->first();
            // var_dump($tmp); die("dsdsd");    
            if (count($tmp)>0)
            {
                $trains = new Train;
                $validator = Validator::make($request->all(), $trains->rules);
                if ($validator->fails())
                {
                    $request->session()->flash('error', 'Cập nhật tàu lỗi!');
                    return redirect('trains/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
                }
            }
            $train = Train::find($request->id);
            $train->name = $request->name;
            $train->description = $request->description;
            if($train->save()){
                $request->session()->flash('info', 'Cập nhật tàu thành công!');
                return redirect('trains/');
            } else {
                $request->session()->flash('error', 'Cập nhật tàu lỗi!');
                return redirect('trains/'.$request->id)
                        ->withErrors($train->error())
                        ->withInput();
            }
        }
    }
}
