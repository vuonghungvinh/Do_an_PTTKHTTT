@extends('layouts.app')
@section('static')
    <link href="{{ URL::asset('css/train.css') }}" rel="stylesheet" type="text/css" >
    <script type="text/javascript" src="{{ URL::asset('js/schedule.js') }}"></script>
@endsection
@section('content')
<div class="container addform">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">Cập nhật lịch trình</h1>
            <hr class="line">
            <div class="row">
                <div class="col-md-8 col-sm-10 coll-xs-12 col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
                    <form role="form" method="POST" action="{{ url('/schedule/saveupdate') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$schedule->id}}">
                        <div class="form-group {{ $errors->has('train_id') ? ' has-error' : '' }}">
                            <label for="train_id">Tàu</label>
                            <select name="train_id" id="train_id" class="form-control">
                            @foreach($trains as $train)
                                @if ($train->id == $schedule->train_id)
                                <option selected="selected" value="{{$train->id}}">{{$train->name}}</option>
                                @else
                                <option value="{{$train->id}}">{{$train->name}}</option>
                                @endif
                            @endforeach
                            </select>
                            @if ($errors->has('train_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('train_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">Tên lịch trình</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Tên lịch trình" value="{{$schedule->name}}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('from_address') ? ' has-error' : '' }}">
                            <label for="from_address">Địa chỉ đi</label>
                            <input type="text" class="form-control" name="from_address" id="from_address" value="{{$schedule->from_address}}" placeholder="Địa chỉ đi">
                            @if ($errors->has('from_address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('from_address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('to_address') ? ' has-error' : '' }}">
                            <label for="to_address">Địa chỉ đến</label>
                            <input type="text" class="form-control" name="to_address" id="to_address" value="{{$schedule->to_address}}" placeholder="Địa chỉ đến">
                            @if ($errors->has('to_address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('to_address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('from_datetime') ? ' has-error' : '' }}">
                            <label for="from_datetime">T/g bắt đầu</label>
                            <div class="input-group date">
                                <input type="text" class="form-control" value="{{$schedule->from_datetime}}" name="from_datetime" id="from_datetime" placeholder="T/g bắt đầu">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            @if ($errors->has('from_datetime'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('from_datetime') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('to_datetime') ? ' has-error' : '' }}">
                            <label for="to_datetime">T/g đến</label>
                            <div class="input-group date">
                                <input type="text" class="form-control" value="{{$schedule->to_datetime}}" name="to_datetime" id="to_datetime" placeholder="T/g đến">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            @if ($errors->has('to_datetime'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('to_datetime') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('distance') ? ' has-error' : '' }}">
                            <label for="distance">Khoảng cách(KM)</label>
                            <input type="number" class="form-control" value="{{$schedule->distance}}" name="distance" id="distance" placeholder="Khoảng cách">
                            @if ($errors->has('distance'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('distance') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('seats') ? ' has-error' : '' }}">
                            <label for="seats">Chỗ ngồi</label>
                            <input type="number" class="form-control" value="{{$schedule->seats}}" name="seats" id="seats" placeholder="Chỗ ngồi">
                            @if ($errors->has('seats'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('seats') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('note') ? ' has-error' : '' }}">
                            <label for="note">Mô tả</label>
                            <textarea class="form-control" name="note" value="{{$schedule->note}}" placeholder="Mô tả" id="note" rows="3">{{$schedule->note}}</textarea>
                            @if ($errors->has('note'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('note') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-default">Cập nhật</button>
                        <a href="{{ url('/') }}" class="btn btn-danger">Hủy bỏ</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
