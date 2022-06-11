
    @if(!empty($fieldAttributes['type']) && $fieldAttributes['type']=="number")
        {!! Form::number($fieldAttributes['id'], null, $fieldAttributes['attributes']??[]) !!}    
    @else 
        {!! Form::text($fieldAttributes['id'], null, $fieldAttributes['attributes']??[]) !!}    
    @endif
