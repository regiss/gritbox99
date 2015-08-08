<?php

namespace App\Components;

use Nette,
	Nette\Application\UI;


class HtmlAssets extends UI\Control
{
	private $developmentMode, $assetVersion, $basePath;

	public function __construct($developmentMode, $assetVersion, Nette\Http\Request $httpRequest)
	{
		$this->developmentMode = $developmentMode;
		$this->basePath = substr($httpRequest->getUrl()->getBasePath(), 0, -1);
		$this->assetVersion = $assetVersion;
	}

	public function render($type)
	{
		$this->template->type = $type;
		$this->template->developmentMode = $this->developmentMode;
		$this->template->assetVersion = $this->assetVersion;
		$this->template->basePath = $this->basePath;
		$this->template->render(__DIR__ . '/HtmlAssets.latte');
	}

}