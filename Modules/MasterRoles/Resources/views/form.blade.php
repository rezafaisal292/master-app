@php
$segment = request()->segment(2);
$title = 'Tambah'; $method = 'post'; $action = 'masterroles.store'; $readonly='';
if ($segment !== 'create' ) { $title = 'Ubah'; $method = 'put'; $action = ['masterroles.update', $role->id]; $readonly='readonly';}
@endphp
@extends('adminlte::page')
@section('title', env('APP_NAME').'::'.$title.' MasterRoles')
@section('content')

@section('content_header')
<h1 class="m-0 text-dark">Master Roles</h1>
@stop
{{ Form::open(['route' => $action, 'method' => $method, 'class' => 'form-horizontal form-data', 'autocomplete' => 'off']) }}
<div class="card card-primary">
    <div class="card-header">
        {{$title}} Data Master Roles
    </div>
    <div class="card-body">
        <div class="form-group row">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <b>Nama Role</b>
                    {!! Form::text('name', $role->name, array('placeholder' => 'Nama Role','class' => 'form-control',$readonly)) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <b>List Permission</b>
                    
                    <hr>
                    @foreach($page as $p)
                    <label>
                        {{ $p->nama }}
                    </label>
                    <br/>
                    <div class="row">
                        @foreach($permission as $value)
                            @if($p->url == substr($value->name,'0',strpos($value->name,'.')))
                            <div class="col-md-2">
                            {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                            &nbsp;
                                {{ $value->name }} 
                            </div>
                            @endif
                        @endforeach
                    </div>
                    <hr>
                    @endforeach

                </div>

            </div>
            {{-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div> --}}
        </div>
    </div>

    <div class="card-footer clearfix text-right">
        @include('master-component.button-form')
    </div>
</div>
{{ Form::close() }}
@endsection