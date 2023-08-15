@include('manage.food.brand.detail.combo')
@include('manage.food.brand.detail.food')
@include('manage.food.brand.detail.addtion')
@include('build_data.material.material.detail')

@push('scripts')
    <script type="text/javascript" src="{{asset('js/manage/food/brand/detail.js?version=4',env('IS_DEPLOY_ON_SERVER'))}}"></script>
@endpush
