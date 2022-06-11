<div>
    <!-- Modal -->
    <div  class="modal fade" wire:ignore.self  id="{{ $modal_section_id ?? 'staticBackdrop' }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="{{ $modal_section_id ?? 'staticBackdrop' }}Label" aria-hidden="true">
        <div class="modal-dialog {{ $modal_size ?? null }} ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $modal_section_id ?? 'staticBackdrop' }}Label">{{ $modal_title ?? null }}</h5>
                    <div class="d-flex justify-content-end pr-2">
                        <div class="pt-1">
                            {{ $modal_header_action ?? null }}
                        </div>
                        <button wire:ignore:click="closeModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body p-0">
                    {{ $modal_body ?? null }}
                </div>
                @if(!empty($modal_footer))
                <div class="modal-footer">
                    {{ $modal_footer ?? null }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>