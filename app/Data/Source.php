<?php

namespace App\Data;

use App\MarkdownConverter;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\Output\RenderedContentInterface;

class Source
{
	public ?HtmlString $comments = null;
	
	public function __construct(
		public string $source,
		?string $comments = null,
	) {
		$comments = preg_replace('/^\s*\*(?: \t)*/im', '', $comments);
		$this->comments = empty(trim($comments)) ? null : new HtmlString((new MarkdownConverter())->convert($comments));
	}
}
