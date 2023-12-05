<?php

namespace WikiConnect\MediawikiApi\Client\Request;

trait PathTrait {

	private string $path = "";

	public function getPath(): string {
		return $this->path;
	}

	public function setPath( string $path ): self {
		$this->path = $path;
		return $this;
	}

}
