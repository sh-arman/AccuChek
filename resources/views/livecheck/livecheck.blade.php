@extends('livecheck.master')

    {{-------------------------------------------------------------------------
    --------------------------------------------------------------------------
       Author: Shajedul Hasan Arman - armanhassan504@gmail.com
    --------------------------------------------------------------------------
       Github: https://github.com/sh-arman
       Linkedin: https://www.linkedin.com/in/armanhassan504
    --------------------------------------------------------------------------- --}}
@section('content')

        @include('livecheck.response')


        {{-- Code Div --}}
        <div id="CodeDiv" class="justify-content-center">
            <div class="d-flex flex-row-reverse">
                @if (Session::has('locale'))
                    @if (Session::get('locale') == 'bn')
                        <a class="btnlng" id="btnlang" href="{{ route('locale.setting', 'en') }}" role="button">English</a>
                    @elseif(Session::get('locale') == 'en')
                        <a class="btnlng" id="btnlang" style="font-family: 'Hind Siliguri', sans-serif;" href="{{ route('locale.setting', 'bn') }}" role="button">বাংলা</a>
                    @endif
                @else
                    <a class="btnlng" id="btnlang" href="{{ route('locale.setting', 'en') }}" role="button">English</a>
                @endif
            </div>
            {{-- <div class="d-flex justify-content-between ">
                <div>
                    <a class="btnlng" href="https://www.accu-chek.com.bd/" target="_blank" >Online Warranty</a>
                </div>
                <div>
                    @if (Session::has('locale'))
                        @if (Session::get('locale') == 'bn')
                            <a class="btnlng" id="btnlang" href="{{ route('locale.setting', 'en') }}" role="button">English</a>
                        @elseif(Session::get('locale') == 'en')
                            <a class="btnlng" id="btnlang" style="font-family: 'Hind Siliguri', sans-serif;" href="{{ route('locale.setting', 'bn') }}" role="button">বাংলা</a>
                        @endif
                    @else
                        <a class="btnlng" id="btnlang" href="{{ route('locale.setting', 'en') }}" role="button">English</a>
                    @endif
                </div>
            </div> --}}
            <label style="text-transform: uppercase; font-weight: bold; font-size: 18px; color: #ffffff;" for="">Verify your product</label>
            {{-- <p id="CodeNull" class="error none">{{ __('translate.code-error-null') }}</p>
            <p id="CodeWrong" class="error none">{{ __('translate.code-error') }}</p> --}}
            <input style="text-transform: uppercase;" type="text" class="input mx-auto mb-4" name="code" id="code" minlength="11" autocomplete="off"
                placeholder="{{ __('translate.lebel-code') }}" value="ACK " required />
        </div>


        {{-- Phone Div --}}
        <div id="PhoneDiv" class="justify-content-center none">
            <label id="PhoneLevel" class="input-lebel">{{ __('translate.lebel-phone') }}</label> <br>
            <p id="PhoneNull" class="error none">{{ __('translate.phone-error-null') }}</p>
            <p id="PhoneError" class="error none">{{ __('translate.phone-error') }}</p>
            <input type="number" class="input mx-auto mb-4" name="phone" id="phone" maxlength="11" autocomplete="off"
                required />
        </div>


        {{-- Live Div --}}
        {{-- <div id="LiveDiv" class="justify-content-center none">
            <p id="PhoneSuccess" class="error none">{{ __('translate.otp-send') }}&nbsp; </p>
            <p id="LiveNull" class="error none">{{ __('translate.live-error-null') }}</p>
            <p id="LiveError" class="error none">{{ __('translate.live-error') }}</p>
            <input type="number" class="input mx-auto mb-4" name="otp" id="otp" maxlength="4"
                placeholder="{{ __('translate.lebel-otp') }}" autocomplete="off" required />
        </div> --}}



        {{-- Buttons --}}
        <div class="justify-content-center">
            <button id="nextBtn" type="button" class="btnverify">{{ __('translate.btn-next') }}</button>
            <button id="checkBtn" type="button" class="btnverify none">{{ __('translate.btn-check') }}</button>
            <button id="doneBtn" type="button" class="btnverify none">{{ __('translate.btn-done') }}</button>
            <button id="retryBtn" type="button" class="btnverify none">{{ __('translate.btn-retry') }}</button>
        </div>


        <a class="" href="https://www.accu-chek.com.bd/" target="_blank">
            <img class="warranty" src="{{ asset('front/images/warranty.svg') }}">
        </a>

@endsection


@section('js')
    <script>
        var CodeDiv = true;
        var PhoneDiv = false;
        // var LiveDiv = false;
        var CodeVerifyUrl = "{{ url('codeVerify') }}";
        var PhoneVerifyUrl = "{{ url('phoneVerify') }}";
        var LiveVerifyUrl = "{{ url('liveCheck') }}";

        $(document).ready(function() {
            $("#nextBtn").attr("onclick", "BtnFunction()");
            $("#checkBtn").attr("onclick", "LiveVerify()");
            $("#doneBtn").click(function() {
                window.location.reload();
            });
            $("#retryBtn").click(function() {
                window.location.reload();
            });

            // footer hide/unhide when input box active
            // const button = document.querySelector('#code');
            // document.querySelector('#code').addEventListener('click', () => {
                // $("#footer").hide();
                // window.setTimeout(() => {
                //     $("#footer").show();
                // }, 30000);
                //  $("#content").css("height", "160%");
            //  });

            document.querySelector('#nextBtn').addEventListener('click', () => {
                // $("#content").css("height", "160%");
                $("#CodeWrong").hide();
            });

        });



        function BtnFunction() {
            if (CodeDiv == true) {
                CodeVerify();
            }
            if (PhoneDiv == true) {
                PhoneVerify();
            }
        }



        function CodeVerify() {
            console.log('CodeVerify called');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var postData = {};
            postData["_token"] = $('input[name="_token"]').val();
            postData["code"] = $('input[name="code"]').val();
            $.ajax({
                type: "POST",
                async: true,
                url: CodeVerifyUrl,
                data: postData,
                dataType: "JSON",
                success: function(response) {
                    if (response.hasOwnProperty("success")) {
                        console.log('CodeVerify success');
                        CodeDiv = false;
                        PhoneDiv = true;
                        $("#CodeNull").hide();
                        $("#CodeWrong").hide();
                        $("#CodeDiv").slideUp();
                        $("#PhoneDiv").slideDown();
                    }
                    if (response.hasOwnProperty("CodeNull")) {
                        $("#CodeWrong").hide();
                        $("#CodeNull").delay(100).fadeIn();
                        $("#content").css("height", "100%");
                    }
                    if (response.hasOwnProperty("CodeWrong")) {
                        $("#content").css("height", "100%");
                        $("#CodeNull").hide();
                        document.getElementById('CodeWrong').className = 'classname';
                        $("#CodeWrong").delay(100).slideDown();
                        // delay(100).slideDown();
                    }
                }
            });
        }



        function PhoneVerify() {
            console.log('PhoneVerify called');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var postData = {};
            postData["_token"] = $('input[name="_token"]').val();
            postData["phone"] = $('input[name="phone"]').val();
            $.ajax({
                type: "POST",
                async: true,
                url: PhoneVerifyUrl,
                data: postData,
                dataType: "JSON",
                success: function(response) {
                    if (response.success == 'success') {
                        console.log('PhoneVerify success');

                        // retry button showsup
                        window.setTimeout(() => {
                            $("#doneBtn").hide();
                            $("#retryBtn").slideDown();
                        }, 30000);

                        $("#PhoneSuccess").fadeIn();
                        $("#PhoneSuccess").append(response.PhoneSuccess);

                        $("#PhoneLevel").hide();

                        phoneDiv = false;
                        // LiveDiv = true;

                        LiveVerify();
                        $("#PhoneDiv").slideUp();

                        // $("#LiveDiv").delay(100).slideDown();

                        $("#nextBtn").hide();
                        // $("#checkBtn").show();
                    }

                    if (response.hasOwnProperty("PhoneError")) {
                        $("#PhoneLevel").hide();
                        $("#PhoneNull").hide();
                        $("#PhoneError").fadeIn();
                        $("#content").css("height", "110%");
                    }

                    if (response.hasOwnProperty("PhoneNull")) {
                        $("#PhoneLevel").hide();
                        $("#PhoneError").hide();
                        $("#PhoneNull").fadeIn();
                        $("#content").css("height", "110%");
                    }
                }
            });
        }



        function LiveVerify() {
            console.log('LiveVerify called');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var postData = {};
            // postData["_token"] = $('input[name="_token"]').val();
            // postData["otp"] = $('input[name="otp"]').val();

            $.ajax({
                type: "POST",
                async: true,
                url: LiveVerifyUrl,
                data: postData,
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'firsttime') {
                        console.log('firsttime');

                        $("#LiveLevel").hide();
                        $("#LiveDiv").slideUp();
                        $("#checkBtn").hide();
                        $("#doneBtn").show();

                        $("#logos").hide();
                        $("#verfiedIcon").delay(100).slideDown();


                        // $("#hero").css("height", "29%");
                        $("#content").css("margin-top", "19%");
                        $("#content").css("height", "110%");

                        $("#firsttimeDiv").delay(100).slideDown();
                        $("#first_response").append();
                        // $("#detail").append();
                        // $("#number").append();
                        // $("#company_name").append();

                        // $("#manufacture").append(response.manufacture);
                        // $("#product").append(response.product);
                        // $("#detail").append(response.detail);
                        // $("#manufacture_date").append(response.manufacture_date);
                        // $("#expiry").append(response.expiry);
                        // $("#batch").append(response.batch);
                    }


                    if (response.status == 'verified') {
                        console.log('verified');

                        $("#LiveDiv").slideUp();
                        $("#LiveLevel").hide();
                        $("#checkBtn").hide();
                        $("#doneBtn").show();

                        //$("#logos").hide();
                        //$("#verfiedIcon").delay(100).slideDown();
                        // $("#hero").css("height", "25%");
                        $("#content").css("margin-top", "19%");
                        $("#content").css("height", "150%");

                        $("#verifiedDiv").delay(100).slideDown();
                        $("#verified_response").append();

                        // $("#verified_manufacture").append(response.verified_manufacture);
                        // $("#verified_product").append(response.verified_product);
                        // $("#verified_detail").append(response.verified_detail);
                        // $("#verified_manufacture_date").append(response.verified_manufacture_date);
                        // $("#verified_expiry").append(response.verified_expiry);
                        // $("#verified_batch").append(response.verified_batch);

                        // $("#product").append();
                        // $("#detail").append();


                        $("#verified_preNumber").append(response.verified_preNumber);
                        $("#verified_preDate").append(response.verified_preDate);
                        $("#verified_totalCount").append(response.verified_totalCount);

                        // $("#company_name").append();
                    }


                    if (response.status == 'expired') {
                        console.log('expired');
                        $("#LiveDiv").slideUp();
                        $("#LiveLevel").hide();
                        $("#checkBtn").hide();
                        $("#doneBtn").show();

                        $("#logos").hide();
                        $("#wrongIcon").delay(100).slideDown();
                        $("#ErrorDiv").delay(100).slideDown();

                        $("#content").css("height", "75%");

                        $("#expired_manufacture").append(response.expired_manufacture);
                        $("#expired_product").append(response.expired_product);
                        $("#expired_detail").append(response.expired_detail);
                        $("#expired_expiry").append(response.expired_expiry);

                        $("#company_name").append();
                    }


                    if (response.hasOwnProperty("LiveNull")) {
                        console.log('liveNull');
                        $("#PhoneSuccess").hide();
                        $("#retryBtn").hide();
                        $("#LiveError").hide();
                        $("#LiveNull").fadeIn();
                    }


                    if (response.hasOwnProperty("LiveError")) {
                        console.log('LiveError');
                        $("#PhoneSuccess").hide();
                        $("#retryBtn").hide();
                        $("#LiveNull").hide();
                        $("#LiveError").delay(100).slideDown();
                    }
                }
            });
        }
    </script>
@endsection




{{-- backup with otp --}}
{{-- @extends('livecheck.master')
@section('content')

    <div class="content-box">

        @include('livecheck.response')


        <div id="CodeDiv" class="justify-content-center">
            <div class="d-flex flex-row-reverse">
                @if (Session::has('locale'))
                    @if (Session::get('locale') == 'bn')
                        <a class="btnlng" id="btnlang" href="{{ route('locale.setting', 'en') }}" role="button">English</a>
                    @elseif(Session::get('locale') == 'en')
                        <a class="btnlng" id="btnlang" style="font-family: 'Hind Siliguri', sans-serif;"
                            href="{{ route('locale.setting', 'bn') }}" role="button">বাংলা</a>
                    @endif
                @else
                    <a class="btnlng" id="btnlang" href="{{ route('locale.setting', 'bn') }}" role="button">বাংলা</a>
                @endif
            </div>
            <p id="CodeNull" class="error none">{{ __('translate.code-error-null') }}</p>
            <p id="CodeWrong" class="error none">{{ __('translate.code-error') }}</p>
            <input type="text" class="input mx-auto mb-4" name="code" id="code" minlength="11" autocomplete="off"
                placeholder="{{ __('translate.lebel-code') }}" required />
        </div>



        <div id="PhoneDiv" class="justify-content-center none">
            <label id="PhoneLevel" class="input-lebel">{{ __('translate.lebel-phone') }}</label> <br>
            <p id="PhoneNull" class="error none">{{ __('translate.phone-error-null') }}</p>
            <p id="PhoneError" class="error none">{{ __('translate.phone-error') }}</p>
            <input type="number" class="input mx-auto mb-4" name="phone" id="phone" maxlength="11" autocomplete="off"
                required />
        </div>



        <div id="LiveDiv" class="justify-content-center none">
            <p id="PhoneSuccess" class="error none">{{ __('translate.otp-send') }}&nbsp; </p>
            <p id="LiveNull" class="error none">{{ __('translate.live-error-null') }}</p>
            <p id="LiveError" class="error none">{{ __('translate.live-error') }}</p>
            <input type="number" class="input mx-auto mb-4" name="otp" id="otp" maxlength="4"
                placeholder="{{ __('translate.lebel-otp') }}" autocomplete="off" required />
        </div>



        <div class="justify-content-center">
            <button id="nextBtn" type="button" class="btnverify">{{ __('translate.btn-next') }}</button>
            <button id="checkBtn" type="button" class="btnverify none">{{ __('translate.btn-check') }}</button>
            <button id="doneBtn" type="button" class="btnverify none">{{ __('translate.btn-done') }}</button>
            <button id="retryBtn" type="button" class="btnverify none">{{ __('translate.btn-retry') }}</button>
        </div>

    </div>
@endsection --}}


{{-- @section('js')
    <script>
        var CodeDiv = true;
        var PhoneDiv = false;
        var LiveDiv = false;
        var CodeVerifyUrl = "{{ url('codeVerify') }}";
        var PhoneVerifyUrl = "{{ url('phoneVerify') }}";
        var LiveVerifyUrl = "{{ url('liveCheck') }}";

        $(document).ready(function() {
            $("#nextBtn").attr("onclick", "BtnFunction()");
            $("#checkBtn").attr("onclick", "LiveVerify()");
            $("#doneBtn").click(function() {
                window.location.reload();
            });
            $("#retryBtn").click(function() {
                window.location.reload();
            });

            const button = document.querySelector('#code');
            button.addEventListener('click', () => {
                $("#footer").hide();
                window.setTimeout(() => {
                    $("#footer").show();
                }, 10000);
            });

        });



        function BtnFunction() {
            if (CodeDiv == true) {
                CodeVerify();
            }
            if (PhoneDiv == true) {
                PhoneVerify();
            }
        }



        function CodeVerify() {
            console.log('CodeVerify called');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var postData = {};
            postData["_token"] = $('input[name="_token"]').val();
            postData["code"] = $('input[name="code"]').val();
            $.ajax({
                type: "POST",
                async: true,
                url: CodeVerifyUrl,
                data: postData,
                dataType: "JSON",
                success: function(response) {
                    if (response.hasOwnProperty("success")) {
                        console.log('CodeVerify success');
                        CodeDiv = false;
                        PhoneDiv = true;
                        $("#CodeDiv").slideUp();
                        $("#PhoneDiv").slideDown();
                    }
                    if (response.hasOwnProperty("CodeNull")) {
                        $("#CodeWrong").hide();
                        $("#CodeNull").fadeIn();
                    }
                    if (response.hasOwnProperty("CodeWrong")) {
                        $("#CodeNull").hide();
                        $("#CodeWrong").fadeIn();
                    }
                }
            });
        }



        function PhoneVerify() {
            console.log('PhoneVerify called');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var postData = {};
            postData["_token"] = $('input[name="_token"]').val();
            postData["phone"] = $('input[name="phone"]').val();
            $.ajax({
                type: "POST",
                async: true,
                url: PhoneVerifyUrl,
                data: postData,
                dataType: "JSON",
                success: function(response) {
                    if (response.success == 'success') {
                        console.log('PhoneVerify success');

                        window.setTimeout(() => {
                            $("#doneBtn").hide();
                            $("#retryBtn").slideDown();
                        }, 30000);

                        $("#PhoneSuccess").fadeIn();
                        $("#PhoneSuccess").append(response.PhoneSuccess);

                        $("#PhoneLevel").hide();

                        phoneDiv = false;
                        LiveDiv = true;

                        $("#PhoneDiv").delay(100).slideUp();
                        $("#LiveDiv").delay(100).slideDown();

                        $("#nextBtn").hide();
                        $("#checkBtn").show();
                    }

                    if (response.hasOwnProperty("PhoneError")) {
                        $("#PhoneLevel").hide();
                        $("#PhoneNull").hide();
                        $("#PhoneError").fadeIn();
                    }

                    if (response.hasOwnProperty("PhoneNull")) {
                        $("#PhoneLevel").hide();
                        $("#PhoneError").hide();
                        $("#PhoneNull").fadeIn();
                    }
                }
            });
        }



        function LiveVerify() {
            console.log('LiveVerify called');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var postData = {};
            postData["_token"] = $('input[name="_token"]').val();
            postData["otp"] = $('input[name="otp"]').val();

            $.ajax({
                type: "POST",
                async: true,
                url: LiveVerifyUrl,
                data: postData,
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 'firsttime') {
                        console.log('firsttime');

                        $("#LiveLevel").hide();
                        $("#LiveDiv").slideUp();
                        $("#checkBtn").hide();
                        $("#doneBtn").show();

                        $("#logos").hide();
                        $("#verfiedIcon").delay(100).slideDown();


                        $("#hero").css("height", "25%");
                        $("#content").css("height", "90%");

                        $("#firsttimeDiv").delay(100).slideDown();

                        $("#product").append();
                        $("#detail").append();
                        $("#number").append();
                    }


                    if (response.status == 'verified') {
                        console.log('verified');

                        $("#LiveDiv").slideUp();
                        $("#LiveLevel").hide();
                        $("#checkBtn").hide();
                        $("#doneBtn").show();

                        $("#logos").hide();
                        $("#verfiedIcon").delay(100).slideDown();

                        $("#hero").css("height", "25%");
                        $("#content").css("height", "90%");

                        $("#verifiedDiv").delay(100).slideDown();
                        $("#number").append();

                        $("#verified_preNumber").append(response.verified_preNumber);
                        $("#verified_preDate").append(response.verified_preDate);
                        $("#verified_totalCount").append(response.verified_totalCount);
                    }


                    if (response.status == 'expired') {
                        console.log('expired');
                        $("#LiveDiv").slideUp();
                        $("#LiveLevel").hide();
                        $("#checkBtn").hide();
                        $("#doneBtn").show();

                        $("#logos").hide();
                        $("#wrongIcon").delay(100).slideDown();
                        $("#ErrorDiv").delay(100).slideDown();

                        $("#content").css("height", "75%");

                        $("#expired_manufacture").append(response.expired_manufacture);
                        $("#expired_product").append(response.expired_product);
                        $("#expired_detail").append(response.expired_detail);
                        $("#expired_expiry").append(response.expired_expiry);
                    }


                    if (response.hasOwnProperty("LiveNull")) {
                        console.log('liveNull');
                        $("#PhoneSuccess").hide();
                        $("#retryBtn").hide();
                        $("#LiveError").hide();
                        $("#LiveNull").fadeIn();
                    }


                    if (response.hasOwnProperty("LiveError")) {
                        console.log('LiveError');
                        $("#PhoneSuccess").hide();
                        $("#retryBtn").hide();
                        $("#LiveNull").hide();
                        $("#LiveError").fadeIn();
                    }
                }
            });
        }
    </script>
@endsection --}}

