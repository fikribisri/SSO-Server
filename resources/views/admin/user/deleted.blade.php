@extends('layouts.main')
@section('pageTitle', 'Soft Delete User')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.user') }}">User</a>
    </li>
    <li class="breadcrumb-item active">Soft Delete User</li>
</ol>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-users"></i> List User
                <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-pill btn-success float-right text-white ml-1"><i class="fa fa-plus"></i> Create User</a>
            </div>

            <div class="card-body">
                @include('layouts.alert')
                <div class="table-responsive">
                    <table class="table table-striped table-bordered datatable">
                        <thead>
                          <tr>
                            <th style="width: 10px;text-align: center;"></th>
                            <th style="width: 40px">#</th>
                            <th>Username / Nama Lengkap</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Last Activity</th>
                            <th>Status</th>
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
    <style type="text/css">
    td.details-control {
        background: url('{{ asset('image/details_open.png') }}') no-repeat center center;
        cursor: pointer;
    }
    tr.details td.details-control {
        background: url('{{ asset('image/details_close.png') }}') no-repeat center center;
    }
    </style>
@endsection

@section('js')
    <script src="{{asset('vendor/datatables.net/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script type="text/javascript">
        function format ( d ) {
            var show = '';
            $.ajax({
                async: false,
                type:'POST',
                data:{"_token": "{{ csrf_token() }}","id": d.id},
                url:'{{route("admin.user.getrow")}}',
                dataType: "json",
                success:function(data) {
                    show = data.data.new;
                }
            });

            return show;
        }

        var dt = $('.datatable').DataTable({
            processing:true,
            serverSide:true,
            // responsive: true,
            ajax: '{!! route('admin.user.getdatadeleted') !!}',
            columns: [
                {
                    class:"details-control",
                    orderable:false,
                    data:null,
                    defaultContent: ""
                },
                {
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data:'full_name',name:'full_name'},
                {data:'email',name:'email'},
                {data:'role',name:'role'},
                {data:'last_activity',name:'last_activity'},
                {data:'is_active',name:'is_active'},
                {data:'action',name:'action'},
            ]
        });

        var detailRows = [];

        $('.datatable tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dt.row( tr );
            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {
                tr.removeClass( 'details' );
                row.child.hide();

                // Remove from the 'open' array
                detailRows.splice( idx, 1 );
            }
            else {
                tr.addClass( 'details' );
                row.child( format( row.data() ) ).show();

                // Add to the 'open' array
                if ( idx === -1 ) {
                    detailRows.push( tr.attr('id') );
                }
            }
        } );

        dt.on( 'draw', function () {
            $.each( detailRows, function ( i, id ) {
                $('#'+id+' td.details-control').trigger( 'click' );
            } );
        } );

        $('.datatable').attr('style', 'border-collapse: collapse !important');

        $(document).on('click', '.rollback', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                title: "Are you sure ?",
                text: "Do you want rollback user ? ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "POST",
                        url: "{{url('admin/users/rollback')}}/"+id,
                        data: {"_token": $('meta[name="csrf-token"]').attr('content'),id:id},
                        success: function (data) {
                            if(data.success==true){
                                swal({title: "Success!", text: "User succes to Role Back .", type:
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
