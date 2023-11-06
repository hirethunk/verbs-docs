@props(['href'])

<li>
	<a
		href="{{ $href }}"
		class="text-sm leading-5 text-zinc-600 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white"
	>
		{{ $slot }}
	</a>
</li>
