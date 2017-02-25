<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    public   $rules = [
	    'name' => 'required|unique:trains|max:255',
        'description' => 'required',
	];
	public $messages = [
		'name.required' => "Bạn chưa nhập tên tàu.",
		'name.unique' => "Tên tàu bạn nhập đã bị trùng.",
		'name.max' => "Độ dài tối đa là 255 kí tự.",
		'description.required' => "Bạn chưa nhập mô tả."
	];
	protected $fillable = ['name','description'];
}
