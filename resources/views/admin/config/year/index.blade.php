@extends('layout.main')
@section('title', 'Financial Year - Personal Finance')
@push('styles')
    <style>
        .custom-card-header {
            display: flex;
            justify-content: space-between;
        }
    </style>
@endpush
@section('main-content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header custom-card-header">
                            <h4 class="card-title">Financial Year</h4>
                            <div class="top-button-link">
                                <div>
                                    <button data-route="{{route('financial-year.create')}}" id="add-button" class="px-4 py-2 border border-blue-600 text-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition">
                                        Add Financial Year
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Year ID</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Status</th>
                                            <th>Current Year</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($years) > 0)
                                        @foreach ($years as $year)
                                            <tr>
                                                <td>{{ $year->id }}</td>
                                                <td>{{ date('d-m-Y', strtotime($year->from_date)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($year->to_date)) }}</td>
                                                <td>{{ ($year->status == 'A') ? 'Active' : 'In Active' }}</td>
                                                <td>{{ ($year->is_running_year == 'Y') ? 'YES' : 'NO' }}</td>
                                                <td>{{ $year->created_at }}</td>
                                                <td>
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center"> Financial Year Data Not Available </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('modals.create-modal-one')
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {

            $("#add-button").on("click", function () {
                let url = $(this).data("route");

                $.ajax({
                    url: url,
                    type: "GET",
                    success: function (response) {
                        $("#ajaxCreateModalOne .modal-one-title").html('Add Financial Year');
                        $("#ajaxCreateModalOne .modal-body").html(response.body);
                        
                        var modal = new bootstrap.Modal(document.getElementById('ajaxCreateModalOne'));
                        modal.show();
                    },
                    error: function (xhr) {
                        alert("Failed to load view!");
                        console.log(xhr.responseText);
                    }
                });
            });

        });
    </script>
    @endpush
@endsection