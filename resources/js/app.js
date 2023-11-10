import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

Alpine.plugin(intersect);

window.Alpine = Alpine;

Alpine.data('onThisPage', () => ({
	headings: [],
	active_permalink: null,
	
	init() {
		this.headings = Array.from(document.querySelectorAll('.heading-permalink'))
			.map(node => ({
				title: node.parentNode.textContent.replace('#', ''),
				permalink: node.id,
				node: node.parentNode,
				top: Infinity,
			}));
		
		this.onScroll();
	},
	
	onScroll() {
		this.headings.forEach(heading => {
			heading.top = heading.node.getBoundingClientRect().top;
		});

		const visible_headings = this.headings
			.filter(heading => heading.top < 200)
			.sort((a, b) => b.top - a.top);

		if (visible_headings.length === 0) {
			this.active_permalink = null;
			return;
		}

		this.active_permalink = visible_headings[0].permalink;
	},
}));

Alpine.start();
