@props([
    'active' => 'dev-main',
    'versions' => ['dev-main', '1.x', '2.x']
])

@once
    <script>
    document.addEventListener('alpine:init', () => {
        const useTrackedPointer = () => {
            let lastPos = [-1, -1];

            return {
                wasMoved(evt) {
                    const newPos = [evt.screenX, evt.screenY];

                    if (lastPos[0] === newPos[0] && lastPos[1] === newPos[1]) {
                        return false;
                    }

                    lastPos = newPos;
                    return true;
                },
                update(evt) {
                    lastPos = [evt.screenX, evt.screenY];
                },
            };
        };

        Alpine.data('versionSwitcher', () => {
            const pointer = useTrackedPointer();

            return {
                activeDescendant: null,
                activeIndex: null,
                items: null,
                open: false,

                init() {
                    this.items = Array.from(this.$el.querySelectorAll('[role="menuitem"]'));
                    this.$watch('open', () => {
                        if (this.open) {
                            this.activeIndex = -1;
                        }
                    });
                },

                focusButton() {
                    this.$refs.button.focus();
                },

                onButtonClick() {
                    this.open = !this.open;

                    if (this.open) {
                        this.$nextTick(() => this.$refs['menu-items'].focus());
                    }
                },

                onButtonEnter() {
                    this.open = !this.open;

                    if (this.open) {
                        this.activeIndex = 0;
                        this.activeDescendant = this.items[this.activeIndex].id;
                        this.$nextTick(() => this.$refs['menu-items'].focus());
                    }
                },

                onArrowUp() {
                    if (!this.open) {
                        this.open = true;
                        this.activeIndex = this.items.length - 1;
                        this.activeDescendant = this.items[this.activeIndex].id;

                        return;
                    }

                    if (this.activeIndex === 0) {
                        return;
                    }

                    this.activeIndex = this.activeIndex === -1 ? this.items.length - 1 : this.activeIndex - 1;
                    this.activeDescendant = this.items[this.activeIndex].id;
                },

                onArrowDown() {
                    if (!this.open) {
                        this.open = true;
                        this.activeIndex = 0;
                        this.activeDescendant = this.items[this.activeIndex].id;

                        return;
                    }

                    if (this.activeIndex === this.items.length - 1) {
                        return;
                    }

                    this.activeIndex = this.activeIndex + 1;
                    this.activeDescendant = this.items[this.activeIndex].id;
                },

                onClickAway($event) {
                    if (this.open) {
                        const selectors = [
                            '[contentEditable=true]',
                            '[tabindex]',
                            'a[href]',
                            'area[href]',
                            'button:not([disabled])',
                            'iframe',
                            'input:not([disabled])',
                            'select:not([disabled])',
                            'textarea:not([disabled])',
                        ];

                        const focusableSelector = selectors
                            .map((selector) => `${ selector }:not([tabindex='-1'])`)
                            .join(',');

                        this.open = false;

                        if (!$event.target.closest(focusableSelector)) {
                            this.focusButton();
                        }
                    }
                },

                onMouseEnter(evt) {
                    pointer.update(evt);
                },

                onMouseMove(evt, newIndex) {
                    // Only highlight when the cursor has moved
                    // Pressing arrow keys can otherwise scroll the container and override the selected item
                    if (pointer.wasMoved(evt)) {
                        this.activeIndex = newIndex;
                    }
                },

                onMouseLeave(evt) {
                    // Only unhighlight when the cursor has moved
                    // Pressing arrow keys can otherwise scroll the container and override the selected item
                    if (pointer.wasMoved(evt)) {
                        this.activeIndex = -1;
                    }
                },
            };
        });
    });
    </script>
@endonce

<div
        x-data="versionSwitcher"
        @keydown.escape.stop="open = false; focusButton()"
        @click.away="onClickAway($event)"
        class="relative inline-block text-left"
>
    <div>
        <button
                type="button"
                class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-mono font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                id="menu-button"
                x-ref="button"
                @click="onButtonClick()"
                @keyup.space.prevent="onButtonEnter()"
                @keydown.enter.prevent="onButtonEnter()"
                aria-expanded="true"
                aria-haspopup="true"
                x-bind:aria-expanded="open.toString()"
                @keydown.arrow-up.prevent="onArrowUp()"
                @keydown.arrow-down.prevent="onArrowDown()"
        >
            {{ $active }}
            <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                      d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                      clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>

    <div
            x-show="open"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            x-ref="menu-items"
            x-bind:aria-activedescendant="activeDescendant"
            role="menu"
            aria-orientation="vertical"
            aria-labelledby="menu-button"
            tabindex="-1"
            @keydown.arrow-up.prevent="onArrowUp()"
            @keydown.arrow-down.prevent="onArrowDown()"
            @keydown.tab="open = false"
            @keydown.enter.prevent="open = false; focusButton()"
            @keyup.space.prevent="open = false; focusButton()"
    >
        <div class="py-1" role="none">
            @php $index = 0; @endphp
            @foreach($versions as $version)
                @if($version === $active)
                    <div class="px-4 py-3 text-sm" role="none">
                        Currently viewing <span class="font-mono font-semibold" role="none">{{ $active }}</span>
                    </div>
                @else
                    <form method="POST" action="#" role="none" class="m-0">
                        <button
                                type="submit"
                                @class([
                                    'text-gray-700 flex w-full gap-1 items-center px-4 py-2 text-left text-sm',
                                    'font-bold' => $version === $active
                                ])
                                :class="{ 
                                    'bg-gray-100 text-gray-900': activeIndex === {{ $index }}, 
                                    'text-gray-700': !(activeIndex === {{ $index }}) 
                                }"
                                role="menuitem"
                                tabindex="-1"
                                id="version-switcher-item-{{ $index }}"
                                @mouseenter="onMouseEnter($event)"
                                @mousemove="onMouseMove($event, {{ $index }})"
                                @mouseleave="onMouseLeave($event)"
                                @click="open = false; focusButton()"
                        >
                            Switch to <span class="font-mono font-semibold">{{ $version }}</span>
                            <x-heroicon-m-arrow-right class="w-4 h-4" />
                        </button>
                    </form>
                    @php $index++; @endphp
                @endif
            @endforeach
        </div>
    </div>

</div>
