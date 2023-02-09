@php
$segment = request()->segment(2);
$title = 'Tambah'; $method = 'post'; $action = 'mastercabang.store'; $readonly='';
if ($segment !== 'create' ) { $title = 'Ubah'; $method = 'put'; $action = ['mastercabang.update', $d->kodecabang];  $readonly='readonly'; }
@endphp
@extends('adminlte::page')
@section('title', env('APP_NAME').'::'.$title.' MasterCabang')
@section('content')

@section('content_header')
<h1 class="m-0 text-dark">Master Cabang</h1>

@stop

@include('master-component.alert')
{{ Form::open(['route' => $action, 'method' => $method, 'class' => 'form-horizontal form-data', 'autocomplete' => 'off']) }}
<div class="card card-primary">
    <div class="card-header">
        <b>{{$title}} Data Master Cabang</b>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <div class="col-md-6">
                {{ Form::fgText('Kode Cabang', 'kodecabang', request()->kodecabang == null ? $d->kodecabang:  request()->kodecabang , ['class' => 'form-control',$readonly], null, 'text', true) }}                    
                {{ Form::fgText('Nama Cabang', 'namacabang', request()->namacabang == null ? $d->namacabang: request()->namacabang , ['class' => 'form-control'], null, 'text', true) }}
                {{ Form::fgSelect('Cabang Induk', 'kodeinduk',$listInduk, request()->kodeinduk == null ? $d->kodeinduk: request()->kodeinduk  , ['class' => 'form-control select2'], null, true) }}
                {{ Form::fgSelect('Kanwil', 'kodekanwil',$listKanwil, request()->kodekanwil == null ? $d->kodekanwil:  request()->kodekanwil , ['class' => 'form-control select2'], null,true) }}
                {{ Form::fgSelect('Status', 'status',to_dropdown($status), request()->status == null ? $d->status:  request()->status , ['class' => 'form-control'], null,true) }}
            </div>
        </div>
    </div>

    <div class="card-footer clearfix text-right">
        @include('master-component.button-form')
    </div>
</div>
{{ Form::close() }}
@endsection
