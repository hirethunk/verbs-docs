<?php

namespace App\Data;

use Illuminate\Filesystem\Filesystem;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class Navigation extends Data
{
	/** @var DataCollection<int, \App\Data\NavigationSection> */
	public DataCollection $sections;
	
	public function __construct(Filesystem $fs)
	{
		$path = storage_path('docs/main/navigation.json');
		$data = $fs->json($path);
		
		$this->sections = NavigationSection::collection($data);
	}
}
