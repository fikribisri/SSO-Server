@extends('layouts.main')
@section('pageTitle', 'Edit User')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="{{ route('profile') }}">Profile</a>
    </li>
    <li class="breadcrumb-item active">Edit Password</li>
</ol>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-key"></i> Edit Password</div>
            <div class="card-body">
                @include('layouts.alert')
                <form method="POST" action="{{ route('store.password') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-9">

                            <div class="form-group row">
                                <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="name" autofocus>

                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="name" autofocus>

                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_confirm_password" class="col-md-4 col-form-label text-md-right">{{ __('New Confirm Password') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="new_confirm_password" type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" required autocomplete="name" autofocus>

                                    @error('new_confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-ladda" data-style="expand-left">
                                        <i class="fa fa-save"></i> {{ __('Update Password') }}
                                    </button>
                                    <a href="{{ route('profile') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link href="{{asset('vendor/bootstrap-daterangepicker/css/daterangepicker.min.css')}}" rel="stylesheet">
<style type="text/css">
.upload-area input[type="file"]{
  display: none;
}
.upload-area .upload-image {
    width: 146px;
    height: 146px;
    border-radius: 100%;
    border: 1px solid #fff;
    background: #636363 url({{ asset('image/upload-icon.png') }}) center center no-repeat;
    margin: 10px auto;
    cursor: pointer;
}
.form-project .upload-area input[type="file"]{ display: none; }

.form-project h3{ margin-top: 40px; }
.form-project .upload-area .button{
  background: #a1a1a1;
  font-weight: normal;
  line-height: 36px;
  height: 36px;
  text-decoration: none!important;
}

</style>
@endsection

@section('js')
<script src="{{asset('vendor//moment/min/moment.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript">
    $('.upload-image').click(function (event) {
        $('#pic').click();
    });

    $("#pic").change(function (){
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.upload-image').css({
                    'background': 'url(' + e.target.result + ')',
                    'background-size': 'cover',
                    'background-position': 'center center',
                    'background-repeat': 'no-repeat',
                });
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('input[name="date_of_birth"]').daterangepicker({
        opens: 'right',
        drops: 'up',
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'YYYY-MM-DD',
            firstDay: 1
        }
    });
</script>
@endsection
