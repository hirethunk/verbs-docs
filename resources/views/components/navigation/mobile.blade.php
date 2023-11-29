<!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
<div
	x-data="{ open: false }"
	x-show="open"
	@open-sidebar.window="open = true"
	class="relative z-50 lg:hidden"
	role="dialog"
	aria-modal="true"
>
	<div
		class="fixed inset-0 bg-stone-900/80"
		x-show="open"
		x-transition:enter="transition-opacity ease-linear duration-300"
		x-transition:enter-start="opacity-0"
		x-transition:enter-end="opacity-100"
		x-transition:leave="transition-opacity ease-linear duration-300"
		x-transition:leave-start="opacity-100"
		x-transition:leave-end="opacity-0"
	></div>
	
	<div class="fixed inset-0 flex">
		<div
			class="relative mr-16 flex w-full max-w-xs flex-1"
			x-show="open"
			x-transition:enter="transition ease-in-out duration-300 transform"
			x-transition:enter-start="-translate-x-full"
			x-transition:enter-end="translate-x-0"
			x-transition:leave="transition ease-in-out duration-300 transform"
			x-transition:leave-start="translate-x-0"
			x-transition:leave-end="-translate-x-full"
		>
			<div
				class="absolute left-full top-0 flex w-16 justify-center pt-5"
				x-show="open"
				x-transition:enter="transition-opacity ease-in-out duration-300"
				x-transition:enter-start="opacity-0"
				x-transition:enter-end="opacity-100"
				x-transition:leave="transition-opacity ease-in-out duration-300"
				x-transition:leave-start="opacity-100"
				x-transition:leave-end="opacity-0"
			>
				<button @click.prevent="open = false" type="button" class="-m-2.5 p-2.5">
					<span class="sr-only">Close sidebar</span>
					<svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>
			</div>
			
			<div class="flex grow flex-col gap-y-5 overflow-y-auto bg-[#f8ecdb] px-6 pb-4">
				
				<div class="flex h-24 shrink-0 items-center justify-center mt-6">
					<a href="/">
						<x-navigation.logo class="h-24 w-auto" />
					</a>
				</div>
				
				<nav class="flex flex-1 flex-col">
					<ul role="list" class="flex flex-1 flex-col gap-y-7">
						
						@foreach($navigation->sections as $section)
							
							<li>
								<x-navigation.section>
									{{ $section->title }}
								</x-navigation.section>
								
								<ul role="list" class="-mx-2 space-y-1">
									@foreach($section->items as $item)
										@if($item === $active_item && isset($sub_navigation))
											<div class="bg-stone-50 rounded pb-2">
												
												<x-navigation.item
													:href="$item->url() ?? route('docs.section.item', [$section, $item])"
													:icon="$item->icon"
													:active="true"
													mobile
												>
													{{ $item->title }}
												</x-navigation.item>
												
												<div class="ml-4 p-2 border-l border-l-indigo-100">
													@foreach($sub_navigation->sections as $sub_section)
														@if($sub_navigation->headings)
															<x-navigation.section>
																{{ $sub_section->title }}
															</x-navigation.section>
														@endif
														@foreach($sub_section->items as $sub_item)
															<x-navigation.item
																:href="route('examples.section.item', [$sub_navigation->prefix, $sub_section, $sub_item])"
																:icon="$sub_item->icon"
																:active="$sub_item === $active_sub_item"
																mobile
															>
																{{ $sub_item->title }}
															</x-navigation.item>
														@endforeach
													@endforeach
												</div>
											</div>
										@else
											<x-navigation.item
												:href="$item->url() ?? route('docs.section.item', [$section, $item])"
												:active="$item === $active_item"
												:icon="$item->icon"
												mobile
											>
												{{ $item->title }}
											</x-navigation.item>
										@endif
									@endforeach
								</ul>
							</li>
						
						@endforeach
						
						<li class="mt-6 pt-6 border-t border-stone-100 space-y-4">
							<a
								href="https://github.com/hirethunk/verbs"
								class="group text-stone-500 hover:text-stone-700 flex items-center gap-1"
								target="_blank"
							>
								<svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
									<path
										fill-rule="evenodd"
										d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
										clip-rule="evenodd"
									/>
								</svg>
								<span class="font-semibold text-sm">
									Verbs on GitHub
								</span>
							</a>
							<a
								href="https://discord.gg/hDhZmD6ZC9"
								class="group text-stone-500 hover:text-stone-700 flex items-center gap-1"
								target="_blank"
							>
								<svg class="h-8 w-8" fill="currentColor" viewBox="0 0 127.14 96.36" aria-hidden="true">
									<path d="M107.7,8.07A105.15,105.15,0,0,0,81.47,0a72.06,72.06,0,0,0-3.36,6.83A97.68,97.68,0,0,0,49,6.83,72.37,72.37,0,0,0,45.64,0,105.89,105.89,0,0,0,19.39,8.09C2.79,32.65-1.71,56.6.54,80.21h0A105.73,105.73,0,0,0,32.71,96.36,77.7,77.7,0,0,0,39.6,85.25a68.42,68.42,0,0,1-10.85-5.18c.91-.66,1.8-1.34,2.66-2a75.57,75.57,0,0,0,64.32,0c.87.71,1.76,1.39,2.66,2a68.68,68.68,0,0,1-10.87,5.19,77,77,0,0,0,6.89,11.1A105.25,105.25,0,0,0,126.6,80.22h0C129.24,52.84,122.09,29.11,107.7,8.07ZM42.45,65.69C36.18,65.69,31,60,31,53s5-12.74,11.43-12.74S54,46,53.89,53,48.84,65.69,42.45,65.69Zm42.24,0C78.41,65.69,73.25,60,73.25,53s5-12.74,11.44-12.74S96.23,46,96.12,53,91.08,65.69,84.69,65.69Z" />
								</svg>
								<span class="font-semibold text-sm">
									Join our Discord
								</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>
