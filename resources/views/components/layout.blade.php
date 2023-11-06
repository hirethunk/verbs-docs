<html lang="en" class="h-full">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@vite('resources/css/app.css')
	<title>
		Verbs
	</title>
</head>
<body class="flex min-h-full bg-white antialiased dark:bg-zinc-900">
<div class="w-full">
	<div class="h-full lg:ml-72 xl:ml-80">
		
		<header class="contents lg:pointer-events-none lg:fixed lg:inset-0 lg:z-40 lg:flex">
			<div class="contents lg:pointer-events-auto lg:block lg:w-72 lg:overflow-y-auto lg:border-r lg:border-zinc-900/10 lg:px-6 lg:pb-8 lg:pt-4 lg:dark:border-white/10 xl:w-80">
				
				<div class="hidden lg:flex">
					<a href="/" aria-label="Home">
						Verbs
					</a>
				</div>
				
				<x-header />
				
				<x-navigation class="hidden lg:mt-10 lg:block" />
			
			</div>
		</header>
		
		<div class="relative flex h-full flex-col px-4 pt-14 sm:px-6 lg:px-8">
			
			<main class="flex-auto">
				{{ $slot }}
			</main>
			
			<x-footer />
		
		</div>
	
	</div>
</div>
</body>
</html>
