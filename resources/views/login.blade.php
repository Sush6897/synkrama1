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
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form id="Login"  method = "POST" action="{{url('login')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{old('email')}}" required>
                                    <span id="email_error" class="text-danger"></span>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                               
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                    <span id="password_error" class="text-danger"></span>
                                    <br>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <br>
                
                            </div>

                         

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- jQuery Validation Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <!-- jQuery Validation for Registration Form -->
    <script>
        $(document).ready(function() {
             // Custom validation method to check for full email address
        $.validator.addMethod('fullEmail', function(value, element) {
            return this.optional(element) || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        }, 'Please enter a valid email address');

        $.validator.addMethod("strongPassword", function(value, element) {
            return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
        }, "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character");


            $('#Login').validate({
                rules: {
                  
                    email: {
                        required: true,
                        fullEmail: true 
                    },
                    password: {
                        required: true,
                        strongPassword: true // Use custom strong password validation method

                    },
                   
                },
                messages: {
                   
                    email: {
                        required: 'Please enter your email',
                        fullEmail: 'Please enter a valid email address'
                    },
                    password: {
                        required: 'Please enter a password',
                        strongPassword: 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character'
                    },
                    
                },
                errorPlacement: function(error, element) {
                    error.appendTo('#' + element.attr('id') + '_error');
                }
            });

           
        });
    </script>
@endsection