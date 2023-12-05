<?php

namespace WikiConnect\MediawikiApi\Client\Rest\Request;

interface HasJsonBody {

	public function setJsonBody( array $body ): self;

	public function getJsonBody(): ?array;

}
