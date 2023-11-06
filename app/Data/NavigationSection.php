<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class NavigationSection extends Data
{
	public function __construct(
		public string $title,
		/** @var DataCollection<int, \App\Data\NavigationItem> $items */
		#[DataCollectionOf(NavigationItem::class)] public DataCollection $items,
	) {
	}
}
