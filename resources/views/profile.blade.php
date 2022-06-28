@extends('layouts.main')
@section('pageTitle', 'Profile')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Profile</li>
    <li class="breadcrumb-item active">{{ $model->full_name }}</li>
</ol>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-user"></i> Profile</a>
            </div>

            <div class="card-body">
                @include('layouts.alert')
                <form method="POST" action="{{ route('admin.app.update',1) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <p>
                        <a class="btn btn-sm btn-primary text-white" href="{{ route('update-profile') }}"><i class="fa fa-edit"></i> Edit Profile</a>
                        <a class="btn btn-sm btn-warning text-white" href="{{ route('update-password') }}"><i class="fa fa-key"></i> Edit Password</a>
                    </p>
                    <table class="table table-hover">
                        <tr>
                            <th>Username</th>
                            <td>{{$model->username}}</td>
                        </tr>
                        <tr>
                            <th>Full Name</th>
                            <td>{{$model->full_name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$model->email}}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{$model->phone_number}}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>{{$model->date_of_birth}}</td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>
                                @if (!empty($model->foto))
                                    <img class="img-avatar" src="{{asset('image/profile/'.$model->foto.'')}}" width="100px" height="100px">
                                @endif
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')

@endsection

@section('js')

@endsection
