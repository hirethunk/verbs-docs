<x-layout>

    <x-navigation.logo class="h-24 w-auto mb-5 mx-auto lg:hidden" />

    <h1 class="text-2xl font-semibold text-stone-500 mb-6 hidden lg:block">
        Verbs
    </h1>

    <p class="text-center lg:text-left">
        Verbs is an event sourcing package for PHP artisans. It aims to take all the good
        things about event sourcing, and remove as much of the boilerplate and jargon as possible.
        Think in Verbs… not nouns.
    </p>

    <div class="grid grid-cols-2 gap-4 my-6">
        <p class="order-1 font-semibold text-center">
            Stop trying to cram everything in your models…
        </p>
        <pre class="m-0 p-0 rounded overflow-x-auto order-3">
            <x-torchlight-code language="php" :contents="resource_path('examples/welcome/from.php')" />
        </pre>
    
        <p class="order-2 font-semibold text-center">
            And start using actual verbs…
        </p>
        <pre class="m-0 p-0 rounded overflow-x-auto order-4">
            <x-torchlight-code language="php" :contents="resource_path('examples/welcome/to.php')" />
        </pre>
    </div>

    <p class="my-6 text-center lg:text-left">
        <x-button href="{{ route('docs.section.item', ['getting-started', 'quickstart']) }}">
            Get started with Verbs
        </x-button>
    </p>

</x-layout>
