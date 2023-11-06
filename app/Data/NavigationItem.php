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
		public string $file,
	) {
	}
	
	public function href(): string
	{
		return '/docs/'.$this->slug;
	}
	
	public function page(): Page
	{
		return $this->page ??= new Page('main', $this->file, $this->title);
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
