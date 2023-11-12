<div class="sticky top-0 z-40">
	<div class="flex h-16 items-center gap-x-4 border-b border-gray-200 bg-white bg-opacity-80 px-4 shadow-sm backdrop-blur sm:gap-x-6 sm:px-6 lg:px-0 lg:shadow-none">
		
		{{-- Mobile Nav Button --}}
		<button
			x-data
			@click="$dispatch('open-sidebar')"
			type="button"
			class="-m-2.5 p-2.5 text-gray-700 lg:hidden"
		>
			<span class="sr-only">Open sidebar</span>
			<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
			</svg>
		</button>
		
		{{-- Separator --}}
		<div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true"></div>
		
		<a href="/" class="flex-shrink-0 lg:hidden">
			<x-navigation.logo class="h-8 w-auto" />
		</a>
		
		{{-- Top Menu --}}
		<div class="flex flex-1 gap-x-4 self-stretch items-center lg:gap-x-6 lg:px-8">
			
			{{-- Algolia docsearch container --}}
			<div id="docsearch" class="flex-grow max-w-sm flex"></div>
			
			{{-- 
			<form class="relative flex flex-1" action="#" method="GET">
				<label for="search-field" class="sr-only">
					Search
				</label>
				<svg class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
					<path fill-rule="evenodd"
					      d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
					      clip-rule="evenodd" />
				</svg>
				<input
					id="search-field"
					class="block h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm"
					placeholder="Search..."
					type="search"
					name="search"
				/>
			</form>
			--}}
			
			{{-- Right Side --}}
			<div class="ml-auto flex items-center gap-x-4 lg:gap-x-6">
				{{--
				<x-version-switcher />
				--}}
			</div>
		</div>
	</div>
</div>
