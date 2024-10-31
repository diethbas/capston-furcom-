<!-- Sidebar -->
<aside class="sticky px-1 top-0 flex flex-col items-center h-screen  border-r  bg-gray-900 border-white">
    <nav class="flex flex-col flex-1 space-y-6 pt-4">
        @php
            $url = url('profile');
            if (Request::segment(1) == 'profile') {
                $url = url('community');
            }
        @endphp
        <a href="{{$url}}" class="p-2.5 focus:outline-none transition-colors duration-200 rounded-lg text-gray-200 hover:bg-gray-800 flex justify-center">
            <svg width="30" height="27" viewBox="0 0 39 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g filter="url(#filter0_d_1712_23)">
                    <path d="M25.6667 26.125H31.8333C32.6848 26.125 33.375 25.5094 33.375 24.75V23.375C33.375 21.0968 31.3043 19.25 28.75 19.25H25.6667M22.2193 13.75C23.0662 14.5939 24.2969 15.125 25.6667 15.125C28.221 15.125 30.2917 13.2782 30.2917 11C30.2917 8.72183 28.221 6.875 25.6667 6.875C24.2969 6.875 23.0662 7.40609 22.2193 8.25M5.625 24.75V23.375C5.625 21.0968 7.69568 19.25 10.25 19.25H16.4167C18.971 19.25 21.0417 21.0968 21.0417 23.375V24.75C21.0417 25.5094 20.3514 26.125 19.5 26.125H7.16667C6.31523 26.125 5.625 25.5094 5.625 24.75ZM17.9583 11C17.9583 13.2782 15.8877 15.125 13.3333 15.125C10.779 15.125 8.70833 13.2782 8.70833 11C8.70833 8.72183 10.779 6.875 13.3333 6.875C15.8877 6.875 17.9583 8.72183 17.9583 11Z" stroke="white" stroke-width="2" stroke-linecap="round"/>
                </g>
                <defs>
                    <filter id="filter0_d_1712_23" x="-3" y="0" width="45" height="41" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                        <feOffset dy="4"/>
                        <feGaussianBlur stdDeviation="2"/>
                        <feComposite in2="hardAlpha" operator="out"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1712_23"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1712_23" result="shape"/>
                    </filter>
                </defs>
            </svg>
        </a>
    </nav>
    
</aside>