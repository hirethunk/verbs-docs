<?php

namespace App;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\MarkdownConverter as BaseConverter;
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
