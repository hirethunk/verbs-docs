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
	
	<div class="flex">
		<article x-data class="prose max-w-none overflow-x-auto">
			
			<h1>
				{{ $page->title }}
			</h1>
			
			{{ $page }}
		
		</article>
		<aside
			x-data="visibleNavHighlighter"
			x-on:scroll.window.throttle.50ms="onScroll()"
			x-show="headings.length > 0"
			class="hidden top-16 w-64 h-screen sticky overflow-y-auto py-8 pl-6 lg:block"
		>
			<h4 class="mb-2 block text-sm font-bold uppercase text-slate-300">
				On this page
			</h4>
			
			<ul class="space-y-3">
				<template x-for="heading in headings">
					<li class="text-sm">
						<a
							:href="`#${heading.permalink}`"
							class="text-slate-600 hover:text-slate-900"
							:class="{ 
								'font-medium text-slate-900': active_permalink === heading.permalink, 
								'text-slate-600': active_permalink !== heading.permalink
							}"
							x-text="heading.title"
						></a>
					</li>
				</template>
			</ul>
		</aside>
	</div>

</x-layout>
