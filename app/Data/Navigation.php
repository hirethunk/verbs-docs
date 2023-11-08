<?php

namespace App\Data;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Throwable;

class Navigation extends Data
{
	/** @var DataCollection<int, \App\Data\NavigationSection> */
	public DataCollection $sections;
	
	public function __construct(Filesystem $fs)
	{
		try {
			$path = storage_path('docs/main/docs/navigation.json');
			$data = $fs->json($path);
		} catch (FileNotFoundException) {
			$data = [];
		}
		
		$this->sections = NavigationSection::collection($data);
	}
	
	public function section(string $slug): ?NavigationSection
	{
		return $this->sections->first(fn(NavigationSection $section) => $section->slug === $slug);
	}
}
