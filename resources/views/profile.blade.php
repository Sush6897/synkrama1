@extends('welcome')

@section('content')
    <div class="container">
    <div>
            @if(Session::has("success"))
                <div id="successMessage"  class="alert alert-success">
                    <span>{{Session::get('success')}}</span>
                </div>
            @endif
            @if(Session::has('mess'))
                <div id="errorMessage"  class="alert alert-danger">
                    <span>{{Session::get('mess')}}</span>
                </div>
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update City, State, and Zip Code</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('dealer.update_city_state_zip') }}">
                            @csrf
                            <input  type="hidden" class="form-control " name="id" @if(empty($user)) value="{{ old('city') }}" @else value="{{ $user->id }}" @endif required autofocus>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
    
                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" @if(empty($user)) value="{{ old('city') }}" @else value="{{ $user->city }}" @endif required autofocus>
    
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
    
                                <div class="col-md-6">
                                    <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" @if(empty($user)) value="{{ old('state') }}" @else value="{{ $user->state }}" @endif required>
    
                                    @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="zip" class="col-md-4 col-form-label text-md-right">{{ __('ZIP Code') }}</label>
    
                                <div class="col-md-6">
                                    <input id="zip" type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" @if (empty($user)) value="{{ old('zip') }}" @else value="{{ $user->zip_code }}" @endif required>
    
                                    @error('zip')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    @endsection