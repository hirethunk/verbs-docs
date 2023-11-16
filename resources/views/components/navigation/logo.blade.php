@props(['animate' => false])
<div
	x-data="{ animating: false, off: '{{ asset('logo.png') }}', on: '{{ asset('logo-hover.gif') }}' }"
	{{ $attributes->merge(['class' => 'relative group']) }}
	@mouseover="animating = true"
	@mouseleave="animating = false"
>
	<img
		{{ $attributes }}
		src="{{ asset('logo.png') }}"
		@if($animate)
		:src="animating ? on : off"
		@endif
		alt="Verbs"
	/>
</div>
