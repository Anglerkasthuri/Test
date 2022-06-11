<div>
<form autocomplete="off">
    <div class="row">
        <div class="form-group form-focus col-3">
            {!! Form::number('search.id', null, ['wire:model.debounce.500ms' => 'search.id', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.id', 'ID', ['class' => 'focus-label']) !!}
        </div>
        <div class="form-group form-focus col-3">
            {!! Form::text('search.title', null, ['wire:model' => 'search.title', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.title', 'Country', ['class' => 'focus-label']) !!}
        </div>
        <div class="form-group form-focus col-3">
            {!! Form::text('search.dial_code', null, ['wire:model' => 'search.dial_code', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!} 
            {!! Form::label('search.dial_code', 'Dial Code', ['class' => 'focus-label']) !!}
        </div>
        <div class="form-group form-focus col-3">
            {!! Form::text('search.iso2_code', null, ['wire:model' => 'search.iso2_code', 'class' => 'form-control input-rounded search-input floating', 'placeholder' => '']) !!}
            {!! Form::label('search.iso2_code', 'ISO 2', ['class' => 'focus-label']) !!}
        </div>
        <div class="form-group form-focus col-3 focused" wire:ignore.self>
            <div wire:ignore>
                {!! Form::select('search.continent_id', $this->searchContinentList, 'S', ['wire:model.debounce.2000ms' => 'search.continent_id', 'class' => 'form-control input-rounded search-input m-select-12__ selectpicker floating', 'placeholder_' => '', 'id' => 'search.continent_id',  'multiple' => 'multiple']) !!}
                {!! Form::label('search.continent_id', 'Continent', ['class' => 'focus-label']) !!}    
            </div>
        </div>
        <div class="form-group form-focus col-3 focused" wire:ignore.self>
            <div>
                
                {!! Form::select('search.sub_continent_id', $this->searchSubContinentList, 'S', ['wire:model.defer' => 'search.sub_continent_id', 'class' => 'form-control input-rounded search-input  m-select-12__ selectpicker floating', 'placeholder_' => '', 'id' => 'search.sub_continent_id', 'multiple' => 'multiple']) !!}
                {!! Form::label('search.sub_continent_id', 'Sub Continent', ['class' => 'focus-label']) !!}
        </div>
    </div>
        <div class="form-group form-focus col-3 focused">
            
            {!! Form::select('search.active', config('settings.active_field'), 'S', ['wire:model' => 'search.active', 'class' => 'form-control input-rounded search-input floating selectpicker', 'placeholder' => '--Select--']) !!}
            {!! Form::label('search.active', 'Active', ['class' => 'focus-label']) !!}
        </div>
        <div class="form-group col-3">
            <button type="button" wire:click.prevent="search()" class="btn btn-primary">Search</button>
            <button type="button" wire:click.prevent="resetSearch()" class="btn btn-warning">Reset</button>
            <button type="button" wire:click.prevent="export()" class="btn btn-primary">Export</button>
        </div>
    </div>
</form>
@push('scripts')
<script>

$('.m-select-12').on('change', function(e) {
     let elementName = $(this).attr('id');
        var data = $(this).val();
        @this.set(elementName, data);
    });
    
//      $('.m-select-12').select2({
//   closeOnSelect: false
// });
// window.livewire.on('selectLoadOk', () =>{
//         $('.m-select-12').select2('destroy');
//         $('.m-select-12').select2({
//   closeOnSelect: false
// });
// });

    
  
    

  // START Bootsrap Select
   $('.m-select-12').multiselect({
          enableClickableOptGroups: true,
          enableCollapsibleOptGroups: true,
          enableFiltering: true,
          includeSelectAllOption: true,
          buttonTextAlignment: 'left',
          autoClose: false,
          enableCaseInsensitiveFiltering: true,
      }); 

     window.livewire.on('selectLoadOk', () =>{
        $('.m-select-12').multiselect('destroy');
        $('.m-select-12').multiselect({
          enableClickableOptGroups: true,
          enableCollapsibleOptGroups: true,
          enableFiltering: true,
          includeSelectAllOption: true,
          buttonTextAlignment: 'left',
          enableCaseInsensitiveFiltering: true,
          autoClose: false
      }); 
    });
  // END Bootsrap Select
</script>
@endpush
</div>