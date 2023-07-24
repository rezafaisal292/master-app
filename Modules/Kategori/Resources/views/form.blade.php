@php
$segment = request()->segment(2);
$title = 'Tambah'; $method = 'post'; $action = 'kategori.store'; $readonly='';
if ($segment !== 'create' ) { $title = 'Ubah'; $method = 'put'; $action = ['kategori.update', $d->id]; $readonly='readonly';  }
@endphp
@extends('adminlte::page')
@section('title', env('APP_NAME').'::'.$title.' Kategori')
@section('content')

@section('content_header')
<h1 class="m-0 text-dark">Kategori</h1>

@include('master-component.alert')
@stop
{{ Form::open(['route' => $action, 'method' => $method, 'class' => 'form-horizontal form-data', 'autocomplete' => 'off']) }}
<div class="card card-primary">
    <div class="card-header">
        <b>{{$title}} Data Kategori</b>
    </div>
    <div class="card-body">
        <div class="form-group row">
              <div class="col-md-6">
                {{-- {{ Form::fgText('Nama', 'nama', request()->nama == null ? $d->nama: request()->nama , ['class' => 'form-control'], null, 'text', true) }} --}}
                {{-- {{ Form::fgSelect('Status', 'status',$status, request()->status == null ? $d->status: request()->status  , ['class' => 'form-control select2'], null, true) }}  --}}
            </div>
        </div>
    </div>

    <div class="card-footer clearfix text-right">
        @include('master-component.button-form')
    </div>
</div>
{{ Form::close() }}
@endsection