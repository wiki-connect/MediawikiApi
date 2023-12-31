<?php

namespace WikiConnect\MediawikiApi\Client\Request;

trait HeadersTrait {

	private array $headers = [];

	public function getHeaders(): array {
		return $this->headers;
	}

	public function setHeaders( array $headers ): self {
		$this->headers = $headers;
		return $this;
	}

}
