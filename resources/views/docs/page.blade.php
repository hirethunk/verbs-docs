<x-layout :title="$page->title">
	
	<h1 class="text-2xl font-semibold text-stone-500 mb-6">
		{{ $page->title }}
	</h1>
	
	<article x-data class="prose lg:prose-xl">
		{{ $page }}
	</article>
	
</x-layout>
