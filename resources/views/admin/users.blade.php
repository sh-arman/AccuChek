@extends('admin.layouts.layout')
@section('title', 'Users | Shaheen Food Suppliers Admin Panel')
@section('content')
    {{-- Data Table --}}
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Create Profile Modal -->
                <h5 class="card-header">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createProfile">
                        Create User <i class='bx bx-plus'></i>
                    </button>
                </h5>

                <div class="card-body p-4">
                    <table id="example" class="table dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th class="col-0">ID</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>organization</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td class="col-2">
                                        <!-- Update User modal -->
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#user_update_{{ $user->id }}">
                                            <i class='bx bx-edit'></i>
                                        </button>
                                        <!-- Delete User modal -->
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#user_delete_{{ $user->id }}">
                                            <i class='bx bx-trash-alt'></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Update User modal -->
                                <div class="modal fade" id="user_update_{{ $user->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('user_update', ['id' => $user->id]) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCenterTitle">
                                                        {{ $user->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-2">
                                                        <div class="col mb-3">
                                                            <div class="form-floating">
                                                                <input name="phone_number" type="text"
                                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                                    id="floatingInput" value="{{ $user->phone_number }}"
                                                                    aria-describedby="floatingInputHelp" />
                                                                <label for="floatingInput">Phone Number</label>
                                                            </div>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <div class="form-floating">
                                                                <input name="password" type="text"
                                                                    class="form-control @error('password') is-invalid @enderror"
                                                                    id="floatingInput"
                                                                    aria-describedby="floatingInputHelp" />
                                                                <label for="floatingInput">Password</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row g-2">
                                                        <div class="col mb-3">
                                                            <div class="form-floating">
                                                                <input name="email" type="text"
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    id="floatingInput" value="{{ $user->email }}"
                                                                    aria-describedby="floatingInputHelp" />
                                                                <label for="floatingInput">Email</label>
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
                                <!-- End  Update User modal -->




                                <!-- Delete User modal -->
                                <div class="modal fade" id="user_delete_{{ $user->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('user_delete', ['id' => $user->id]) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCenterTitle"> <b> Delete Account : </b> {{ $user->name }} </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-warning">
                                                        <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                                                        <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger deactivate-account">Delete Account</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End  Delete User modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Create Profile Modal -->
    <div class="modal fade" id="createProfile" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">
                        User Form
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="card p-4">
                    <form id="formAccountSettings" method="POST" action="{{ route('custom_register') }} ">
                        @csrf
                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" type="text" id="name" name="name" autofocus
                                    required />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Phone Number</label>
                                <input type="number" id="phoneNumber" name="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror"" required />
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" type="email" id="email" name="email"  required />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror"
                                    value="{{ old('password') }}" type="password" id="password" name="password"
                                    required />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">Organization</label>
                                <select name="role" id="organization" class="select2 form-select" required>
                                    <option value="">Select organization</option>
                                    <option value="panacea">Panacea</option>
                                    <option value="admin">Shaheen Food Suppliers</option>
                                </select>
                            </div>

                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Create Profile Modal -->


@endsection

