@extends(BaseHelper::getAdminMasterLayoutTemplate())
@section('content')
    <div
        class="max-width-1200"
        id="main-order"
    >
        <create-order
            :currency="'{{ get_application_currency()->symbol }}'"
            :zip_code_enabled="{{ (int) EcommerceHelper::isZipCodeEnabled() }}"
            :use_location_data="{{ (int) EcommerceHelper::loadCountriesStatesCitiesFromPluginLocation() }}"
            :is_tax_enabled={{ (int) EcommerceHelper::isTaxEnabled() }}
            :sub_amount_label="'{{ format_price(0) }}'"
            :tax_amount_label="'{{ format_price(0) }}'"
            :promotion_amount_label="'{{ format_price(0) }}'"
            :discount_amount_label="'{{ format_price(0) }}'"
            :shipping_amount_label="'{{ format_price(0) }}'"
            :total_amount_label="'{{ format_price(0) }}'"
        ></create-order>
    </div>
@stop

@push('header')
    <script>
        'use strict';

        window.trans = window.trans || {};

        window.trans.order = JSON.parse('{!! addslashes(json_encode(trans('plugins/ecommerce::order'))) !!}');
    </script>
@endpush
