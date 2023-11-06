<div
	x-data="{ isInsideMobileNavigation: false, mobileNavIsOpen: false }"
	class="fixed inset-x-0 top-0 z-50 flex h-14 items-center justify-between gap-12 px-4 transition sm:px-6 lg:left-72 lg:z-30 lg:px-8 xl:left-80"
	:class="{ 
		'backdrop-blur-sm dark:backdrop-blur lg:left-72 xl:left-80': ! isInsideMobileNavigation,
		'bg-white/[var(--bg-opacity-light)] dark:bg-zinc-900/[var(--bg-opacity-dark)]': ! isInsideMobileNavigation,
		'bg-white dark:bg-zinc-900': isInsideMobileNavigation 
	}"
>
	<div
		class="absolute inset-x-0 top-full h-px transition"
		:class="{ 'bg-zinc-900/7.5 dark:bg-white/7.5': isInsideMobileNavigation || !mobileNavIsOpen }"
	/>
	
	<div class="flex items-center gap-5 lg:hidden">
		{{-- Mobile Nav --}}
		<a href="/" aria-label="Home">
			Verbs
		</a>
	</div>
	
	<div class="flex items-center gap-5">
		<nav class="hidden md:block">
			<ul role="list" class="flex items-center gap-8">
				<x-top-level-nav-item href="/">
					API
				</x-top-level-nav-item>
				<x-top-level-nav-item href="/">
					Documentation
				</x-top-level-nav-item>
				<x-top-level-nav-item href="/">
					Support
				</x-top-level-nav-item>
			</ul>
		</nav>
		<div class="hidden md:block md:h-5 md:w-px md:bg-zinc-900/10 md:dark:bg-white/15" />
		<div class="flex gap-4">
			{{-- Mobile Search --}}
			{{-- Theme Toggle --}}
		</div>
	</div>
</div>
