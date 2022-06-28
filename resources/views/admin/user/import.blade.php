@extends('layouts.main')
@section('pageTitle', 'Import User')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.user') }}">User</a>
    </li>
    <li class="breadcrumb-item active">Import User</li>
</ol>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-users"></i> Import User</div>
            <div class="card-body">
                @include('layouts.alert')
                <p>

                </p>
                <form method="POST" action="{{ route('admin.user.upload') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="username" class="col-md-2 col-form-label text-md-right">{{ __('File') }} </label>

                        <div class="col-md-4">
                            <input id="file" type="file" class="form-control" name="file" required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-ladda" data-style="expand-left">
                                <i class="fa fa-upload"></i> {{ __('Submit') }}
                            </button>
                            <a class="btn btn-danger text-white" href="{{asset('data/IMPORTUSER.xlsx')}}" target="_blank"><i class="fa fa-download"></i> Download Format</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style type="text/css">

</style>
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection
