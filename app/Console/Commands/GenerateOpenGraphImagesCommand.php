<?php

namespace App\Console\Commands;

use App\Data\Navigation;
use App\Data\NavigationItem;
use App\Data\NavigationSection;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Console\Command;
use Throwable;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\error;
use function Laravel\Prompts\intro;

class GenerateOpenGraphImagesCommand extends Command
{
	protected $signature = 'og:generate';
	
	protected ?RemoteWebDriver $driver = null;
	
	public function handle(Navigation $navigation)
	{
		intro('Before generating open graph images, you must start a "chromedriver" process and run "php artisan serve" in another process.');
		if (!confirm('Are both processes running?')) {
			error('Aborted');
			return 1;
		}
		
		$this->driver = $this->driver();
		
		register_shutdown_function(function() {
			$this->quit();
		});
		
		try {
			$navigation->sections->each(function(NavigationSection $section) {
				$section->items->each(function(NavigationItem $item) use ($section) {
					$this->screenShotOpenGraphImage($section->slug, $item->slug);
				});
			});
		} finally {
			$this->quit();
		}
		
		return 0;
	}
	
	protected function screenShotOpenGraphImage($section_slug, $item_slug): string
	{
		$url = url("/__og-src/{$section_slug}/{$item_slug}");
		$path = public_path("/opengraph/{$section_slug}/{$item_slug}.png");
		
		$this->info($url);
		
		try {
			$this->driver->navigate()->to($url);
			
			$this->driver->wait()
				->until(fn(RemoteWebDriver $driver) => $driver->executeScript('return `complete` === document.readyState'));
			
			$this->driver->findElement(WebDriverBy::id('og-image'))->takeElementScreenshot($path);
			
			$this->info($path);
		} catch (Throwable $exception) {
			$this->error($exception->getMessage());	
		}
		
		$this->newLine();
		
		return $path;
	}
	
	public function getSubscribedSignals(): array
	{
		return [
			2, // SIGINT
			15, //SIGTERM
		];
	}
	
	public function handleSignal(int $signal): void
	{
		$this->quit();
		exit(1);
	}
	
	protected function quit()
	{
		if ($this->driver) {
			$this->warn("\nQuitting chromedriver...");
			$this->driver->quit();
			$this->driver = null;
		}
	}
	
	protected function driver()
	{
		$options = new ChromeOptions();
		$options->addArguments([
			'--window-size=1400,1000', // Larger than our og:image size
			'--force-device-scale-factor=2.0', // Higher DPI screenshot
		]);
		
		$capabilities = DesiredCapabilities::chrome();
		$capabilities->setCapability(ChromeOptions::CAPABILITY, $options);
		
		return RemoteWebDriver::create('http://localhost:9515', $capabilities);
	}
}
