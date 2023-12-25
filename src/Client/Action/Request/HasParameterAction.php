<?php

namespace WikiConnect\MediawikiApi\Client\Action\Request;

interface HasParameterAction {

	public function setAction( string $action ): self;

}
