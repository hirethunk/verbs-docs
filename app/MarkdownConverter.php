<?php

namespace App;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\BlockQuote;
use League\CommonMark\Extension\CommonMark\Renderer\Block\BlockQuoteRenderer;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\MarkdownConverter as BaseConverter;
use League\CommonMark\Node\Inline\Text;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use Torchlight\Commonmark\V2\TorchlightExtension;

class MarkdownConverter extends BaseConverter
{
	public function __construct(array $config = [])
	{
		$config['heading_permalink'] = [
			'html_class' => 'heading-permalink text-slate-300 mr-1 relative -top-0.5 no-underline text-lg scroll-mt-24 hover:text-stone-500',
			'symbol' => '#',
		];
		
		$environment = new Environment($config);
		
		$environment->addExtension(new FrontMatterExtension());
		$environment->addExtension(new CommonMarkCoreExtension());
		$environment->addExtension(new GithubFlavoredMarkdownExtension());
		$environment->addExtension(new TorchlightExtension());
		$environment->addExtension(new HeadingPermalinkExtension());
		$environment->addExtension(new AttributesExtension());
		
		$environment->addRenderer(BlockQuote::class, new class implements NodeRendererInterface
		{
			public function render(Node $node, ChildNodeRendererInterface $childRenderer)
			{
				$renderer = new BlockQuoteRenderer();
				[$classes, $heading_classes, $heading, $svg] = $this->parseNode($node);
				
				if ($svg) {
					return new HtmlElement(
						tagName: 'div',
						attributes: ['class' => $classes],
						contents: [
							new HtmlElement('div', ['class' => $heading_classes], [$svg, $heading]),
							$childRenderer->renderNodes($node->firstChild()->children())
						],
					);
				}
				
				return $renderer->render($node, $childRenderer);
			}
			
			protected function parseNode(Node $node): array
			{
				$paragraph = $node->firstChild();
				$child = $paragraph?->firstChild();
				
				if ($child instanceof Text && preg_match('#^\[!(note|tip|important|warning|caution)]$#i', $child->getLiteral(), $matches)) {
					$child->detach();
					
					return match ($matches[1]) {
						'note' => ['border-l-4 border-blue-700 pl-4 py-2', 'text-blue-700 flex items-center font-semibold', 'Note', '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>'],
						'tip' => ['border-l-4 border-green-700 pl-4 py-2', 'text-green-700 flex items-center font-semibold', 'Tip', '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" /></svg>'],
						'important' => ['border-l-4 border-purple-700 pl-4 py-2', 'text-purple-700 flex items-center font-semibold', 'Important', '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>'],
						'warning' => ['border-l-4 border-yellow-600 pl-4 py-2', 'text-yellow-600 flex items-center font-semibold', 'Warning', '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>'],
						'caution' => ['border-l-4 border-red-500 pl-4 py-2', 'text-red-500 flex items-center font-semibold', 'Caution', '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 animate-pulse mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>'],
					};
				}
				
				return [null, null];
			}
		});
		
		// $environment->addRenderer(Heading::class, new class implements NodeRendererInterface {
		// 	public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
		// 	{
		// 		Heading::assertInstanceOf($node);
		//		
		// 		$tag = 'h'.$node->getLevel();
		//		
		// 		$slug = collect($node->children())
		// 			->filter(fn($child) => $child instanceof HeadingPermalink)
		// 			->map(fn(HeadingPermalink $permalink) => $permalink->getSlug())
		// 			->first();
		//		
		// 		$attrs = $node->data->get('attributes');
		// 		$attrs['x-intersect.half'] = "\$dispatch('intersected', { section: 'content-{$slug}' })";
		//		
		// 		return new HtmlElement($tag, $attrs, $childRenderer->renderNodes($node->children()));
		// 	}
		//	
		// 	public function getXmlTagName(Node $node): string
		// 	{
		// 		return 'heading';
		// 	}
		//	
		// 	public function getXmlAttributes(Node $node): array
		// 	{
		// 		Heading::assertInstanceOf($node);
		//		
		// 		return ['level' => $node->getLevel()];
		// 	}
		// });
		
		parent::__construct($environment);
	}
}
