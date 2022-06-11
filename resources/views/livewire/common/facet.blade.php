@if (count($facet_data))
    <div class="card-body facet-section">
        <div class="row">
            {{-- @dump($this->facet_data); --}}
            @foreach ($facet_data as $fs_key => $fs_value)
                @php
                  $facet_display = [];
                @endphp
                <div class="col-lg-12">
                    <label class="mt-2 pr-2"> {{ $fs_key }} </label>
                    <button class="btn bg-gradient-info text-white btn-xs"
                        wire:click="setFacetValue('{{ $fs_key }}', '{{ $fs_value['field'] }}')">
                        All <span class="badge badge-warning"> {{ $fs_value['all'] }} </span>
                    </button>
                    @foreach ($fs_value['facet'] as $fsd_key => $fsd_value)
                        @php
                            $id = $fsd_value['id'];
                            $title = $fsd_value['title'];
                            $aggregate = $fsd_value['aggregate'];
                            $field_name = $fsd_value['field_name'];
                            $button_color = '';
                            if ($fsd_value['aggregate'] > 0) {
                                $badge_color = 'badge-warning';
                            } else {
                                $badge_color = 'badge-danger';
                                $button_color = 'disabled';
                            }
                            if (isset($facet_active[$fs_key][$field_name]) && $facet_active[$fs_key][$field_name] == $id) {
                                $button_color .= ' active';
                            }
                        @endphp
                        <button
                            wire:click="setFacetValue('{{ $fs_key }}','{{ $field_name }}','{{ $id }}')"
                            class="btn  btn-xs  {{ $button_color }}">
                            {{ $title }} <span class="badge {{ $badge_color }}"> {{ $aggregate }} </span>
                        </button>
                    @endforeach
                </div>
            @endforeach

        </div>
    </div>
@endif
