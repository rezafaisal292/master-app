@php
$segment = request()->segment(2);
$title = 'Tambah';
$method = 'post';
$action = 'masterpage.store';
if ($segment !== 'create') {
    $title = 'Ubah';
    $method = 'put';
    $action = ['masterpage.update', $d->id];
}
$checked = false;
@endphp
@extends('adminlte::page')
@section('title', env('APP_NAME') . '::' . $title . ' Master Page')
@section('content')

@section('content_header')
    <h1 class="m-0 text-dark">Master Page</h1>
@stop
{{ Form::open(['route' => $action,'method' => $method,'class' => 'form-horizontal form-data','autocomplete' => 'off']) }}
<div class="card card-primary">
    <div class="card-header">
        <b>{{ $title }} Data Master Page</b>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Form::fgText('Nama', 'nama', $d->nama, ['class' => 'form-control'], null, 'text', true) }}
                {{ Form::fgText('URL', 'url', $d->url, ['class' => 'form-control'], null, 'text', true) }}
                {{ Form::fgText('Icon', 'icon', $d->icon, ['class' => 'form-control'], null, 'text', true) }}
                {{-- {{ Form::fgText('Parent', 'parent', $d->parent, ['class' => 'form-control'], null, 'text', true) }} --}}
                {{ Form::fgSelect('Parent', 'parent',to_dropdown($parent), $d->parent, ['class' => 'form-control '], null,true) }}
                {{ Form::fgText('Urutan', 'urutan', $d->urutan, ['class' => 'form-control'], null, 'text', true) }}
                {{ Form::fgSelect('Status', 'status',to_dropdown($status), $d->status, ['class' => 'form-control '], null,true) }}
            </div>
        </div>
    </div>

    <div class="card-footer clearfix text-right">
        @include('master-component.button-form')
    </div>
</div>
{{ Form::close() }}
@endsection
