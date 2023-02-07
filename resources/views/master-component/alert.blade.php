
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<div class="loading-page">
  <div class="loading-content">
      <img src="{{ asset('img/loader.gif') }}" alt="">
      <h4 class="text-center loading-text">Loading...</h4>
  </div>
</div>

<div class="row">
    <div class="col-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('warning'))
            <div class="alert alert-warning alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($message = Session::get('info'))
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
            </div>
        @endif
    </div>
</div>

@section('js')
<script src="{{ asset('js/custom.js', request()->isSecure()) }}"></script>
@stop
@section('plugins.Sweetalert2', true)
@section('plugins.DateRangePicker', true)
@section('plugins.select2', true)
