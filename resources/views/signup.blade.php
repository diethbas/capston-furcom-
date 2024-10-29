@extends('layouts.main')

@section('content')
    <div class="flex flex-col justify-center items-center font-[sans-serif] bg-slate-900 lg:h-screen p-4">
        <div class="relative grid md:grid-cols-2 items-center gap-y-4 bg-white max-w-4xl w-full shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md overflow-hidden" style="height: 100%;">
        @if (!session()->has('isFurbabyForm'))
            <!-- Slide 1: Furparents Form -->
            <input type="checkbox" id="toggle-carousel" class="hidden peer" />
            <div class="max-md:order-1 flex flex-col justify-center sm:p-4 p-2 bg-gradient-to-r from-blue-600 to-blue-700 w-full h-full peer-checked:hidden">
                <div class="max-w-xs space-y-4 mx-auto">
                    <div>
                        <h4 class="text-white text-base font-semibold">Create Your Account</h4>
                        <p class="text-[12px] text-white mt-1">Welcome to our registration! Get started by creating your account.</p>
                    </div>
                    <div>
                        <h4 class="text-white text-base font-semibold">Simple & Secure Registration</h4>
                        <p class="text-[12px] text-white mt-1">Our registration process is designed to be straightforward and secure.</p>
                    </div>
                    <div>
                        <h4 class="text-white text-base font-semibold">Terms and Conditions Agreement</h4>
                        <p class="text-[12px] text-white mt-1">Require users to accept the terms and conditions during registration.</p>
                    </div>
                </div>
            </div>
    
            <!-- Furparents Form -->
            <form method="POST" action="{{ route('signup.furparent') }}" class="sm:p-4 p-2 w-full peer-checked:hidden" style="overflow-y:auto;">
                @csrf
                <div class="mb-4">
                    <h3 class="text-blue-500 text-xl font-extrabold max-md:text-center">Furparents</h3>
                </div>
    
                <div class="grid lg:grid-cols-2 gap-2">
                    <div>
                        <label class="text-gray-800 text-xs mb-1 block">First Name</label>
                        <input name="firstname" type="text" class="bg-gray-100 w-full text-gray-800 text-xs px-3 py-2 rounded-md outline-blue-500 @error('firstname') border-red-500 @enderror" placeholder="Enter first name" value="{{ session('furparent.firstname') }}" required />
                        @error('firstname')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800 text-xs mb-1 block">Last Name</label>
                        <input name="lastname" type="text" class="bg-gray-100 w-full text-gray-800 text-xs px-3 py-2 rounded-md outline-blue-500 @error('lastname') border-red-500 @enderror" placeholder="Enter last name" value="{{ session('furparent.lastname') }}" required />
                        @error('lastname')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800 text-xs mb-1 block">Email</label>
                        <input name="email" type="email" class="bg-gray-100 w-full text-gray-800 text-xs px-3 py-2 rounded-md outline-blue-500 @error('email') border-red-500 @enderror" placeholder="Enter email" value="{{ session('furparent.email') }}" required />
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800 text-xs mb-1 block">Mobile No.</label>
                        <input name="mobile_number" type="tel" class="bg-gray-100 w-full text-gray-800 text-xs px-3 py-2 rounded-md outline-blue-500 @error('mobile_number') border-red-500 @enderror" placeholder="Enter mobile number" value="{{ session('furparent.mobile_number') }}" required />
                        @error('mobile_number')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800 text-xs mb-1 block">Address (City)</label>
                        <input name="city" type="text" class="bg-gray-100 w-full text-gray-800 text-xs px-3 py-2 rounded-md outline-blue-500 @error('city') border-red-500 @enderror" placeholder="Enter city" value="{{ session('furparent.city') }}" required />
                        @error('city')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800 text-xs mb-1 block">Address (Province)</label>
                        <input name="province" type="text" class="bg-gray-100 w-full text-gray-800 text-xs px-3 py-2 rounded-md outline-blue-500 @error('province') border-red-500 @enderror" placeholder="Enter province" value="{{ session('furparent.province') }}" required />
                        @error('province')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800 text-xs mb-1 block">Password</label>
                        <input name="password" type="password" class="bg-gray-100 w-full text-gray-800 text-xs px-3 py-2 rounded-md outline-blue-500 @error('password') border-red-500 @enderror" placeholder="Enter password" value="{{ session('furparent.password') }}" required />
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800 text-xs mb-1 block">Confirm Password</label>
                        <input name="password_confirmation" type="password" class="bg-gray-100 w-full text-gray-800 text-xs px-3 py-2 rounded-md outline-blue-500" placeholder="Confirm password" value="{{ session('furparent.password') }}" required />
                    </div>
                </div>

                <button type="submit" class="cursor-pointer mt-2 py-2 px-4 text-xs tracking-wide font-semibold rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none transition-all">
                    Next
                </button>                
            </form>
        @endif

        @if (session()->has('isFurbabyForm'))
            <!-- Slide 2: Furbabies Form -->

            <div class="peer-checked:flex max-md:order-1 flex-col justify-center sm:p-4 p-2 bg-gradient-to-r from-blue-600 to-blue-700 w-full h-full">
                <div class="max-w-xs space-y-4 mx-auto">
                    <div>
                        <h4 class="text-white text-base font-semibold">Register Your Furbaby</h4>
                        <p class="text-[12px] text-white mt-1">Please provide the details of your furbaby to complete the registration process.</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('signup.store') }}" class="peer-checked:block sm:p-4 p-2 w-full" style="overflow-y: auto; max-height: 100%;" id="furbaby-form">
                @csrf

                <!-- Hidden Fields for Furparent Data (retrieved from session) -->
                <input type="hidden" name="firstname" value="{{ session('furparent.firstname') }}">
                <input type="hidden" name="lastname" value="{{ session('furparent.lastname') }}">
                <input type="hidden" name="email" value="{{ session('furparent.email') }}">
                <input type="hidden" name="mobile_number" value="{{ session('furparent.mobile_number') }}">
                <input type="hidden" name="city" value="{{ session('furparent.city') }}">
                <input type="hidden" name="province" value="{{ session('furparent.province') }}">
                <input type="hidden" name="password" value="{{ session('furparent.password') }}">
                <input type="hidden" name="password_confirmation" value="{{ session('furparent.password_confirmation') }}">

                <!-- Furbaby Form Fields -->
                <div class="mb-6">
                    <h3 class="pb-4 text-blue-500 text-xl font-extrabold max-md:text-center pt-2">Furbaby</h3>

                    <div class="grid lg:grid-cols-2 gap-2">
                        <div>
                            <label class="text-gray-800 text-xs mb-1 block">Name of Furbaby</label>
                            <input name="name" type="text" class="bg-gray-100 w-full text-gray-800 text-xs px-3 py-2 rounded-md outline-blue-500 @error('name') border-red-500 @enderror" placeholder="Enter furbaby name" value="{{ old('name') }}" required />
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-800 text-xs mb-1 block">Age</label>
                            <input name="age" type="number" class="bg-gray-100 w-full text-gray-800 text-xs px-3 py-2 rounded-md outline-blue-500 @error('age') border-red-500 @enderror" placeholder="Enter age" value="{{ old('age') }}" required />
                            @error('age')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-3 mb-3">
                        <label class="text-gray-800 text-xs mb-1 block">General Description</label>
                        <textarea name="description" class="bg-gray-100 w-full text-gray-800 text-xs px-3 py-2 rounded-md outline-blue-500 @error('description') border-red-500 @enderror" placeholder="Describe your furbaby">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-center mb-3">
                    <input id="remember-me" name="remember_me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required />
                    <label for="remember-me" class="text-gray-800 ml-3 block text-sm">
                        I accept the <a href="javascript:void(0);" class="text-blue-600 font-semibold hover:underline ml-1">Terms and Conditions</a>
                    </label>
                </div>

                <div class="mt-3 flex justify-between">
                    <!-- Return Arrow Button -->

                    <a href="{{ route('signup.back') }}" class="cursor-pointer py-2 px-4 text-xl font-semibold rounded-md text-blue-600 bg-transparent hover:text-blue-700 transition-all">
                        ←
                    </a>

                    <!-- Submit Button -->
                    <button type="submit" class="cursor-pointer py-2 px-4 text-xs tracking-wide font-semibold rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none transition-all">
                        Submit
                    </button>
                </div>
            </form>
        @endif
        </div>
    </div>        

@endsection
