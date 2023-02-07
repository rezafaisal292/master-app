@php
$segment = request()->segment(1);
@endphp
@extends('adminlte::page')

@section('title', env('APP_NAME').'::Master Page')

@section('content_header')
<h1 class="m-0 text-dark">Master Page</h1>
@stop

@section('content')
@include('master-component.alert')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
  <div class="col-12">
    <div class="card">
      
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>Aksi</th>
              <th>Nama</th>
              <th>URL</th>
              <th>Icon</th>
              <th>Urutan</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $d)
            <tr>
            <td>
              {{-- @include('master-component.button-edit-delete') --}}
              
              {!! Html::linkResource($segment, ['id' => $d->id, 'label' => $d->nama]) !!}
              </td>
              <td>{{$d->nama}}</td>
              <td>{{$d->url}}</td>
              <td><i class="{{$d->icon}}"></i></td>
              <td>{{$d->urutan}}</td>
              <td>{{$status[$d->status]}}</td>
            </tr>
            @if(count($d->childPage)>0)
            @foreach($d->childPage as $cp)
            <tr>
              <td></td>
              <td style="text-align:center">{{$cp->nama}}</td>
              <td style="text-align:center">{{$cp->url}}</td>
              <td><i class="{{$cp->icon}}"></i></td>
              <td>{{$cp->urutan}}</td>
              <td>{{$status[$cp->status]}}</td>
            </tr>
            @endforeach
            @endif
            @endforeach

          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix float-right">

        <div class="row">
          <div class="col-6">

          </div>
          <div class="col-6 text-right">
           
              @include('master-component.button-add')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@stop