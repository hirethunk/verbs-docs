<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class NavigationItem extends Data
{
	public function __construct(
		public string $title,
		public string $uri,
		public string $file,
	) {
	}
	
	public function href(): string
	{
		return '/docs/'.$this->uri;
	}
}
