@extends('admin.layouts.layout')
@section('title', 'Track List | ACCU Chek Radiant LiveCheck Admin Panel')
@section('content')
    {{-- Data Table --}}
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-body p-4">
                    <table id="example" class="table dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th class="col-0">SL</th>
                                {{-- <th>User ID</th> --}}
                                <th>Name</th>
                                <th>Action</th>
                                <th>Time & Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tracks as $track)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    {{-- <td>{{ $track->user->id }}</td> --}}
                                    <td>{{ $track->user->name }}</td>
                                    <td>
                                        @if    ($track->action == 1) Login
                                        @elseif($track->action == 2) Logout
                                        @elseif($track->action == 3) Code Generated
                                        @endif
                                    </td>
                                    <td>
                                        {{ date_format($track->created_at, 'd/m/y - g:i A') }}
                                        {{-- {{ $track->created_at->format('h:i | N.n.Y') }} </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    @if ( Auth::user()->role == 'panacea')
        <div class="card col-6 mt-4">
            <form action="{{ route('track_delete') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5> Delete All Track History</h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete all track history?</h6>
                        <p class="mb-0">Once you delete, there is no going back. Please be certain.</p>
                    </div>
                    <button type="submit" class="btn btn-danger deactivate-account">Delete</button>
                </div>
            </form>
        </div>
    @endif

@endsection

