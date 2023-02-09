@php
$segment = request()->segment(1);
@endphp
@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('title', env('APP_NAME').'::MasterUser')

@section('content_header')
    <h1 class="m-0 text-dark">Master User</h1>
@stop

@section('content')
@include('master-component.alert')
@include('masteruser::filter')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6" style="text-align:left">
             Total Data : {{$data->total()}} 
          </div>
          
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>Aksi</th>
              <th>Username</th>
              <th>Nama</th>
              <th>Role</th>
            </tr>
          </thead>
          <tbody>
             @foreach ($data as $d)
            <tr>
              <td>
              
                {!! Html::linkResource($segment, ['id' => $d->id, 'label' => '`'.$d->username.'`']) !!}
              </td>
              <td>{{$d->username}}</td>
              <td>{{$d->name}}</td>
              <td>{{$d->getRoleNames()->first()}}</td>
              
            </tr>
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
