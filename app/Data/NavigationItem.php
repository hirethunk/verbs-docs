<?php

namespace App\Data;

use Illuminate\Contracts\Routing\UrlRoutable;
use RuntimeException;
use Spatie\LaravelData\Data;

class NavigationItem extends Data implements UrlRoutable
{
	protected ?Page $page = null;
	
	public function __construct(
		public string $title,
		public string $slug,
		public string $icon = 'heroicon-o-document',
	) {
		$this->icon = str($this->icon)->start('heroicon-o-')->toString();
	}
	
	public function page(): Page
	{
		return $this->page ??= new Page('main', "{$this->slug}.md", $this->title);
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
