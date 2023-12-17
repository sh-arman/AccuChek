{{-- ================================================= First Time ==================================================== --}}
<div class="response-box" id="firsttimeDiv">
    <h6>{{trans('translate.first_heading')}}</h6>
    <div class="info">
        <p id="product">{{ __('translate.product') }}</p>
        <p id="detail">{{ __('translate.detail') }}</p>
        <p id="number">{{ __('translate.number') }}</p>
        <p id="company_name"><span class="bold-title">{{ __('translate.company_name') }}</span>&nbsp;</p>
    </div>
    {{-- <div class="info">
        <p id="manufacture"><span class="bold-title">{{ __('translate.manufacture') }} :</span>&nbsp;</p>
        <p id="product"><span class="bold-title">{{ __('translate.product') }} :</span> &nbsp;</p>
        <p id="detail"><span class="bold-title">{{ __('translate.detail') }} :</span> &nbsp;</p>
        <p id="manufacture_date"><span class="bold-title">{{ __('translate.manufacture_date') }} :</span>&nbsp;</p>
        <p id="expiry"><span class="bold-title">{{ __('translate.expiry') }} :</span>&nbsp;</p>

    </div> --}}
</div>



{{-- ================================================= Verified ==================================================== --}}
<div class="response-box" id="verifiedDiv">

    <h6>{{trans('translate.verified_heading')}}</h6>

    {{-- <div class="info">
        <p id="verified_manufacture"><span class="bold-title">{{ __('translate.manufacture') }} :</span>&nbsp;</p>
        <p id="verified_product"><span class="bold-title">{{ __('translate.product') }} :</span> &nbsp;</p>
        <p id="verified_detail"><span class="bold-title">{{ __('translate.detail') }} :</span> &nbsp;</p>
        <p id="verified_manufacture_date"><span class="bold-title">{{ __('translate.manufacture_date') }} :</span>&nbsp;</p>
        <p id="verified_expiry"><span class="bold-title">{{ __('translate.expiry') }} :</span>&nbsp;</p>

    </div> --}}

    <div class="warning">
        <p>{{ trans('translate.warning') }}</p>
        <img src="{{ asset('front/images/warning.svg') }}">
    </div>

    <div class="info">
        <p id="verified_preNumber"><span class="bold-title">{{ __('translate.previous_number') }} :</span>&nbsp;</p>
        <p id="verified_preDate"><span class="bold-title">{{ __('translate.previous_date') }} :</span>&nbsp;</p>
        <p id="verified_totalCount"><span class="bold-title">{{ __('translate.total_count') }} :</span>&nbsp;</p>
        <p id="number" class="bold-title">{{ __('translate.complain_number') }}</p>
        <p id="company_name"><span class="bold-title">{{ __('translate.company_name') }} </span>&nbsp;</p>
    </div>

</div>



{{-- ================================================= Expired ==================================================== --}}
<div class="response-box" id="ErrorDiv">
    {{-- <span>
        <img class="img-2"src="{{ asset('front/images/warning.svg') }}" alt="Panacea Live" />
        <p class="bold-title">{{ __('translate.expired_warning') }}</p>
    </span> --}}
    <h6>{{trans('translate.expired_heading')}}</h6>
    <div class="info">
        <p id="expired_manufacture"><span class="bold-title">{{ __('translate.manufacture') }} :</span>&nbsp;</p>
        <p id="expired_product"><span class="bold-title">{{ __('translate.product') }} :</span> &nbsp;</p>
        <p id="expired_detail"><span class="bold-title">{{ __('translate.detail') }} :</span> &nbsp;</p>
        <p id="expired_expiry"><span class="bold-title">{{ __('translate.expiry') }} :</span>&nbsp;</p>
        <p id="company_name"><span class="bold-title">{{ __('translate.company_name') }} </span>&nbsp;</p>
    </div>

    <div class="warning">
        <p>{{ trans('translate.expired_warning') }}</p>
        <img src="{{ asset('front/images/warning.svg') }}">
    </div>

</div>




{{-- ================================================= CodeNull ==================================================== --}}
<div class="error none" id="CodeNull">
    <p>{{ __('translate.code-error-null') }}</p>
</div>


{{-- ================================================= CodeWrong ==================================================== --}}
<div class="error none" id="CodeWrong">
    <p>{{ __('translate.code-error') }}
        <br>
        {{ __('translate.company_name') }}
        <br>
        {{ __('translate.complain_number') }}
    </p>
</div>


{{-- <p id="CodeNull" class="error none">{{ __('translate.code-error-null') }}</p> --}}
{{-- <p id="CodeWrong" class="error none">{{ __('translate.code-error') }}</p>  --}}
