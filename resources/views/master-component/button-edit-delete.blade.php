@php $i= 0; @endphp
<form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route($segment.'.destroy', $d->id) }}" method="POST">
    
    @if(Auth::user()->can($segment.'.show'))
    <a href="{{ route(request()->segment(1).'.show', $d->id) }}" class="btn btn-sm btn-info text-white btn-load">
        <i class="fas fa-eye"></i>
    </a> &nbsp;

    @php $i=+1; @endphp
    @endif 


    @if(Auth::user()->can($segment.'.edit'))
        <a href="{{ route(request()->segment(1).'.edit', $d->id) }}" class="btn btn-sm btn-warning text-white btn-load">
            <i class="fas fa-edit"></i>
        </a> &nbsp;

        @php $i=+1; @endphp
    @endif 

    @if(Auth::user()->can($segment.'.destroy'))
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash-alt"></i>
        </button>
   

        @php $i=+1; @endphp
    @endif
    

    @if($i<1)
    Tidak Ada Aksi
    @endif
</form>
