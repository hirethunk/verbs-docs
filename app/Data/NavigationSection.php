<?php

namespace App\Data;

use Illuminate\Contracts\Routing\UrlRoutable;
use InvalidArgumentException;
use RuntimeException;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class NavigationSection extends Data implements UrlRoutable
{
	public Navigation $parent;
	
	public function __construct(
		public string $title,
		public string $slug,
		/** @var DataCollection<int, \App\Data\NavigationItem> $items */
		#[DataCollectionOf(NavigationItem::class)] public DataCollection $items,
	) {
		$this->items->each(fn(NavigationItem $item) => $item->parent = $this);
	}
	
	public function item(string $slug): NavigationItem
	{
		if ($item = $this->items->first(fn(NavigationItem $item) => $item->slug === $slug)) {
			return $item;
		}
		
		throw new InvalidArgumentException("No such item: '{$item}'");
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
