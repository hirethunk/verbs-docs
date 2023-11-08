<?php

namespace App\Data;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;
use InvalidArgumentException;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class Navigation extends Data
{
	public ?DataCollection $sections = null;
	
	public static function docs(): static
	{
		return app(static::class);
	}
	
	public static function example(string $example): static
	{
		$example = strtolower($example);
		$key = "navigation.examples.{$example}";
		
		if (! app()->has($key)) {
			$namespace = (string) str($example)->studly();
			
			app()->instance($key, new static(
				path: "docs/main/examples/{$namespace}/navigation.json",
				prefix: "examples/{$example}",
			));
		}
		
		return app($key);
	}
	
	public function __construct(
		protected string $path,
		public string $prefix,
	) {
		$this->sections = NavigationSection::collection(File::json(storage_path($this->path)))
			->each(fn(NavigationSection $section) => $section->parent = $this);
	}
	
	public function section(string $slug): NavigationSection
	{
		if ($section = $this->sections->first(fn(NavigationSection $section) => $section->slug === $slug)) {
			return $section;
		}
		
		throw new InvalidArgumentException("No such section: '{$slug}'");
	}
}
