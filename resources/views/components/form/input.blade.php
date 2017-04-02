<div class="form-group">
    {{ Form::label($name, $labelText, ['class' => 'control-label col-md-3']) }}
    <div class="col-sm-9">
        {{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    </div>
</div>