<?php

namespace App\Data;

use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Support\Facades\File;
use RuntimeException;
use Spatie\LaravelData\Data;

class NavigationItem extends Data implements UrlRoutable
{
	public NavigationSection $parent;
	
	protected ?Page $page = null;
	
	protected ?Source $source = null;
	
	public function __construct(
		public string $title,
		public ?string $slug = null,
		public ?string $path = null,
		public ?string $section = null,
		public ?string $url = null,
		public string $icon = 'heroicon-o-document',
	) {
		$this->slug ??= str($this->title)->slug()->toString();
		$this->path ??= "{$this->slug}.md";
		$this->icon = str($this->icon)->start('heroicon-o-')->toString();
	}
	
	public function url(): ?string
	{
		return $this->url
			? url($this->url)
			: null;
	}
	
	public function page(): Page
	{
		return $this->page ??= new Page('main', $this->path, $this->title);
	}
	
	public function source(): Source
	{
		return $this->source ??= new Source("docs/main/examples/{$this->parent->parent->namespace}/{$this->path}");
	}
	
	public function sectionHash(): string
	{
		return $this->section
			? str($this->section)->ltrim('#')->start('content-')->start('#')
			: '';
	}
	
	public function getRouteKey()
	{
		return $this->slug;
	}
	
	public function getRouteKeyName()
	{
		return 'slug';
	}
	
	public function resolveRouteBinding($value, $field = null)
	{
		throw new RuntimeException('Not implemented.');
	}
	
	public function resolveChildRouteBinding($childType, $value, $field)
	{
		throw new RuntimeException('Not implemented.');
	}
}
