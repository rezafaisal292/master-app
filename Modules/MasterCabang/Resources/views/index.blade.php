@php
$segment = request()->segment(1); $export=['xls'];
@endphp
@extends('adminlte::page')
@section('title', env('APP_NAME').'::Master Cabang')
@section('content_header')
    <h1 class="m-0 text-dark">Master Cabang</h1>
@stop
@section('content')
@include('master-component.alert')
@include('mastercabang::filter')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6" style="text-align:left">
             Total Data : {{$data->total()}} 
          </div>
          <div class="col-md-6" style="text-align:right">
            {{ Form::open(['route' => $segment.'.export', 'method' => 'post', 'class' => 'form-horizontal form-data', 'autocomplete' => 'off']) }}
            {!! Form::hidden('deal_ref', request()->deal_ref) !!}
            @include('master-component.button-export')
            {{ Form::close() }}
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>Aksi</th>
              <th>Kode Cabang</th>
              <th>Nama Cabang</th>
              <th>Cabang Induk</th>
              <th>Kanwil</th>
              <th>Status</th>
              <th>Time Stamp</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $d)
            <tr>
              <td>
              
                {!! Html::linkResource($segment, ['id' => $d->kodecabang , 'label' => '`'.$d->namacabang.'`']) !!}
              </td>
              <td>{{$d->kodecabang}}</td>
              <td>{{$d->namacabang}}</td>
              <td>{{$d->kodeinduk}}  - {{$d->induk == null ? '-' :$d->induk->namacabang}}</td>
              <td>{{$d->kodekanwil}} - {{$d->wilayah == null ? '-' :$d->wilayah->namacabang}}</td>
              <td>{{$status[$d->status]}}</td>
              <td>{{$d->updated_at}}</td>
            </tr>
            @endforeach 
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix float-right">

        <div class="row">
          <div class="col-6">
            {{ $data->links("pagination::bootstrap-4") }}
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
