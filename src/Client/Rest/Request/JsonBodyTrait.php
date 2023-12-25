<?php

namespace WikiConnect\MediawikiApi\Client\Rest\Request;

trait JsonBodyTrait {

	private $body;

	public function setJsonBody( array $body ): self {
		$this->body = $body;
		return $this;
	}

	public function getJsonBody(): ?array {
		return $this->body ?? null;
	}

}
