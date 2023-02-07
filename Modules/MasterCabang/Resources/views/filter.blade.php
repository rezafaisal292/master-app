{{ Form::open(['url' => 'mastercabang/filter', 'method' => 'post', 'class' => 'form-horizontal form-filter', 'role' => 'form', 'autocomplete' => 'off']) }}
<div class="row">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6" style="text-align:left">
                        Pencarian
                    </div>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body row">
                <div class="col-md-1">
                    {{ Form::fgText('Kode Cabang', 'kodecabang', request()->kodecabang, ['class' => 'form-control'], null, 'text', false) }}                    
                </div>
                <div class="col-md-2">
                {{ Form::fgText('Nama Cabang', 'namacabang', request()->namacabang, ['class' => 'form-control'], null, 'text', false) }}
                </div>
                <div class="col-md-3">
                    {{ Form::fgSelect('Cabang Induk', 'kodeinduk',$listInduk, request()->kodeinduk, ['class' => 'form-control select2'], false) }}
                </div>
                <div class="col-md-3">
                    {{ Form::fgSelect('Kanwil', 'kodekanwil',$listKanwil, request()->kodekanwil, ['class' => 'form-control Select2'], false) }}
                </div>
            </div>
            <div class="card-footer clearfix float-right">
                <button type="submit" class="btn btn-info btn-sm">
                    <i class="fas fa-search"></i>&nbsp; Cari
                </button>
                  @if(request()->segment(2) == 'filter')
                <a href="{{url($segment)}}" class="btn btn-danger btn-sm">
                    <i class="fas fa-times"></i>&nbsp; Hapus Pencarian
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}