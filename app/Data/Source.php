<?php

namespace App\Data;

use App\MarkdownConverter;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\HtmlString;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\Output\RenderedContentInterface;

class Source
{
	public ?HtmlString $comments = null;
	
	public string $code;
	
	public function __construct(
		string $path,
	) {
		$raw = File::get(storage_path($path));
		
		$pattern = '/(<\?php)\s*((?:\s*namespace[^;]+;\s*)*(?:\s*use[^;]+;\s*)*)\s*(?:\s*\/\*\*\s*(.*)\s+\*\/)?\s*(.*)/ism';
		preg_match($pattern, $raw, $matches);
		
		$this->code = $matches[1]." // [tl! collapse:start]\n\n".trim($matches[2], "\n")." // [tl! collapse:end]\n\n".$matches[4];
		
		$comments = preg_replace('/^\s*\*(?: \t)*/im', '', $matches[3]);
		$this->comments = empty(trim($comments)) ? null : new HtmlString((new MarkdownConverter())->convert($comments));
	}
}
