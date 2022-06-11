@push('page_title', $page_title ?? config('app.name'))
@push('scripts')
    @include('admin.common_script')
@endpush