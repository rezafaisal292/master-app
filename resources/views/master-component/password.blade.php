<div class="form-group {{ $layout ? 'row' : '' }}">
    @if($layout)
        <label for="" class="col-md-4 col-form-label">{{ $label }}</label>
        <div class="col-md-8">
            {{ Form::password($name, $attributes) }}
            @if(!is_null($help))
                <small class="form-text text-muted">{{ $help }}</small>
            @endif
        </div>
    @else
        <label for="">{{ $label }}</label>
        {{ Form::password($name, $attributes) }}
        @if(!is_null($help))
            <small class="form-text text-muted">{{ $help }}</small>
        @endif
    @endif
</div>
