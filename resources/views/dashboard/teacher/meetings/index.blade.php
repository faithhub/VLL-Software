@extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0 mb-4 mt-3">
                        <h6 class="mb-1 mt-1 font-weight-bold h3">Meetings</h6>
                        <div class="card-options" style="margin-right:2.5%">
                            <a href="{{ route('teacher.meetings.create') }}" class="btn btn-bg btn-primary p-3"><b>Create
                                    Meeting</b></a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table
                                            class="table table-bordere card-table table-vcenter text-nowrap dataTable no-footer"
                                            id="datatable" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" style="">No</th>
                                                    <th scope="row" class="sorting" style="">Title</th>
                                                    <th class="sorting" tabindex="0" style="">Password</th>
                                                    <th class="sorting" tabindex="0" style="">Meeting Date</th>
                                                    <th class="sorting" tabindex="0" style="">Link</th>
                                                    <th class="sorting" tabindex="0" style="">Created At</th>
                                                    <th class="sorting" tabindex="0" style="">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($meetings)
                                                    @php
                                                        $sn = 1;
                                                    @endphp
                                                    @foreach ($meetings as $meeting)
                                                        <tr class="">
                                                            <td class="sorting_1">{{ $sn++ }}</td>
                                                            <td><strong>{{ $meeting->title }}</strong></td>
                                                            <td>{{ $meeting->password }}</td>
                                                            <td>
                                                                {{ \Carbon\Carbon::parse($meeting->start)->format('D, M j, Y H:i:s') }}
                                                                -
                                                                {{ \Carbon\Carbon::parse($meeting->end)->format('D, M j, Y H:i:s') }}
                                                            </td>
                                                            <td>
                                                                {{-- {{ substr($meeting->link, 35, 20) }} --}}
                                                                <button
                                                                    class="btn btn-sm btn-outline-dark"
                                                                    onclick="copyMeeting('{{ $meeting->link }}')">Copy</button>
                                                            </td>
                                                            <td>
                                                                {{ $meeting->created_at->format('D, M j, Y') ?? '-' }}
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('teacher.meetings.view', $meeting->id) }}"
                                                                    class="btn btn-sm btn-outline-primary">View</i></a>
                                                                <a href="{{ route('teacher.meetings.delete', $meeting->id) }}"
                                                                    class="btn btn-sm btn-outline-danger"
                                                                    onclick="return confirm('Are you sure you want to delete this meeting?')">Delete</i></a>
                                                                {{-- <a href="{{ route('admin.user', $meeting->id) }}"
                                                                    class="btn btn-sm btn-outline-warning">Edit</i></a> --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function copyMeeting(link) {
            // console.log(link);
            navigator.clipboard.writeText(link).then(function() {
                console.log('Async: Copying to clipboard was successful!');
                toastr.success("Meeting link copied", "Success");
            }, function(err) {
                console.error('Async: Could not copy text: ', err);
            });
        }
    </script>
@endsection
