@extends('layouts.main')
@section('pageTitle', 'Create User')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.faq') }}">Faq</a>
    </li>
    <li class="breadcrumb-item active">Create Faq</li>
</ol>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-users"></i> Create Faq</div>
            <div class="card-body">
                @include('layouts.alert')
                <form method="POST" action="{{ route('admin.faq.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group row">
                                <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question') }}" required autocomplete="question" autofocus>

                                    @error('question')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="answers" class="col-md-4 col-form-label text-md-right">{{ __('Answers') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <textarea id="answers" class="form-control @error('answers') is-invalid @enderror" name="answers" rows="10" required>{{ old('redirect') }}</textarea>
                                    @error('answers')
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
                                        <i class="fa fa-save"></i> {{ __('Submit') }}
                                    </button>
                                    <a href="{{ route('admin.faq') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
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
