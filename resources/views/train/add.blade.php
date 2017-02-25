@extends('layouts.app')
@section('static')
    <link href="{{ URL::asset('css/train.css') }}" rel="stylesheet" type="text/css" >
@endsection
@section('content')
<div class="container addform">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">Thêm tàu</h1>
            <hr class="line">
            <div class="row">
                <div class="col-md-8 col-sm-10 coll-xs-12 col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
                    <form role="form" method="POST" action="{{ url('/trains/save') }}">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">Tên tàu</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Tên tàu" value="{{old('name')}}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" name="description" placeholder="Mô tả" id="description" rows="3">{{old('description')}}</textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-default">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
