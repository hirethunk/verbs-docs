@props(['previous_page' => null, 'next_page' => null])
<footer class="mx-auto w-full max-w-2xl space-y-10 pb-16 lg:max-w-5xl">
	
	<div class="flex">
		@if($previous_page)
			<div class="flex flex-col items-start gap-3">
				{{-- <PageLink label="Previous" page={previousPage} previous /> --}}
				Previous
			</div>
		@endif
		@if($next_page)
			<div class="ml-auto flex flex-col items-end gap-3">
				{{-- <PageLink label="Next" page={nextPage} /> --}}
				Next
			</div>
		@endif
	</div>
	
	<div class="flex flex-col items-center justify-between gap-5 border-t border-zinc-900/5 pt-8 dark:border-white/5 sm:flex-row">
		<p class="text-xs text-zinc-600 dark:text-zinc-400">
			&copy; Copyright {{ now()->year }}. All rights reserved.
		</p>
		<div class="flex gap-4">
			{{-- Social Links --}}
		</div>
	</div>

</footer>
