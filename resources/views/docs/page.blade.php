<x-layout :title="$page->title">
	
	<x-slot:meta>
		{{-- Primary Meta Tags --}}
		<meta name="title" content="{{ $page->title }} - Verbs">
		{{--
		<meta name="description"
		      content="{{ $content->metadata('description', 'Laravel is a PHP web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.') }}">
		--}}
		
		{{-- Open Graph / Facebook --}}
		<meta property="og:type" content="website">
		<meta property="og:url" content="{{ url('/') }}">
		<meta property="og:title" content="{{ $page->title }} - Verbs">
		{{--
		<meta name="og:description"
		      content="{{ $content->openGraph('description', 'Laravel is a PHP web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.') }}">
		--}}
		<meta property="og:image" content="{{ asset('opengraph/'.$section->slug.'/'.$item->slug.'.png') }}">
		
		<!-- Twitter -->
		<meta property="twitter:card" content="summary_large_image">
		<meta property="twitter:url" content="{{ url('/') }}">
		<meta property="twitter:title" content="{{ $page->title }} - Verbs">
		{{--
		<meta property="twitter:description"
		      content="{{ $content->twitter('description', 'Laravel is a PHP web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.') }}">
		--}}
		<meta property="twitter:image" content="{{ asset('opengraph/'.$section->slug.'/'.$item->slug.'.png') }}">
	</x-slot:meta>
	
	<article x-data class="prose max-w-none">
		
		<h1>
			{{ $page->title }}
		</h1>
		
		{{ $page }}
		
	</article>
	
</x-layout>
