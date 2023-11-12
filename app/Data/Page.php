<?php

namespace App\Data;

use App\MarkdownConverter;
use Illuminate\Contracts\Support\Htmlable;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\Output\RenderedContentInterface;

class Page implements Htmlable
{
	public RenderedContentInterface $content;
	
	public array $metadata = [];
	
	public function __construct(
		public string $version,
		public string $filename,
		public ?string $title = null,
	) {
		$markdown = file_get_contents(resource_path("docs/{$this->version}/docs/{$this->filename}"));
		$this->content = (new MarkdownConverter())->convert($markdown);
		
		if ($this->content instanceof RenderedContentWithFrontMatter) {
			$this->metadata = $this->content->getFrontMatter();
			$this->title ??= data_get($this->metadata, 'title');
		}
	}
	
	public function toHtml(): string
	{
		return (string) $this->content;
	}
	
}
