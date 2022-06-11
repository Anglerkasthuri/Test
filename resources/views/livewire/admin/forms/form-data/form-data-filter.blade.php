<form autocomplete="off">
    <div class="row">
        <div class="form-group form-focus col-3">
            {!! Form::number('search.id', null, ['wire:model.debounce.500ms' => 'search.id', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.id', 'ID', ['class' => 'focus-label']) !!}
        </div>
        @foreach ($this->formFieldFilters as $form_field)
            @switch($form_field["type"] ?? null)
                //Master Option Select
                @case('master-option-select')
                    <div class="form-group form-focus col-3">
                        <x-forms.master-option-select wire:key="{{ now() }}" :formFieldId="$form_field['form_field_id']" :fieldAttributes="$form_field['field']">
                        </x-forms.master-option-select>
                        {!! Form::label($form_field['id'], $form_field['label']['value'], $form_field['label']['attributes']) !!}
                        
                    </div>
                @break

                //system-model-select
                @case('system-model-select')
                    <div class="form-group form-focus col-3">
                        <x-forms.system-model-select wire:key="{{ now() }}" :formFieldId="$form_field['form_field_id']" :fieldAttributes="$form_field['field']">
                        </x-forms.system-model-select>
                        {!! Form::label($form_field['id'], $form_field['label']['value'], $form_field['label']['attributes']) !!}
                        
                    </div>
                @break

                // Input
                @case('input')
                    <div class="form-group form-focus col-3">
                        <x-forms.input wire:key="{{ now() }}" :fieldAttributes="$form_field['field']">
                            </x-forms.text>
                            {!! Form::label($form_field['id'], $form_field['label']['value'], $form_field['label']['attributes']) !!}   
                    </div>
                @break

                // TextArea
                @case('textarea')
                    <div class="form-group form-focus col-3">   
                        <x-forms.text-area wire:key="{{ now() }}" :fieldAttributes="$form_field['field']">
                        </x-forms.text-area>
                        {!! Form::label($form_field['id'], $form_field['label']['value'], $form_field['label']['attributes']) !!}
                        
                    </div>
                @break
            @endswitch
        @endforeach
        <div class="form-group form-focus col-3">
            {!! Form::select('search.active', config('settings.active_field'), 'S', ['wire:model.defer' => 'search.active', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.active', 'Active', ['class' => 'focus-label']) !!}
        </div>
        <div class="form-group form-focus col-3">
            <button type="button" wire:click.prevent="search()" class="btn btn-primary">Search</button>
            <button type="button" wire:click.prevent="resetSearch()" class="btn btn-warning">Reset</button>
        </div>
    </div>
</form>
