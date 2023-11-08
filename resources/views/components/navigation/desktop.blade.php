<div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
	
	<div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-stone-700 bg-[#f8ecdb] px-6 pb-4">
		
		<div class="flex h-24 mt-5 shrink-0 items-center">
			<a href="/">
				<x-navigation.logo class="h-24 w-auto" />
			</a>
		</div>
		
		<nav class="flex flex-1 flex-col">
			
			<ul
				role="list"
				class="flex flex-1 flex-col gap-y-7"
			>
				
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
										>
											{{ $item->title }}
										</x-navigation.item>
										
										<div class="ml-4 p-2 border-l border-l-indigo-100">
											@foreach($sub_navigation->sections as $sub_section)
												<x-navigation.section>
													{{ $sub_section->title }}
												</x-navigation.section>
												@foreach($sub_section->items as $sub_item)
													<x-navigation.item
														:href="route('examples.section.item', [$sub_navigation->prefix, $sub_section, $sub_item])"
														:icon="$sub_item->icon"
														:active="$sub_item === $active_sub_item"
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
									>
										{{ $item->title }}
									</x-navigation.item>
								@endif
							@endforeach
						</ul>
					</li>
				
				@endforeach
				
				<li class="mt-auto">
					<a
						href="https://github.com/hirethunk/verbs"
						class="group text-stone-500 hover:text-stone-700 inline-flex items-center gap-1"
						target="_blank"
					>
						<span class="sr-only">GitHub</span>
						<svg class="h-8 w-8 transform transition-all group-hover:-rotate-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path
								fill-rule="evenodd"
								d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
								clip-rule="evenodd"
							/>
						</svg>
						<span class="transform transition-all ease-out duration-300 opacity-0 -translate-x-1 font-semibold text-sm group-hover:opacity-100 group-hover:translate-x-0">
							Verbs on GitHub
						</span>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</div>
