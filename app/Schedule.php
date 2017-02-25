<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public   $rules = [
	    'name' => 'required|max:255',
        'train_id' => 'required|integer|min:1|exists:trains,id',
        'from_address' => 'required',
        'to_address' => 'required',
        'from_datetime' => 'required|date|date_format:Y-m-d H:i:s',
        'to_datetime' => 'required|date|after:from_datetime',
        'distance' => 'required|numeric|min:1',
        'seats' => 'required|integer|min:1',
        'note' => 'required',
	];
    public $messages = [
        'name.required' => "Bạn chưa nhập tên lịch trình",
        'name.max' => "Tên lịch trình không quá 255 kí tự",
        'train_id.required' => "Bạn chưa chọn tàu",
        'train_id.integer' => "Tàu phải là số nguyên",
        'train_id.min' => "ID của tàu phải lớn hơn 0",
        'train_id.exists' => "Tàu bạn chọn không có trong danh sách tàu",
        'from_address.required' => "Bạn chưa nhập địa chỉ đi",
        'to_address.required' => "Bạn chưa nhập địa chỉ đến",
        'from_datetime.required' => "Bạn chưa nhập thời gian đi",
        'from_datetime.date' => "Thời gian bạn nhập không đúng định dạng",
        'to_datetime.date' => "Thời gian bạn nhập không đúng định dạng",
        'to_datetime.required' => "Bạn chưa nhập thời gian đến",
        "to_datetime.after" => "Thời gian đến phải lớn hơn thời gian đi",
        'distance.required' => "Bạn chưa nhập khoảng cách",
        'distance.numeric' => "Khoảng cách phải là số",
        'distance.min' => "Khoảng cách phải lớn hơn 0",
        'seats.required' => "Bạn chưa nhập chỗ ngồi",
        'seats.integer' => "Chỗ ngồi phải là số nguyên",
        'seats.min' => "Chỗ ngồi phải lớn hơn 0",
        'note.required' => "Bạn chưa nhập ghi chú"
    ];
	public function train()
    {
        return $this->belongsTo('App\Train', 'train_id');
    }
}
