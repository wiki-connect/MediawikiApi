<?php

namespace WikiConnect\MediawikiApi\Client\Request;

trait MethodTrait {

	private string $method;

	public function getMethod(): string {
		return $this->method;
	}

	public function setMethod( string $method ): self {
		$this->method = $method;
		return $this;
	}

}
