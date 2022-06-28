@extends('layouts.main')
@section('pageTitle', 'User Online')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.user') }}">User</a>
    </li>
    <li class="breadcrumb-item active">Online</li>
</ol>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-signal"></i> User Online</div>
            <div class="card-body">
                @include('layouts.alert')
                <table class="table table-striped table-bordered datatable">
                    <thead class="bg-dark">
                      <tr>
                        <th style="width: 40px">#</th>
                        <th>Username / Nama Lengkap</th>
                        <th>IP Address</th>
                        <th>Browser</th>
                        <th>Last Activity</th>
                        <th width="80px">Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <link href="{{asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <style type="text/css">

    </style>
@endsection

@section('js')
    <script src="{{asset('vendor/datatables.net/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script type="text/javascript">

        var dt = $('.datatable').DataTable({
            processing:true,
            serverSide:true,
            // responsive: true,
            ajax: '{!! route('admin.user.getdata-online') !!}',
            columns: [
                {
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data:'user_id',name:'user_id'},
                {data:'ip_address',name:'ip_address'},
                {data:'user_agent',name:'user_agent'},
                {data:'last_activity',name:'last_activity'},
                {data:'action',name:'action'},
            ]
        });

        $('.datatable').attr('style', 'border-collapse: collapse !important');

        $(document).on('click', '.kick-user', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                title: "Are you sure ?",
                text: "Do you want kick user ? ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "POST",
                        url: "{{url('admin/users/kick')}}/"+id,
                        data: {"_token": $('meta[name="csrf-token"]').attr('content'),id:id},
                        success: function (data) {
                            if(data.success==true){
                                swal({title: "Success!", text: "User Berhasil di remove.", type:
                                    "success",icon: "success"}).then(function(){
                                        location.reload();
                                    }
                                );

                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
