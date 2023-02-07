
  
@if(Auth::user()->can($segment.'.export'))
  {!! Form::hidden('type', null,array('id' => 'type')) !!} 
  @if (in_array("xls", $export))
  <button type="submit"  class="btn btn-success btn-sm" onclick="Export('xls')">
    <i class="fas fa-file-excel"></i>&nbsp; Export XLS
  </button>
  @endif

  @if (in_array("pdf", $export))
  &nbsp;
  <button type="submit" class="btn btn-danger btn-sm" onclick="Export('pdf')">
    <i class="fas fa-file-pdf"></i>&nbsp; Export PDF
  </button>
  @endif
@endif
