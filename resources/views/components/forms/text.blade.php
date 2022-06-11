<div>
    @if(!empty($fieldAttributes['type']) && $fieldAttributes['type']=="label")
        {!! Form::label($fieldAttributes["id"], $fieldAttributes['value'],$fieldAttributes['attributes']) !!}
    @elseif(!empty($fieldAttributes['type']) && $fieldAttributes['type']=="heading")            
        <{{$fieldAttributes['heading'] ?? "h4"}}>{!! $fieldAttributes['value'] !!}</{{$fieldAttributes['heading'] ?? "h4"}}>
        @if(!empty($fieldAttributes['line']))
            <div class="col-lg-12 dropdown-divider"></div>
        @endif
    @else 
        <p>{!! $fieldAttributes['value'] !!}</p>
    @endif
</div>