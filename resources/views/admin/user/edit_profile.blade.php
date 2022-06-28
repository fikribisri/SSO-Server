@extends('layouts.main')
@section('pageTitle', 'Edit User')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="{{ route('profile') }}">Profile</a>
    </li>
    <li class="breadcrumb-item">Edit Profile</li>
    <li class="breadcrumb-item active">{{$model->username}}</li>
</ol>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-users"></i> Edit Profile</div>
            <div class="card-body">
                @include('layouts.alert')
                <form method="POST" action="{{ route('profile.update', $model->id) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $model->username }}" required autocomplete="name" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $model->email }}" required autocomplete="name" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ $model->full_name }}" required autocomplete="name" autofocus>

                                    @error('full_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $model->phone_number }}" autocomplete="name" autofocus>

                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                <div class="col-md-6">
                                    <input id="date_of_birth" type="text" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ $model->date_of_birth }}" autocomplete="name" autofocus>

                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="upload-area">
                                        <div class="form-group field-pic">
                                            <input type="hidden" name="foto" value=""><input type="file" id="pic" name="foto" maxlength="250" accept="image/*">
                                        </div>
                                        @if (!empty($model->foto))
                                            <div class="upload-image" style="background:url('{{asset('image/profile/'.$model->foto.'')}}') center center / cover no-repeat;"></div>
                                        @else
                                            <div class="upload-image"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-ladda" data-style="expand-left">
                                        <i class="fa fa-save"></i> {{ __('Submit') }}
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
