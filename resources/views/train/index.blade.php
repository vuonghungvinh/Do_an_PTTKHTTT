@extends('layouts.app')
@section('static')
    <link href="{{ URL::asset('css/train.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.1.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.1.0/jquery-confirm.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/train.js') }}"></script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">Danh sách tàu</h1>
            <p class="add"><a class="btn btn-info" href="{{ url('/trains/add') }}">Thêm</a></p>
            <hr class="line">
            @if (count($trains)>0)
            <table class="table table-bordered list-trains">
                <thead>
                    <td>Tên</td>
                    <td>Mô tả</td>
                    <td>Ngày tạo</td>
                    <td style="width: 70px;">#</td>
                </thead>
                <tbody>
                    @foreach ($trains as $train)
                    <tr>
                        <td>{{$train->name}}</td>
                        <td>{{$train->description}}</td>
                        <td>{{$train->created_at}}</td>
                        <td>
                            <a title="Cập nhật" class="edit" href="{{ url('/trains/'.$train->id) }}">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                            <a title="Xoá" class="delete" name="{{$train->name}}" href="{{ url('/trains/' .$train->id. '/delete') }}">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $trains->links() }}
            @else
            <h3 class="title">Không có tàu nào</h3>
            @endif
        </div>
    </div>
</div>
@endsection
