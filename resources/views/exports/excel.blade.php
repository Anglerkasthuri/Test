
<table>
  <thead>
  <tr>
      <th><b>#</b></th>
      @foreach($headings as $heading)
        <th><b>{{ $heading }}</b></th>  
      @endforeach
  </tr>
  </thead>
  <tbody>
    {{-- @foreach($records as $record) --}}
  @foreach($records->chunk(10) as $rows))
      @foreach ($rows as $key => $row)  
        <tr>
            <td>{{ $key + 1 }}</td>  
            @foreach($columns as $column)
              {{-- <td>{{ $row?->$column }}</td> --}}
              <td>{{ Arr::get($row, $column) }}</td>
              
            @endforeach
        </tr>
      @endforeach
  @endforeach
  </tbody>
</table>