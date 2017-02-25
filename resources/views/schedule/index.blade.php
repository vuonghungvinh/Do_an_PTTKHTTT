@extends('layouts.app')
@section('static')
    <link href="{{ URL::asset('css/schedule.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.1.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.1.0/jquery-confirm.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/schedule.js') }}"></script>
@endsection
@section('content')
<div class="container listschedule">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">Danh sách lịch trình</h1>
            <p class="add"><a class="btn btn-info" href="{{ url('/schedule/add') }}">Thêm</a></p>
            <hr class="line">
            <div class="row filter">
                <div class="col-md-12">
                    <span>Lọc bởi: </span>
                    <select id="trainfilter" class="form-control">
                    @if ($id == 0)
                        <option selected="selected" value="">Tất cả</option>
                    @else
                        <option value="">Tất cả</option>
                    @endif
                    @foreach($trains as $train)
                        @if ($id == $train->id)
                            <option selected="selected" value="{{$train->id}}">{{$train->name}}</option>
                        @else
                            <option value="{{$train->id}}">{{$train->name}}</option>
                        @endif
                    @endforeach
                    </select>
                </div>
            </div>
            @if (count($schedules)>0)
            <table class="table table-bordered list-schedules">
                <thead>
                    <td>Tên lịch trình</td>
                    <td>Tên tàu</td>
                    <td>Từ</td>
                    <td>Đến</td>
                    <td>T/g bắt đầu</td>
                    <td>T/g kết thúc</td>
                    <td>Khoảng cách(KM)</td>
                    <td>Chỗ ngồi</td>
                    <td>Ghi chú</td>
                    <td>Ngày tạo</td>
                    <td style="width: 70px;">#</td>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{$schedule->name}}</td>
                        <td><a href="{{ url('/trains/'.$schedule->train_id) }}">{{$schedule->train->name}}</a></td>
                        <td>{{$schedule->from_address}}</td>
                        <td>{{$schedule->to_address}}</td>
                        <td>{{$schedule->from_datetime}}</td>
                        <td>{{$schedule->to_datetime}}</td>
                        <td>{{$schedule->distance}}</td>
                        <td>{{$schedule->seats}}</td>
                        <td>{{$schedule->note}}</td>
                        <td>{{$schedule->created_at}}</td>
                        <td>
                            <a title="Sửa" class="edit" href="{{ url('/schedule/'.$schedule->id) }}">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                            <a title="Xoá" class="delete" name="{{$schedule->name}}" href="{{ url('/schedule/' .$schedule->id. '/delete') }}">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $schedules->links() }}
            @else
            <h3 class="title">Không có lịch trình nào</h3>
            @endif
        </div>
    </div>
</div>
@endsection
