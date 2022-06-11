
<table>
  <thead>
    <tr>
        <th>#</th>
        <th>Log Id</th>
        <th>Modified at</th>
        <th>Modified by</th>
        <th>Event</th>
        <th>Model</th>
        <th>Record Id</th>
        <th>Field</th>
        <th>Old Value</th>
        <th>New Value</th>
    </tr>
  </thead>
  <tbody>
    
    {{-- @foreach($records as $record) --}}
  @foreach($records->chunk(10) as $rows))
    @php 
        $sno = 1; 
    @endphp
        @foreach ($rows as $key => $row)
            @foreach($row->properties->attributes as $att_key => $att_value)
            <tr>
                <td>{{ $sno++ }}</td>  
                <td>{{ Arr::get($row, 'id') }}</td>  
                <td>{{ Arr::get($row, 'created_at_display') }}</td>  
                <td>{{ Arr::get($row, 'causerable.name') }}</td>  
                <td>{{ Arr::get($row, 'event') }}</td>  
                <td>{{ Arr::get($row, 'log_name') }}</td>  
                <td>{{ Arr::get($row, 'subject_id') }}</td>  
                <td>
                    {{  __formatLogTitle($att_key) }}</td>
                <td>
                    @if(!empty($row->properties->old->$att_key))
                        {{ $row->properties?->old?->$att_key  }}
                    @else
                        {{ __('msg.na') }}
                    @endif
                </td>
                <td>{{ $att_value }}</td>
            </tr>
            @endforeach
        @endforeach
  @endforeach
  </tbody>
</table>