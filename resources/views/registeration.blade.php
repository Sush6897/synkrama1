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
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form id="registrationForm"  method = "POST" action="{{url('regsiter')}}">
                            @csrf

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control" value="{{old('first_name')}}" name="first_name" required autofocus>
                                    <span id="first_name_error" class="text-danger"></span>

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                             
                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" value="{{old('last_name')}}" name="last_name" required>
                                    <span id="last_name_error" class="text-danger"></span>
                                </div>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{old('email')}}" required>
                                    <span id="email_error" class="text-danger"></span>
                                </div>
                                @error('error')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                    <span id="password_error" class="text-danger"></span>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="user_type" class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>

                                <div class="col-md-6">
                                    <select id="user_type" class="form-control" name="user_type" required>
                                        <option value="Employee" @if(old("user_type")=='Employee') selected @endif>Employee</option>
                                        <option value="Dealer"  @if(old("user_type")=='Dealer') selected @endif>Dealer</option>
                                    </select>
                                    <span id="user_type_error" class="text-danger"></span>

                                    @error('user_type')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                               
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Include jQuery Validation Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Custom validation method to check for full email address
            $.validator.addMethod('fullEmail', function(value, element) {
                return this.optional(element) || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
            }, 'Please enter a valid email address');

            $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z\s]*$/.test(value);
            }, "Please enter only letters");

            $.validator.addMethod("strongPassword", function(value, element) {
                return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
            }, "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character");

          
            $("#registrationForm").validate({
                rules: {
                    first_name: {
                        required: true,
                        lettersonly: true,
                    },
                    last_name: {
                        required: true,
                        lettersonly: true,
                    },
                    email: {
                        required: true,
                        fullEmail: true,
                        remote: {
                        url: "{{ route('check-email') }}",
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            email: function() {
                                return $("#email").val();
                            }
                        },
                        dataType: "json", // Ensure expected response type
                        dataFilter: function(data) {
                            // Parse the JSON response
                            var json = JSON.parse(data);
                            if (json.exists) {
                                // Return false if email exists
                                return false;
                            } else {
                                return true;
                            }
                        }
                    }
                    },
                    password: {
                        required: true,
                        minlength: 8, // Ensure minimum length
                        strongPassword: true,
                    },
                    user_type: 'required'
                },
                messages: {
                    first_name: {
                        required: 'Please enter your first name',
                        lettersonly: 'Please enter only letters'
                    },
                    last_name: {
                        required: 'Please enter your last name',
                        lettersonly: 'Please enter only letters'
                    },
                    email: {
                        required: 'Please enter your email',
                        fullEmail: 'Please enter a valid email address',
                        remote: 'This email is already taken. Please choose another.'
                    },
                    password: {
                        required: 'Please enter a password',
                        minlength: 'Password must be at least 8 characters long',
                        strongPassword: 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character'
                    },
                    user_type: 'Please select user type'
                },
                errorElement: 'span', // Use 'span' for error messages
                errorClass: 'text-danger', // Class for error messages
                errorPlacement: function(error, element) {
                    // Place error message after the input element
                    error.insertAfter(element);
                },
                success: function(label) {
                    // Handle success message if needed
                },
                highlight: function(element, errorClass, validClass) {
                    // Add error class to the parent div for Bootstrap styling
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function(element, errorClass, validClass) {
                    // Remove error class from the parent div
                    $(element).closest('.form-group').removeClass('has-error');
                }
            });
        });
        
    </script>
@endsection
