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

    <div class="lg:grid lg:grid-cols-2 lg:gap-4 my-6">
        <div>
            <p class="font-semibold text-center">
                Stop trying to cram everything in your models…
            </p>
            <div
                    x-data="{ expanded: false }"
                    class="max-h-80 relative my-6"
                    :class="{ 'max-h-80': !expanded }"
            >
                <pre 
                    class="m-0 p-0 max-h-80 overflow-hidden rounded overflow-x-auto"
                    :class="{ 'max-h-80': !expanded }"
                ><x-torchlight-code
                            language="php"
                            :contents="preg_replace('/^\s*(<\?php)\s*/i', '', file_get_contents(resource_path('examples/welcome/from.php')))"
                    /></pre>
                <div class="absolute w-full text-center -bottom-4 z-20">
                    <button
                        @click="expanded = !expanded"
                        type="button"
                        class="rounded-full bg-indigo-600 px-2.5 py-1 text-xs font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        x-text="expanded ? 'Show less' : 'Show more'"
                    >
                        Show more
                    </button>
                </div>
                <div
                        class="pointer-events-none flex flex-col items-center justify-end p-4 bg-gradient-to-b from-50% from-transparent to-90% to-white absolute inset-0 z-10"
                        :class="{ 'bg-gradient-to-b': ! expanded }"
                ></div>
            </div>
        </div>
        <div class="pt-6 lg:pt-0">
            <p class="font-semibold text-center">
                And start using actual verbs…
            </p>
            <div class="max-h-80 overflow-hidden relative my-6">
                <pre class="rounded overflow-x-auto"><x-torchlight-code
                            language="php"
                            :contents="preg_replace('/^\s*(<\?php)\s*/i', '', file_get_contents(resource_path('examples/welcome/to.php')))"
                    /></pre>
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
