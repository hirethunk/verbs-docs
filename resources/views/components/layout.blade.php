@props(['title' => null])

<html lang="en" class="h-full">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	@vite('resources/css/app.css')
	@vite('resources/js/app.js')
	<title>
		{{ $title ? "$title - Verbs" : 'Verbs' }}
	</title>
	{{ $meta ?? null }}
	@production
		<script defer data-domain="verbs.thunk.dev" src="https://plausible.io/js/script.outbound-links.js"></script>
	@endproduction
</head>
<body class="flex flex-col min-h-full bg-[#f8ecdb] antialiased dark:bg-zinc-900">

<x-navigation.mobile />
<x-navigation.desktop />

<div class="lg:pl-72 flex-1 bg-white">
	<x-header />
	
	<main class="py-10">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			{{ $slot }}
		</div>
	</main>
	
</div>

<x-footer />

</body>
</html>
