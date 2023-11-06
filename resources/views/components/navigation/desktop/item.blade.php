@props([
	'href', 
	'active' => false,
	'icon' => 'heroicon-o-document'
])
<li>
	<a
		href="{{ $href }}"
		@class([
			'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
			'bg-gray-50 text-indigo-600' => $active,
			'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' => !$active,			
		])
	>
		<x-icon :name="$icon" class="w-5 h-5 flex-shrink-0" />
		<span>
			{{ $slot }}
		</span>
	</a>
</li>
