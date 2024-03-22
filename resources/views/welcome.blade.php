<x-layout>
    
    <x-slot:meta>
        {{-- Primary Meta Tags --}}
        <meta name="title" content="Verbs: Event sourcing for PHP artisans">
        
        {{-- Open Graph / Facebook --}}
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:title" content="Verbs: Event sourcing for PHP artisans">
        <meta property="og:image" content="{{ asset('og-logo.png') }}">
        
        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url('/') }}">
        <meta property="twitter:title" content="Verbs: Event sourcing for PHP artisans">
        <meta property="twitter:image" content="{{ asset('og-logo.png') }}">
    </x-slot:meta>

    <x-navigation.logo class="h-24 w-auto mb-5 mx-auto lg:hidden" />
    
    <!-- <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                          clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-yellow-700">
                    Please note that Verbs is <strong>still in alpha</strong> and should not be used in production until the 1.0 release.
                </p>
            </div>
        </div>
    </div> -->
    
    <h1 class="text-2xl font-semibold text-stone-500 mb-6 hidden lg:block">
        Verbs
    </h1>

    <p class="text-center lg:text-left">
        Verbs is a Laravel package that allows you to derive the state of your application from the events that have occurred.
        It's a simple, but extremely powerful, way to design your applications.
    </p>

    <h2 class="text-2xl font-semibold text-stone-500 mb-6 hidden lg:block mt-6">
        Verbs is great for...
    </h2>

    <ul class="list-disc list-inside">
        <li>Applications that need to be auditable</li>
        <li>Applications whose schema may change over time</li>
        <li>Applications with complex business logic</li>
    </ul>


    <hr class="my-12" />

    <p class="my-6 text-center lg:text-left">
        <x-button href="{{ route('docs.section.item', ['getting-started', 'quickstart']) }}">
            Get started with Verbs
        </x-button>
    </p>

</x-layout>
