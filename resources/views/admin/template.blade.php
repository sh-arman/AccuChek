@extends('admin.layouts.layout')

@section('title', 'Template | Shaheen Food Suppliers Admin Panel')

@section('content')

    <form action="{{ route('template_store') }}" method="POST">
        @csrf
        <div class="card">
            <h5 class="card-header">Template</h5>
            <div class="row px-4">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input name="manufacture" type="text"
                            class="form-control @error('manufacture') is-invalid @enderror" id="floatingInput"
                            placeholder="Kumarika" aria-describedby="floatingInputHelp" required />
                        <label for="floatingInput">Manufacture Name</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input name="product" type="text" class="form-control @error('product') is-invalid @enderror"
                            id="floatingInput" placeholder="Hair Oil" aria-describedby="floatingInputHelp" required />
                        <label for="floatingInput">Product Name</label>
                    </div>
                </div>

                <div class="col-md-6 py-4">
                    <div class="form-floating">
                        <input name="detail" type="text" class="form-control @error('detail') is-invalid @enderror"
                            id="floatingInput" placeholder="250 ml" aria-describedby="floatingInputHelp" required />
                        <label for="floatingInput">Details</label>
                    </div>
                </div>

                <div class="col-md-6 py-4">
                    <small class="text-light fw-semibold d-block">Status</small>
                    <div class="form-check form-check-inline mt-3">
                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="active"
                            checked />
                        <label class="form-check-label" for="inlineRadio1">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="inactive" />
                        <label class="form-check-label" for="inlineRadio2">Inactive</label>
                    </div>
                </div>

                <div class="col-md-6 pb-4">
                    <button type="submit" class="btn btn-primary">
                        <i class='bx bx-save'></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>



    <div class="row mt-4">
        <div class="col">
            <div class="card p-4">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="col-1">Sl</th>
                            <th>Manufacture</th>
                            <th>Product</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th class="col-2">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td class="col-1">{{ $loop->index + 1 }}</td>
                                <td>{{ $data->manufacture }}</td>
                                <td>{{ $data->product }}</td>
                                <td>{{ $data->detail }}</td>
                                <td>{{ $data->status }}</td>
                                <td class="col-2">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#tamplateEdit_{{ $data->id }}">
                                        <i class='bx bx-edit'></i>
                                    </button>
                                    <a href="{{ route('template_delete', ['id' => $data->id]) }}"
                                        class="btn btn-sm btn-danger"><i class='bx bx-trash-alt'></i>
                                    </a>
                                </td>
                            </tr>




                            <!-- Vertically Centered Modal -->
                            <div class="col-lg-4 col-md-6">
                                <div class="mt-3">
                                    <!-- Modal -->
                                    <div class="modal fade" id="tamplateEdit_{{ $data->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('template_update', ['id' => $data->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">
                                                            {{ $data->manufacture }} - {{ $data->product }} -
                                                            {{ $data->detail }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row g-2">
                                                            <div class="col mb-3">
                                                                <div class="form-floating">
                                                                    <input name="manufacture" type="text"
                                                                        class="form-control @error('manufacture') is-invalid @enderror"
                                                                        id="floatingInput"
                                                                        value="{{ $data->manufacture }}"
                                                                        aria-describedby="floatingInputHelp" required />
                                                                    <label for="floatingInput">Manufacture Name</label>
                                                                </div>
                                                            </div>
                                                            <div class="col mb-3">
                                                                <div class="form-floating">
                                                                    <input name="product" type="text"
                                                                        class="form-control @error('product') is-invalid @enderror"
                                                                        id="floatingInput" value="{{ $data->product }}"
                                                                        aria-describedby="floatingInputHelp" required />
                                                                    <label for="floatingInput">Product Name</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <div class="form-floating">
                                                                    <input name="detail" type="text"
                                                                        class="form-control @error('detail') is-invalid @enderror"
                                                                        id="floatingInput" value="{{ $data->detail }}"
                                                                        aria-describedby="floatingInputHelp" required />
                                                                    <label for="floatingInput">Details</label>
                                                                </div>
                                                            </div>
                                                            <div class="col mb-0">
                                                                <small
                                                                    class="text-light fw-semibold d-block">Status</small>
                                                                <div class="form-check form-check-inline mt-3">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="status" id="inlineRadio1" value="active"
                                                                        {{ $data->status == 'active' ? 'checked' : '' }} />
                                                                    <label class="form-check-label"
                                                                        for="inlineRadio1">Active</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="status" id="inlineRadio2" value="inactive"
                                                                        {{ $data->status == 'inactive' ? 'checked' : '' }} />
                                                                    <label class="form-check-label"
                                                                        for="inlineRadio2">Inactive</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
