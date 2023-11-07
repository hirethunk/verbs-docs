<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>{{ isset($title) ? $title . ' - ' : null }}Laravel - The PHP Framework For Web Artisans</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	@vite('resources/css/app.css')
</head>
<body class="language-php h-full w-full font-sans text-gray-900 antialiased">

<div id="og-image" class="w-[1200px] h-[627px] bg-[#f8e8d1] mx-auto my-24 flex flex-col justify-center">
	<img
		alt="Verbs"
		src="{{ asset('og-logo.png') }}"
		class="h-96 w-full object-contain"
	/>
	<h1 class="mx-auto text-6xl">
		{{ $page->title }}
	</h1>
</div>

</body>
</html>
