@extends('layouts.main')
@section('pageTitle', 'Application')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item active">
        <a href="{{ route('admin.app') }}">App</a>
    </li>
</ol>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-cog"></i> Application</a>
            </div>

            <div class="card-body">
                @include('layouts.alert')
                <form method="POST" action="{{ route('admin.app.update',1) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $model->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" required>{{ $model->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="company_name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ $model->company_name }}" required autocomplete="name" autofocus>

                                    @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('URL Company') }}</label>

                                <div class="col-md-6">
                                    <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ $model->url }}" autocomplete="name" autofocus>

                                    @error('url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Logo') }}</label>

                                <div class="col-md-4">
                                    <input type="file" name="logo"/>

                                    @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @if (!empty($model->logo))
                                    <div class="col-md-2">
                                        <a class="btn btn-primary btn-sm btn-block" target="_blank" href="{{asset('image/app/'.$model->logo.'')}}"><i class="fa fa-link"></i> show</a>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="logo_small" class="col-md-4 col-form-label text-md-right">{{ __('Logo Small') }}</label>

                                <div class="col-md-4">
                                    <input type="file" name="logo_small"/>

                                    @error('logo_small')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @if (!empty($model->logo_small))
                                    <div class="col-md-2">
                                        <a class="btn btn-primary btn-sm btn-block" target="_blank" href="{{asset('image/app/'.$model->logo_small.'')}}"><i class="fa fa-link"></i> show</a>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="background_login" class="col-md-4 col-form-label text-md-right">{{ __('Background Login') }}</label>

                                <div class="col-md-4">
                                    <input type="file" name="background_login"/>

                                    @error('background_login')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                @if (!empty($model->background_login))
                                    <div class="col-md-2">
                                        <a class="btn btn-primary btn-sm btn-block" target="_blank" href="{{asset('image/app/'.$model->background_login.'')}}"><i class="fa fa-link"></i> show</a>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="smtp_driver" class="col-md-4 col-form-label text-md-right">{{ __('SMTP Driver') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="smtp_driver" type="text" class="form-control @error('smtp_driver') is-invalid @enderror" name="smtp_driver" value="{{ $model->smtp_driver }}" autocomplete="name" autofocus>

                                    @error('smtp_driver')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="smtp_host" class="col-md-4 col-form-label text-md-right">{{ __('SMTP Host') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="smtp_host" type="text" class="form-control @error('smtp_host') is-invalid @enderror" name="smtp_host" value="{{ $model->smtp_host }}" autocomplete="name" autofocus>

                                    @error('smtp_host')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="smtp_port" class="col-md-4 col-form-label text-md-right">{{ __('SMTP Port') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="smtp_port" type="number" class="form-control @error('smtp_port') is-invalid @enderror" name="smtp_port" value="{{ $model->smtp_port }}" autocomplete="name" autofocus>

                                    @error('smtp_port')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="smtp_encryption" class="col-md-4 col-form-label text-md-right">{{ __('SMTP Encryption') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="smtp_encryption" type="text" class="form-control @error('smtp_encryption') is-invalid @enderror" name="smtp_encryption" value="{{ $model->smtp_encryption }}" autocomplete="name" autofocus>

                                    @error('smtp_encryption')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="smtp_username" class="col-md-4 col-form-label text-md-right">{{ __('SMTP Username') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="smtp_username" type="text" class="form-control @error('smtp_username') is-invalid @enderror" name="smtp_username" value="{{ $model->smtp_username }}" autocomplete="name" autofocus>

                                    @error('smtp_username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="smtp_password" class="col-md-4 col-form-label text-md-right">{{ __('SMTP Password') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="smtp_password" type="password" class="form-control @error('smtp_password') is-invalid @enderror" name="smtp_password" value="{{ $model->smtp_password }}" autocomplete="name" autofocus>

                                    @error('smtp_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="from_email" class="col-md-4 col-form-label text-md-right">{{ __('From Email') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="from_email" type="email" class="form-control @error('from_email') is-invalid @enderror" name="from_email" value="{{ $model->from_email }}" autocomplete="name" autofocus>

                                    @error('from_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="from_name" class="col-md-4 col-form-label text-md-right">{{ __('From Name') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="from_name" type="text" class="form-control @error('from_name') is-invalid @enderror" name="from_name" value="{{ $model->from_name }}" autocomplete="name" autofocus>

                                    @error('from_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-ladda" data-style="expand-left">
                                        <i class="fa fa-save"></i> {{ __('Submit') }}
                                    </button>
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

@endsection

@section('js')

@endsection
