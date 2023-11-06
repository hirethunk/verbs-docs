<?php

namespace App;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\TaskList\TaskListExtension;
use League\CommonMark\MarkdownConverter as BaseConverter;

class MarkdownConverter extends BaseConverter
{
	public function __construct(array $config = [])
	{
		$environment = new Environment($config);
		
		$environment->addExtension(new CommonMarkCoreExtension());
		
		$environment->addExtension(new class() implements ExtensionInterface {
			public function register(EnvironmentBuilderInterface $environment): void
			{
				$environment->addExtension(new AutolinkExtension());
				$environment->addExtension(new StrikethroughExtension());
				$environment->addExtension(new TableExtension());
				$environment->addExtension(new TaskListExtension());
			}
		});
		
		$environment->addExtension(new AttributesExtension());
		
		// use Torchlight\Commonmark\V2\TorchlightExtension;
		// $environment->addExtension(new TorchlightExtension());
		
		parent::__construct($environment);
	}
}
