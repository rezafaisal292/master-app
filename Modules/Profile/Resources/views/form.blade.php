
@extends('adminlte::page')
@section('title', env('APP_NAME').'::Profile')
@section('content')

@section('content_header')
<h1 class="m-0 text-dark">Profile</h1>

@include('master-component.alert')
@stop
{{ Form::open(['route' => ['profile.update',  Auth::user()->id], 'method' => 'put', 'class' => 'form-horizontal form-data', 'autocomplete' => 'off']) }}
<div class="card card-primary">
    <div class="card-header">
        <b>Data Profile</b>
    </div>
    <div class="card-body">
        <div class="form-group row">

            <div class="col-md-6">
            {{ Form::fgText('Username', 'username', Auth::user()->username, ['class' => 'form-control','readonly'], null, 'text', true) }} 
            {{ Form::fgText('Nama', 'name', Auth::user()->name, ['class' => 'form-control'], null, 'text', true) }} 
            {{ Form::fgText('Role', 'role', Auth::user()->roles->first()->name, ['class' => 'form-control','readonly'], null, 'text', true) }} 
  
            {{ Form::fgPassword('Password Lama', 'old_password', null, ['class' => 'form-control'], null, 'text', true) }} 
            {{ Form::fgPassword('Password Baru', 'npassword', null, ['class' => 'form-control'], null, 'text', true) }} 
            {{ Form::fgPassword('Konfirmasi Password Baru', 'kpassword', null, ['class' => 'form-control'], null, 'text', true) }} 
            </div>
        </div>
    </div>

    <div class="card-footer clearfix text-right">
        <button type="submit" class="btn btn-sm btn-success">
            <i class="fas fa-save"></i>&nbsp; Simpan
        </button>
    </div>
</div>
{{ Form::close() }}
@endsection