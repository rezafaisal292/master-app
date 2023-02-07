@php
$segment = request()->segment(2);
$title = 'Tambah'; $method = 'post'; $action = 'opsi.store';
if ($segment !== 'create' ) { $title = 'Ubah'; $method = 'put'; $action = ['opsi.update', $d->id]; }
@endphp
@extends('adminlte::page')
@section('title', env('APP_NAME').'::'.$title.' Opsi')
@section('content')

@section('content_header')
<h1 class="m-0 text-dark">Opsi</h1>
@stop
{{ Form::open(['route' => $action, 'method' => $method, 'class' => 'form-horizontal form-data', 'autocomplete' => 'off']) }}
<div class="card card-primary">
    <div class="card-header">
        {{$title}} Data Opsi
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="" class="col-md-3 col-form-label">Opsi</label>
            <div class="col-md-9">
                @if($d->optionValues->count())
                @foreach($d->optionValues as $v)
                <div class="options" id="options{{ $loop->iteration }}">
                    <div class="row" style="margin-bottom:8px">
                        <div class="col-sm-4">
                            {{ Form::text('keys[]', $v->key, ['class' => 'form-control', 'placeholder' => 'Key Opsi']) }}
                            <!-- </div> -->

                            <!-- <div class="col-sm-4"> -->
                            {{ Form::text('values[]', $v->value, ['class' => 'form-control', 'placeholder' => 'Value Opsi']) }}
                        </div>

                        <div class="col-sm-4">
                            <a href="javascript:void(0);" class="btn btn-sm btn-info m-r-5 add" id="add{{ $loop->iteration }}">
                                <i class="fa fa-plus"></i>
                            </a>&nbsp;
                            <a href="javascript:void(0);" class="btn btn-sm btn-danger rmv" id="rmv{{ $loop->iteration }}">
                                <i class="fa fa-minus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="options" id="options0">
                    <div class="row" style="margin-bottom:8px">
                        <div class="col-sm-4">
                            {{ Form::text('keys[]', null, ['class' => 'form-control', 'placeholder' => 'Key Opsi']) }}
                        </div>

                        <div class="col-sm-4">
                            {{ Form::text('values[]', null, ['class' => 'form-control', 'placeholder' => 'Value Opsi']) }}
                        </div>

                        <div class="col-sm-4">
                            <a href="javascript:void(0);" class="btn btn-sm btn-info m-r-5 add" id="add0">
                                <i class="fa fa-plus"></i>
                            </a>&nbsp;
                            <a href="javascript:void(0);" class="btn btn-sm btn-danger rmv" id="rmv0">
                                <i class="fa fa-minus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="card-footer clearfix text-right">
        @include('master-component.button-form')
    </div>
</div>
{{ Form::close() }}
@endsection