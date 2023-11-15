<?php

namespace App\Data;

use App\MarkdownConverter;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\Output\RenderedContentInterface;
use Torchlight\Blade\CodeComponent;

class Source
{
	public ?HtmlString $comments = null;
	
	public ?HtmlString $code = null;
	
	public ?string $title = null;
	
	public function __construct(
		string $path,
	) {
		$path = resource_path($path);
		
		if (Str::endsWith($path, '.md')) {
			$this->renderMarkdown(File::get($path));
		} else {
			$this->renderCodeExample($path);
		}
		
		if (preg_match('/<h1>\s*(?:<a.*?<\/a>\s*)?(.*)\s*<\/h1>/mi', (string) $this->comments, $matches)) {
			$this->title = $matches[1];
		}
	}
	
	protected function renderCodeExample(string $path): void
	{
		$raw = File::get($path);
		
		$pattern = '/(<\?php)\s*((?:\s*namespace[^;]+;\s*)*(?:\s*use[^;]+;\s*)*)\s*(?:\s*\/\*\*\s*(.*)\s+\*\/)?\s*(.*)/ism';
		preg_match($pattern, $raw, $matches);
		
		$code = $matches[1]." // [tl! collapse:start]\n\n".trim($matches[2], "\n")." // [tl! collapse:end]\n\n".$matches[4];
		$this->code = new HtmlString(
			Blade::render('<pre><x-torchlight-code language="php" :contents="$code" /></pre>', ['code' => $code])
		);
		
		$this->renderMarkdown(preg_replace('/^\s*\*(?: \t)*/im', '', $matches[3]));
	}
	
	protected function renderMarkdown(string $markdown): void
	{
		$this->comments = empty(trim($markdown))
			? null
			: new HtmlString((new MarkdownConverter())->convert($markdown));
	}
}
