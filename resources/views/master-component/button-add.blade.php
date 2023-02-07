

@if((Auth::user()->can($segment.'.import')) && (Auth::user()->can($segment.'.create')))
@php $col = "col-6"; @endphp
@else
@php $col ="col-12 text-right"; @endphp
@endif

<div class="row text-right">
@if(Auth::user()->can($segment.'.create'))
<div class={{$col}}>
<a href="{{route($segment.'.create')}}" class="btn btn-primary btn-sm btn-load">
    <i class="fas fa-plus"></i>&nbsp; Tambah
</a>
</div>
@endif

   

@if(Auth::user()->can($segment.'.import'))
<div class={{$col}}>
{{ Form::open(['route' => $segment.'.import', 'method' => 'post', 'class' => 'form-horizontal form-data', 'autocomplete' => 'off','enctype'=>'multipart/form-data']) }}
<input type="file" name="file" required="required">
<button type="submit" class="btn btn-primary"> <i class="fas fa-file-excel"></i>&nbsp;Import</button>

{{ Form::close() }}

</div>
@endif
</div>