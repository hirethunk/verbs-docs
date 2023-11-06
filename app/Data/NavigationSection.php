<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class NavigationSection extends Data
{
	public function __construct(
		public string $title,
		#[DataCollectionOf(NavigationItem::class)] public DataCollection $items,
	) {
	}
}
