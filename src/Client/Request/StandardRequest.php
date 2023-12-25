<?php

namespace WikiConnect\MediawikiApi\Client\Request;

abstract class StandardRequest implements Request, HasSimpleFactory {

	use SimpleFactoryTrait;

	use PathTrait;
	use MethodTrait;
	use HeadersTrait;
	use ParametersTrait;
	use MultipartTrait;

}
