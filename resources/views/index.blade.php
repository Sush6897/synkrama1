@extends('welcome')

@section('content')
<div class="container mt-5">
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
                <div class="card-header">List of Dealers</div>

                <div class="card-body">
                    <div class="mb-3">
                        <form action="{{ route('dealers.index') }}" method="GET">
                            @csrf
                            <div class="form-row align-items-center">
                                <div class="col-sm-6">
                                    <label for="zip" class="sr-only">ZIP Code</label>
                                    <input type="text" class="form-control mb-2" id="zip" name="zip" required  value="{{request()->zip}}" placeholder="Enter ZIP Code">
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-secondary mb-2">Search</button>
                                    <a href='{{route("dealers.index")}}' class="btn btn-secondary mb-2">back</a>

                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>State</th>
                                <th>ZIP Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dealers as $dealer)
                                <tr>
                                    <td>  <a href='{{route("dealer.city_state_zip",["id"=>$dealer->id])}}' class="btn btn-warning mb-2">Edit</a>
                                </td>
                                    <td>{{ $dealer->first_name .' ' .$dealer->last_name }}</td>
                                    <td>{{ $dealer->city }}</td>
                                    <td>{{ $dealer->state }}</td>
                                    <td>{{ $dealer->zip_code }}</td>
                                </tr>
                            @endforeach
                            
                            



                        </tbody>
                        
                    </table>
                    <div>
                            {{ $dealers->links() }}
                                
                            </div>
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
