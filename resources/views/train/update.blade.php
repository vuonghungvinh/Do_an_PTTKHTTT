@extends('layouts.app')
@section('static')
    <link href="{{ URL::asset('css/train.css') }}" rel="stylesheet" type="text/css" >
@endsection
@section('content')
<div class="container addform">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">Cập nhật tàu</h1>
            <hr class="line">
            <div class="row">
                <div class="col-md-8 col-sm-10 coll-xs-12 col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
                    <form role="form" method="POST" action="{{ url('/trains/saveupdate') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$train->id}}">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" value="{{$train->name}}" name="name" id="name" placeholder="Tên">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" name="description" placeholder="Mô tả" id="description" rows="3">{{$train->description}}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-default">Cập nhật</button>
                        <a href="{{ url('/trains') }}" class="btn btn-danger">Hủy bỏ</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
