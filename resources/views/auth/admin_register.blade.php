<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-4.1.3/css/bootstrap.min.css')}}">
</head>
<body>

<div class="container">
   <div class="row" style="margin-top:45px">
      <div class="col-md-4 col-md-offset-4">
           <h4>Admin Register</h4><hr>
           <form action="{{ route('auth.admin_save') }}" method="post">

           @if(Session::get('success'))
             <div class="alert alert-success">
                {{ Session::get('success') }}
             </div>
           @endif

           @if(Session::get('fail'))
             <div class="alert alert-danger">
                {{ Session::get('fail') }}
             </div>
           @endif

           @csrf
            <div class="form-group">
                 <label>Hospital_name</label>
                 <input type="text" class="form-control" name="hospital_name" placeholder="Enter full hospital name" value="{{ old('hospital_name') }}">
                 <span class="text-danger">@error('hospital_name'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                 <label>hospital_code</label>
                 <input type="text" class="form-control" name="hospital_code" placeholder="Enter hospital code" value="{{ old('hospital_code') }}">
                 <span class="text-danger">@error('hospital_code'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                 <label>Email</label>
                 <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{ old('email') }}">
                 <span class="text-danger">@error('email'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                 <label>Password</label>
                 <input type="password" class="form-control" name="password" placeholder="Enter password">
                 <span class="text-danger">@error('password'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                 <label>Hospital Address</label>
                 <input type="text" class="form-control" name="address" placeholder="Enter hospital address" value="{{ old('address') }}">
                 <span class="text-danger">@error('address'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                 <label>Hospital contact no.</label>
                 <input type="text" class="form-control" name="contact_no" placeholder="Enter hospital contact no." value="{{ old('contact_no') }}">
                 <span class="text-danger">@error('contact_no'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                 <label>Is active?</label>
                 <input type="text" class="form-control" name="is_active" placeholder="Enter 0/1" value="{{ old('is_active') }}">
                 <span class="text-danger">@error('is_active'){{ $message }} @enderror</span>
              </div>
              <button type="submit" class="btn btn-block btn-primary">Sign Up</button>
              <br>
              <a href="{{ route('auth.admin_login') }}">I already have an account, sign in</a>
           </form>
      </div>
   </div>
</div>
    
</body>
</html>