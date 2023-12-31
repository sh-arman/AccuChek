@extends('admin.layouts.layout')
@section('title', 'Order Code | ACCU Chek Radiant LiveCheck Admin Panel')
@section('content')

    <form action="{{ route('order_store') }}" method="POST">
        @csrf
        <div class="card">
            <h5 class="card-header">Order Code <b class="text-primary float-end"> Available Code's : &nbsp;
                {{ number_format($codes) }} </b>
            </h5>
            <div class="row px-4">

                <div class="col-md-4">
                    <select name="template_id" class="form-select form-select-lg " id="exampleFormControlSelect1"
                        aria-label="Default select example" required>
                        <option selected>Select template</option>
                        @foreach ($templates as $template)
                            @if ($template->status == 'active')
                            <option value="{{ $template->id }}"> {{ $template->manufacture }} {{ $template->product }} {{ $template->detail }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- <div class="col-md-4">
                    <label >Manufacture Date</label>
                    <input type="date" id="mfg_date" name="manufacture_date" class="form-control  datepicker" placeholder="Manufacturing Date" required autocomplete="off">
                </div>

                <div class="col-md-4">
                    <label>Expiry Date</label>
                    <input type="text" id="expiry_date" name="expiry_date" class="form-control  datepicker" placeholder="Expiry Date" required>
                </div> --}}

                <div class="col-md-4">
                    <div class="form-floating">
                        <input name="manufacture_date"
                        type="text"
                        id="mfg_date"
                        class="form-control @error('manufacture_date') is-invalid @enderror  datepicker"
                        aria-describedby="floatingInputHelp"
                        required
                        autocomplete="off"/>
                        <label for="floatingInput">Manufacture Date</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-floating">
                        <input name="expiry_date"
                        type="text"
                        id="expiry_date"
                        class="form-control @error('expiry_date') is-invalid @enderror  datepicker"
                        aria-describedby="floatingInputHelp"
                        required
                        autocomplete="off" />
                        <label for="floatingInput">Expiry Date</label>
                    </div>
                </div>

                <div class="col-md-4 py-2">
                    <div class="form-floating">
                        <input name="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror"
                            id="floatingInput" placeholder="10000" aria-describedby="floatingInputHelp" required />
                        <label for="floatingInput">Quanity</label>
                    </div>
                </div>


                <div class="col-md-4 py-2">
                    <div class="form-floating">
                        <input name="batch_number" type="text"
                            class="form-control @error('batch_number') is-invalid @enderror" id="floatingInput"
                            placeholder="KHOB01" aria-describedby="floatingInputHelp" required />
                        <label for="floatingInput">Batch Number &nbsp; <p class="text-danger float-end">*Max limit 16</p></label>
                    </div>
                </div>


                <div class="col-md-4 py-2">
                    <div class="form-floating">
                        <input name="datapack_name" type="text"
                            class="form-control @error('datapack_name') is-invalid @enderror" id="floatingInput"
                            placeholder="ProductionBatch01" aria-describedby="floatingInputHelp" required />
                        <label for="floatingInput">Datapack Name</label>
                    </div>
                </div>


                <div class="col-md-6 pb-4 pt-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderConfirm">
                        <i class='bx bxs-zap'></i> &nbsp; Generate Code
                    </button>
                </div>

                <div class="col-md-6 pt-3 ">
                    <p class="text-danger float-end">* code generation max limit 400000 ( 4 lac ) per batch.</p>

                </div>
            </div>
        </div>


        <!-- Vertically Centered Modal -->
        <div class="col-lg-4 col-md-6">
            <div class="modal fade" id="orderConfirm" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="h-100">
                            <img class="img-fluid d-flex mx-auto" src="{{ asset('admin/assets/img/alert.gif') }}"
                                alt="Card image cap" style="width: 10rem;" />
                            <div class="card-body">
                                <h4 class="card-title text-center">Please check if all information are correct. <br>
                                    If not, you can go back and change it.
                                </h4>
                                <h4 class="card-text text-center">
                                    <b>Your message will look like: </b> <p class="text-primary"> SFS MCKRTWS </p>
                                </h4>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Back</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>



    {{-- Data Table --}}
    <div class="row mt-4">
        <div class="col">
            <div class="card p-4">
                <table id="example" class="table dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            {{-- <th class="col-0">Sl</th> --}}
                            <th>File Name</th>
                            <th>Batch</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Download</th>
                            {{-- <th>Template</th> --}}
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                {{-- <td>{{ $loop->index + 1 }}</td> --}}
                                <td>{{ $order->file }}</td>
                                <td>{{ $order->batch_number }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>
                                    @if ($order->status == 'running')
                                    <span class="badge bg-label-danger me-1">{{ ucfirst($order->status) }}</span>
                                    @elseif ($order->status == 'pending')
                                    <span class="badge bg-label-warning me-1">{{ ucfirst($order->status) }}</span>
                                    @elseif ($order->status == 'finished')
                                    <span class="badge bg-label-info me-1">{{ ucfirst($order->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($order->status == 'finished')
                                    <a class="btn btn-sm btn-primary" href="{{ asset('Codes/' . $order->file) }}"
                                        download="{{ $order->file }}">
                                        {{-- download="{{ strpos($order->datapack_name, '_') != false ? explode('_', $order->file, 2)[1] : $order->file }}"> --}}
                                        {{-- Download  --}}
                                        <i class='bx bx-download'></i> &nbsp; CSV
                                    </a>
                                    @endif
                                </td>
                                {{-- <td>{{ $order->template->manufacture . ' ' . $order->template->product . ' ' . $order->template->detail }}</td> --}}
                                <td>{{ date_format($order->created_at, 'd/m/y - g:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>

$('.datepicker').datepicker({
        format: 'yyyy-mm',
        autoclose: true,
        startView: "months",
        minViewMode: "months",
        viewMode: "months",
        changeMonth: true,
        changeYear: true
    });

    $('#mfg_date').datepicker().on("change", function() {
        var d = $('#mfg_date').datepicker('getDate');
        d.setFullYear(d.getFullYear(), d.getMonth() + 24);
        $('#expiry_date').datepicker('setDate', d);
    });

</script>
@endpush
