<div class="form-check">
    {!! Form::checkbox($fieldAttributes['id'], $fieldAttributes['value'] ?? null, false, $fieldAttributes['attributes'] ?? []) !!}
    {!! Form::label($fieldAttributes['attributes']['id'], $fieldAttributes['label'], ['class' => !empty($fieldAttributes['label_class'])?$fieldAttributes['label_class'].' control-label':'control-label']) !!}
</div>