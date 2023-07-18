@extends('guest.layouts.base')

@section('contents')

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name"  required autofocus autocomplete="username" value="{{old('name')}}">
        </div> 
   
   
   
   
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required autofocus autocomplete="username" value="{{old('email ')}}">
        </div>


        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
        </div>


        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password_confirmation" required autocomplete="new-password">
        </div>


        <a href="{{ route('login') }}">
            {{-- {{ __('Already registered?') }} --}}
            Already registered?
        </a> 


        <button type="submit" class="btn btn-primary">Registered</button>
    </form>
    
@endsection