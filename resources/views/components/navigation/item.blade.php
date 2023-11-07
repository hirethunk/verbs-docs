@props([
	'href', 
	'active' => false,
	'mobile' => false,
	'section' => null,
	'icon' => 'heroicon-o-document'
])
<li>
	<a
		{{ $attributes }}
		href="{{ $href }}"
		@class([
			'flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
			'bg-stone-50 text-indigo-600' => $active,
			'group text-stone-800 hover:text-indigo-600 hover:bg-stone-50' => !$active,			
		])
	>
		<x-icon 
			:name="$icon"
			@class(['w-5 h-5 flex-shrink-0', 'tranform transition-transform group-hover:translate-x-1' => ! $mobile])
		/>
		<span @class(['tranform transition-transform group-hover:translate-x-2' => ! $mobile])>
			{{ $slot }}
		</span>
	</a>
</li>
