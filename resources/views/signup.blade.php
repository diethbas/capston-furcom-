@extends('layouts.main')

@section('content')
    <div class="flex flex-col justify-center items-center font-[sans-serif] bg-gradient-to-tr from-gray-900 via-gray-900 to-purple-900  bg-slate-900 min-h-screen p-4"> 
        <!-- Logo -->
        <a href="{{ route('home')}}">
        <img class="mx-auto w-auto h-7 sm:h-8" src="/img/logo.png" alt="Logo">
        </a>


        <!-- Welcome  -->
        <h1 class="mt-5 mb-10 text-3xl font-semibold capitalize sm:text-3xl text-white text-center sm:text-center md:text-center">
            Welcome to our FurFamily
        </h1>


        <div class="relative grid md:grid-cols-2 items-center gap-y-4 bg-white max-w-4xl w-full shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md overflow-hidden lg:min-h-[80vh] md:min-h-[85vh] h-full">
        @if (!session()->has('isFurbabyForm'))
            <!-- Slide 1: Furparents Form -->
            <input type="checkbox" id="toggle-carousel" class="hidden peer" />
            <div class="max-md:order-1 flex flex-col justify-center sm:p-4 p-2 bg-blue-900 w-full h-full peer-checked:hidden">
                <div class="max-w-xs mt-5 mb-5 space-y-8 mx-auto">
                    <div>
                        <h4 class="text-white text-base font-bold">Create Your Account</h4>
                        <p class="text-[12px] italic text-white mt-1">Welcome to our registration! Get started by creating your account.</p>
                    </div>
                    <div>
                        <h4 class="text-white text-base font-semibold">Add Profile Picture After Login</h4>
                        <p class="text-[12px] italic text-white mt-1">Once you log in, you can easily add a profile picture to complete your account setup.</p>
                    </div>
                </div>
            </div>
    
            <!-- Furparents Form -->
            <form method="POST" action="{{ route('signup.furparent') }}" class="sm:p-4 p-2 w-full peer-checked:hidden" style="overflow-y:auto;">
                @csrf
                <div class="mb-4">
                    <h3 class="text-gray-900 font-serif text-xl  font-extrabold max-md:text-center">Furparents</h3>
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

                <button type="submit" class="cursor-pointer mt-5 text-xs tracking-wide font-semibold rounded-md hover:bg-blue-200 focus:outline-none transition-all flex items-center ml-auto">
                    <svg width="70" height="50" viewBox="0 0 84 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.6364 10.3636V22H21.2727L14.9318 12.8636H14.8182V22H13.4091V10.3636H14.7727L21.1364 19.5227H21.25V10.3636H22.6364ZM28.9332 22.1818C28.0923 22.1818 27.367 21.9962 26.7571 21.625C26.151 21.25 25.6832 20.7273 25.3537 20.0568C25.0279 19.3826 24.8651 18.5985 24.8651 17.7045C24.8651 16.8106 25.0279 16.0227 25.3537 15.3409C25.6832 14.6553 26.1416 14.1212 26.7287 13.7386C27.3196 13.3523 28.009 13.1591 28.7969 13.1591C29.2514 13.1591 29.7003 13.2348 30.1435 13.3864C30.5866 13.5379 30.9901 13.7841 31.3537 14.125C31.7173 14.4621 32.0071 14.9091 32.223 15.4659C32.4389 16.0227 32.5469 16.7083 32.5469 17.5227V18.0909H25.8196V16.9318H31.1832C31.1832 16.4394 31.0848 16 30.8878 15.6136C30.6946 15.2273 30.4181 14.9223 30.0582 14.6989C29.7022 14.4754 29.2817 14.3636 28.7969 14.3636C28.2628 14.3636 27.8007 14.4962 27.4105 14.7614C27.0241 15.0227 26.7268 15.3636 26.5185 15.7841C26.3101 16.2045 26.206 16.6553 26.206 17.1364V17.9091C26.206 18.5682 26.3196 19.1269 26.5469 19.5852C26.7779 20.0398 27.098 20.3864 27.5071 20.625C27.9162 20.8598 28.3916 20.9773 28.9332 20.9773C29.2855 20.9773 29.6037 20.928 29.8878 20.8295C30.1757 20.7273 30.4238 20.5758 30.6321 20.375C30.8404 20.1705 31.0014 19.9167 31.1151 19.6136L32.4105 19.9773C32.2741 20.4167 32.045 20.803 31.723 21.1364C31.401 21.4659 31.0033 21.7235 30.5298 21.9091C30.0563 22.0909 29.5241 22.1818 28.9332 22.1818ZM35.3523 13.2727L37.4432 16.8409L39.5341 13.2727H41.0795L38.2614 17.6364L41.0795 22H39.5341L37.4432 18.6136L35.3523 22H33.8068L36.5795 17.6364L33.8068 13.2727H35.3523ZM46.7884 13.2727V14.4091H42.2656V13.2727H46.7884ZM43.5838 11.1818H44.9247V19.5C44.9247 19.8788 44.9796 20.1629 45.0895 20.3523C45.2031 20.5379 45.3471 20.6629 45.5213 20.7273C45.6993 20.7879 45.8868 20.8182 46.0838 20.8182C46.2315 20.8182 46.3527 20.8106 46.4474 20.7955C46.5421 20.7765 46.6179 20.7614 46.6747 20.75L46.9474 21.9545C46.8565 21.9886 46.7296 22.0227 46.5668 22.0568C46.4039 22.0947 46.1974 22.1136 45.9474 22.1136C45.5687 22.1136 45.1974 22.0322 44.8338 21.8693C44.474 21.7064 44.1747 21.4583 43.9361 21.125C43.7012 20.7917 43.5838 20.3712 43.5838 19.8636V11.1818Z" fill="#007AFF"/>
                        <path d="M59.3335 15.9997H68.6668M68.6668 15.9997L64.0002 11.333M68.6668 15.9997L64.0002 20.6663" stroke="#007AFF" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>                              
            </form>
        @endif

        @if (session()->has('isFurbabyForm'))
            <!-- Slide 2: Furbabies Form -->

            <div class="max-md:order-1 mt-5 mb-5 flex flex-col justify-center sm:p-4 p-2 bg-blue-900 w-full h-full peer-checked:hidden">
                <div class="max-w-xs space-y-4 mx-auto">
                    <div>
                        <h4 class="text-white text-base font-bold">Register your Furbaby</h4>
                        <p class="text-[12px] italic text-white mt-1">Provide the details of your furbaby to complete the registration process.</p>
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
                    <h3 class="pb-4 text-gray-900 text-xl font-extrabold max-md:text-center pt-2">Furbaby</h3>

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

                    <div class="pt-3 mb-2">
                        <label class="text-gray-800 text-xs mb-1 block">General Description</label>
                        <textarea name="description" class="bg-gray-100 w-full text-gray-800 text-xs px-3 py-2 rounded-md outline-blue-500 @error('description') border-red-500 @enderror" placeholder="Describe your furbaby">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-center mb-2">
                    <input id="remember-me" name="remember_me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required />
                    <label for="remember-me" class="text-gray-800 ml-2 block text-sm">
                        I accept the <a href="javascript:void(0);" class="text-blue-600 font-semibold hover:underline ml-1">Terms and Conditions</a>
                    </label>
                </div>

                <div class="mt-3 flex justify-between">
                    <!-- Return Arrow Button -->
                    <a href="{{ route('signup.back') }}" class="cursor-pointer py-2 px-4 text-xl font-semibold rounded-md text-blue-600 bg-transparent hover:text-blue-700 transition-all flex items-center">
                        <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24 16L16 24M16 24L24 32M16 24H32M44 24C44 35.0457 35.0457 44 24 44C12.9543 44 4 35.0457 4 24C4 12.9543 12.9543 4 24 4C35.0457 4 44 12.9543 44 24Z" stroke="#007AFF" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    

                    <!-- Submit Button -->
                    <button type="submit" class="cursor-pointer py-2 px-4 text-xs tracking-wide font-semibold rounded-md text-white hover:bg-blue-200 focus:outline-none transition-all flex items-center">
                        <svg width="24" height="24" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg" class="">
                            <path d="M34 42V26H14V42M14 6V16H30M38 42H10C8.93913 42 7.92172 41.5786 7.17157 40.8284C6.42143 40.0783 6 39.0609 6 38V10C6 8.93913 6.42143 7.92172 7.17157 7.17157C7.92172 6.42143 8.93913 6 10 6H32L42 16V38C42 39.0609 41.5786 40.0783 40.8284 40.8284C40.0783 41.5786 39.0609 42 38 42Z" stroke="#007AFF" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span></span>
                    </button>
                </div>
            </form>
        @endif
        </div>
    </div>        

@endsection
