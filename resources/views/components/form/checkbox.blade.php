<div class="form-group form-group-sm">
    {{ Form::label($name, $labelText, ['class' => 'control-label col-md-3']) }}
    <div class="col-sm-9">
        {{ Form::checkbox( $name, $value, $value, $attributes) }}
    </div>
</div>