@extends('layouts.app')
@section('title', 'Report')
@section('content')
    <!-- Page Heading -->
    <!--<h1 class="h3 mb-2 text-gray-800">Turnover Report</h1>-->
    @if ($errors->any())
        <div class="alert alert-danger error_wrapper">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Generate the report.</h5>
            <span>Report will be generated for the first 7 days of the month.</span>
            <br>
            <em>Select the relevant month to generate the report.</em>
        </div>
        <div class="card-body">
            <form class="col-12">
                <div class="form-group">
                    <label for="period">Select the month and the year.</label>
                    <select class="form-control" id="period">
                        <option value="">Select the month and the year.</option>
                        <optgroup label="2018">
                            <option value="2018-1">January</option>
                            <option value="2018-2">February</option>
                            <option value="2018-3">March</option>
                            <option value="2018-4">April</option>
                            <option value="2018-5">May</option>
                            <option value="2018-6">June</option>
                            <option value="2018-7">July</option>
                            <option value="2018-8">August</option>
                            <option value="2018-9">September</option>
                            <option value="2018-10">October</option>
                            <option value="2018-11">November</option>
                            <option value="2018-12">December</option>
                        </optgroup>
                    </select>
                </div>
                <input type="hidden" value="{{ csrf_token() }}" id="token">
                <input type="hidden" value="{{ url('/') }}" id="url">
            </form>
            <button id="csv_export" class="action-btn col-2 mt-4 ml-4 float-right btn btn-info disabled" disabled="">
                <i class="fas fa-file-csv"></i> Generate CSV file.
            </button>
            <button id="table_generate" class="action-btn col-2 mt-4 float-right btn btn-dark disabled" disabled="">
                <i class="fas fa-file-csv"></i> Generate HTML Table.
            </button>
        </div>
    </div>
    <div class="card p-5">
        <div id="table_data"></div>
    </div>
@endsection
