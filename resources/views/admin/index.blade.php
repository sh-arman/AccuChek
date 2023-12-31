@extends('admin.layouts.layout')

@section('title','Dashboard | ACCU Chek Radiant LiveCheck Admin Panel')

@section('content')

        <div class="row mb-4">
            <div class="col-lg-6">
                    <div class="d-flex align-items-end">
                        <div class="card shadow-lg bg-white rounded">
                            <div class="input-group">
                                <span class="input-group-text">Code Availability </span>
                                <input type="text" class="form-control" id="code" name="code" autocomplete="off" maxlength="7"/>

                                <button class="btn btn-primary"type="submit" id="SearchCodeBtn">
                                    <i class='bx bx-search-alt'></i>&nbsp;
                                     {{-- Search --}}
                                </button>

                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-lg-3" style="display: none;" id="code_success">
                <button class="btn btn-primary fw-semibold">
                    <i class='bx bx-check-double'></i> &nbsp; Available
                </button>
            </div>

            <div class="col-lg-3" style="display: none;" id="code_error">
                <button class="btn btn-danger fw-semibold">
                    <i class='bx bx-x'></i> &nbsp; Not Available
                </button>
            </div>


        </div>

    <div class="col-lg-12 mb-4 order-0">
        <div class="">
            <div class="d-flex align-items-end row">
                <img class="mx-auto" src="{{ asset('admin/assets/img/banner.png') }}" alt="Panacea Live Ltd"
                {{-- style="width: 40rem;" --}}
                />
                {{-- <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Welcome to Kumarika Admin Panel</h5>
                        <p class="mb-4">
                            You have done <span class="fw-bold">72%</span> more sales today. Check your new badge
                            in your profile.
                        </p>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{ asset('admin/assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User"/>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
    <script>
        var SearchCodeUrl = "{{ url('search_code') }}";

        $(document).ready(function() {
            $("#SearchCodeBtn").attr("onclick", "SearchCodeFunction()");
        });

        function SearchCodeFunction() {
            console.log('SearchCodeFunction called');
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
                url: SearchCodeUrl,
                data: postData,
                dataType: "JSON",
                success: function(response) {
                    if (response.hasOwnProperty("success")) {
                        console.log('CodeVerify success');

                        $("#code_success").css("display","block");
                        $("#code_error").hide();

                    }
                    if (response.hasOwnProperty("error")) {
                        console.log('CodeVerify error');
                        $("#code_error").css("display","block");
                        $("#code_success").hide();

                        // $("#CodeWrong").hide();
                        // $("#CodeNull").delay(100).fadeIn();
                    }
                }
            });
        }

    </script>
@endpush
