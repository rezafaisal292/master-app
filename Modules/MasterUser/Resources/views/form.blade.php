@php
$segment = request()->segment(2);
$title = 'Tambah'; $method = 'post'; $action = 'masteruser.store'; $readonly='';
if ($segment !== 'create' ) { $title = 'Ubah'; $method = 'put'; $action = ['masteruser.update', $d->id];  $readonly='readonly';}
@endphp
@extends('adminlte::page')
@section('title', env('APP_NAME').'::'.$title.' Master User')
@section('content')

@section('content_header')
<h1 class="m-0 text-dark">Master User</h1>
@stop
{{ Form::open(['route' => $action, 'method' => $method, 'class' => 'form-horizontal form-data', 'autocomplete' => 'off']) }}
<div class="card card-primary">
    <div class="card-header">
        <b>{{$title}} Data Master User</b>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                {{ Form::fgText('Username', 'username', $d->username, ['class' => 'form-control',$readonly], null, 'text', true) }}
                {{ Form::fgText('Nama', 'name', $d->name, ['class' => 'form-control'], null, 'text', true) }}
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Role:</strong>
                    {!! Form::select('roles', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer clearfix text-right">
        @include('master-component.button-form')
    </div>
</div>
{{ Form::close() }}
@endsection