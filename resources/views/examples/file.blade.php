<x-layout title="{{ $title }} - {{ $section }} - Verbs">
	
	<x-slot:meta>
		{{-- Primary Meta Tags --}}
		<meta name="title" content="Example - Verbs">
	</x-slot:meta>
	
	<h1 class="text-2xl font-semibold text-stone-500 mb-6">
		{{ $title }}
	</h1>
	
	<article>
		<pre><x-torchlight-code language="php" :contents="$source" /></pre>
	</article>

</x-layout>
