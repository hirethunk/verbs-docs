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
        <div>
            <p class="order-1 font-semibold text-center">
                Stop trying to cram everything in your models…
            </p>
            <div
                x-data="{ expanded: false }"
                class="max-h-96 overflow-hidden relative"
                :class="{ 'max-h-96': !expanded }"
            >
                <pre class="m-0 p-0 rounded overflow-x-auto order-3">
                    <x-torchlight-code language="php" :contents="resource_path('examples/welcome/from.php')" />
                </pre>
                <div 
                    class="flex flex-col items-center justify-end p-4 bg-gradient-to-b from-30% from-transparent to-90% to-white absolute inset-0 z-10"
                    :class="{ 'bg-gradient-to-b': ! expanded }"
                >
                    <button
                        @click="expanded = !expanded"
                        type="button"
                        class="rounded-full bg-indigo-600 px-2.5 py-1 text-xs font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        x-text="expanded ? 'Show less' : 'Show more'"
                    >
                        Show more
                    </button>
                </div>
            </div>
        </div>
        <div>
            <p class="order-2 font-semibold text-center">
                And start using actual verbs…
            </p>
            <div class="max-h-96 overflow-hidden relative">
                <pre class="m-0 p-0 rounded overflow-x-auto order-4">
                    <x-torchlight-code language="php" :contents="resource_path('examples/welcome/to.php')" />
                </pre>
            </div>
        </div>
    </div>
    
    <hr class="my-12" />

    <p class="my-6 text-center lg:text-left">
        <x-button href="{{ route('docs.section.item', ['getting-started', 'quickstart']) }}">
            Get started with Verbs
        </x-button>
    </p>

</x-layout>
