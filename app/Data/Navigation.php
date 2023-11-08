<?php

namespace App\Data;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class Navigation extends Data
{
	/** @var DataCollection<int, \App\Data\NavigationSection> */
	protected ?DataCollection $sections = null;
	
	public function __construct(
		protected string $path = 'docs/main/docs/navigation.json'
	) {
	}
	
	public function section(string $slug): ?NavigationSection
	{
		return $this->sections()->first(fn(NavigationSection $section) => $section->slug === $slug);
	}
	
	public function sections(): DataCollection
	{
		return $this->sections ??= NavigationSection::collection($this->data());
	}
	
	protected function data(): array
	{
		try {
			$path = storage_path($this->path);
			return File::json($path);
		} catch (FileNotFoundException) {
			return [];
		}
	}
}
