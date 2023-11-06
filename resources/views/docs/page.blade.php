<x-layout :title="$page->title">
	
	<h1 class="text-2xl font-semibold text-yellow-500 text-opacity-90 mb-6">
		{{ $page->title }}
	</h1>
	
	<article class="prose lg:prose-xl">
		{{ $page }}
	</article>
	
</x-layout>
