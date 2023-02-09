{{ Form::open(['url' => 'masteruser/filter', 'method' => 'post', 'class' => 'form-horizontal form-filter', 'role' => 'form', 'autocomplete' => 'off']) }}
<div class="row">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6" style="text-align:left">
                        <b>Pencarian</b>
                    </div>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body row">
                <div class="col-md-3">
                    {{ Form::fgText('Username', 'username', request()->username, ['class' => 'form-control'], null, 'text', false) }}
                </div>
            </div>
            <div class="card-footer clearfix float-right">
                <button type="submit" class="btn btn-info btn-sm">
                    <i class="fas fa-search"></i>&nbsp; Cari
                </button>
                &nbsp;
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