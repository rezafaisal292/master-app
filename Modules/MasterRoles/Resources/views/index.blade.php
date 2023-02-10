@php
$segment = request()->segment(1);
@endphp
@extends('adminlte::page')
@section('title', env('APP_NAME').'::Master Roles')
@section('content_header')
    <h1 class="m-0 text-dark">Master Roles</h1>
@stop
@section('content')
@include('master-component.alert')
@include('masterroles::filter')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6" style="text-align:left">
             Total Data : {{$roles->total()}} 
          </div>
          
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>Aksi</th>
              <th>Nama Role</th>
              <th>List Permission</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($roles as $d)
            <tr>
                <td>
                {!! Html::linkResource($segment, ['id' => $d->id, 'label' => '`'.$d->name.'`']) !!}

                </td>
                <td>{{ $d->name }}</td>

                <td>
                  @foreach($page as $p)
                  <label>
                      {{ $p->nama }} 
                  </label>
                  <br/>
                  <div class="row">
                      @foreach($d->rolePermissions as $rp)
                          @if($p->url == substr($rp->permission->name,'0',strpos($rp->permission->name,'.')))
                          <div class="col-md-2">
                              {{ $rp->permission->name}} 
                          </div>
                          @endif
                      @endforeach
                  </div>
                  <hr>
                  @endforeach
                  
              
                </td>
               
               
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix float-right">

        <div class="row">
          <div class="col-6">
            {{ $roles->links("pagination::bootstrap-4") }}
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
