@extends('layouts.guest')
@section('content')
    <div class="flex justify-center items-center min-h-screen p-4"
        style="background: radial-gradient(135.69% 188.95% at 53.72% 47.02%, #0085FF 0%, #003465 64.5%) /* warning: gradient uses a rotation that is not supported by CSS and may not behave as expected */;
">
        <div class="absolute bottom-0 start-80">
            <img src="{{ asset('img/img-auth/3.png') }}" alt="Login Image" class="w-64 md:w-95 animate-pulse">
        </div>
        <div class="absolute top-28 start-0">
            <img src="{{ asset('img/img-auth/2.png') }}" alt="Login Image" class="w-56 md:w-95 animate-pulse hidden md:block">
        </div>
        <div class="absolute top-0 start-80">
            <img src="{{ asset('img/img-auth/6.png') }}" alt="Login Image"
                class="w-60 md:w-95 animate-pulse hidden md:block">
        </div>
        <div class="absolute top-0 end-20">
            <img src="{{ asset('img/img-auth/4.png') }}" alt="Login Image" class="w-60 md:w-95 animate-pulse ">
        </div>
        <div class="absolute bottom-36 end-72">
            <img src="{{ asset('img/img-auth/5.png') }}" alt="Login Image"
                class="w-60 md:w-95 animate-pulse hidden md:block">
        </div>
        <div class="absolute bottom-0 end-20">
            <img src="{{ asset('img/img-auth/1.png') }}" alt="Login Image"
                class="w-60 md:w-95 animate-pulse hidden md:block">
        </div>
        <div class="px-14 py-10 pb-5 rounded-md  w-full md:w-1/3 flex flex-col items-center z-20"
            style="background: linear-gradient(148.46deg, rgba(255, 255, 255, 0.3) -47.18%, rgba(255, 255, 255, 0.11) 131%);
">
            <div class="w-full">
                <center>
                    <img src="{{ asset('img/logo&text.svg') }}" alt="logo text" class="w-40 mb-12">
                </center>
                <h1 class="font-bold text-white text-3xl mb-3 text-center mb-4">Sign In</h1>
                <!-- Form -->
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-white text-xs mb-1">Email</label>
                        <input type="email" id="email" name="email"
                            class="outline-none w-full py-2 text-xs px-3 rounded text-slate-800" value="{{ old('email') }}"
                            autofocus placeholder="example@gmail.com">
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="text-white text-xs mt-104">
                        {{ __('Send Password Reset Link') }}
                    </button>

                    <!-- Back to Login -->
                    <p class="text-white text-xs mt-5">
                       Back to <a href="{{ route('login') }}" class="font-bold text-white">Login
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
