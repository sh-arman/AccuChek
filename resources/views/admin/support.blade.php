@extends('admin.layouts.layout')
@section('title', 'Support | Shaheen Food Suppliers Admin Panel')
@section('content')

<div class="row">
    <div class="col-lg-12 order-0">
        <div class="card">
            <div class="d-flex align-items-end">
                {{-- <img class="mx-auto" src="{{ asset('admin/assets/img/banner.png') }}" alt="Panacea Live Ltd" style="width: 40rem;"/> --}}
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Welcome to Shaheen Food Suppliers Support Panel</h5>
                        <h6 class="mb-4">
                            Any kind of platform problem or maintanence issues please let us know on time.
                        </h6>
                        {{-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a> --}}
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{ asset('admin/assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="row mt-4">
    <div class="col">
        <div class="card p-4">
            <h4 class="card-title text-center text-primary">Emergency Contact Information</h4>
            <table  class="table dt-responsive nowrap mt-2" style="width:100%">
            {{-- <table id="example" class="table table-striped table-bordered" style="width:100%"> --}}
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Abdullah Md Taqi Ud-deen</td>
                        <td>Sales & Marketing</td>
                        <td>
                            <i class='text-primary bx bx-phone'></i> &nbsp; +88
                            <a href="tel:01648141011">01648141011</a>
                            <br>
                            <i class='text-primary bx bx-envelope'></i> &nbsp; abdullah@panacea.live
                        </td>
                    </tr>
                    <tr>
                        <td>Md Maruf Hossen</td>
                        <td>Sales</td>
                        <td>
                            <i class='text-primary bx bx-phone'></i> &nbsp; +88
                            <a href="tel:01648141011">01790419473</a>
                            <br>
                            <i class='text-primary bx bx-envelope'></i> &nbsp; maruf@panacea.live
                        </td>
                    </tr>

                    <tr>
                        <td>Mrs. Mirazi Akhter Rabu</td>
                        <td>Admin & HR</td>
                        <td>
                            <i class='text-primary bx bx-phone'></i> &nbsp; +88
                            <a href="tel:01734046809">01734046809</a>
                            <br>
                            <i class='text-primary bx bx-envelope'></i> &nbsp; mira@panacea.live
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

