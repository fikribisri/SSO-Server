@extends('layouts.main')
@section('pageTitle', 'List Credential')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.faq') }}">Faq</a>
    </li>
    <li class="breadcrumb-item active">List Faq</li>
</ol>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-info"></i> List Faq <a href="{{ route('admin.faq.create') }}" class="btn btn-sm btn-pill btn-success float-right text-white"><i class="fa fa-plus"></i> Create Faq</a>
            </div>

            <div class="card-body">
                @include('layouts.alert')
                <div class="table-responsive">
                    <table class="table table-striped table-bordered datatable">
                        <thead>
                          <tr>
                            <th style="width: 40px">#</th>
                            <th>Question</th>
                            <th>Answers</th>
                            <th width="80px">Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
    <link href="{{asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{asset('vendor/datatables.net/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script type="text/javascript">

        var dt = $('.datatable').DataTable({
            processing:true,
            serverSide:true,
            // responsive: true,
            ajax: '{!! route('admin.faq.getdata') !!}',
            columns: [
                {
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data:'question',name:'question'},
                {data:'answers',name:'answers'},
                {data:'action',name:'action'},
            ]
        });

        $('.datatable').attr('style', 'border-collapse: collapse !important');


    </script>
@endsection
