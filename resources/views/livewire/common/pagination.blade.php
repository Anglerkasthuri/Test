{{-- @if($records->total() > config('settings.perPage')) --}}
@if($records->total() > $records->perPage())
<div class="d-flex m-2">
  <div class="col-md-2">
    {!! Form::select('search.perPage', config('settings.per_page_options'), config('settings.perPage'), ['wire:model'=>'search.perPage', 'class'=>'form-control input-rounded search-input', 'style'=>'width:auto']); !!}
  </div>
  <div class=" col-md-10 d-flex justify-content-end pr-2">
      <div class="pr-2 pt-2">
          @lang('Showing :first to :last out of :total results', [
          'first' => $records->count() ? $records->firstItem() : 0,
          'last' => $records->count() ? $records->lastItem() : 0,
          'total' => $records->total()
          ])
      </div>
      <div>
          {{ $records->links() }}
      </div>
  </div>
</div>
@endif

{{-- <div class='pagination'>
  {{ $records->links() }}
</div> --}}