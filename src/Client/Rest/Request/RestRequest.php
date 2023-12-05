<?php

namespace WikiConnect\MediawikiApi\Client\Rest\Request;

use WikiConnect\MediawikiApi\Client\Request\StandardRequest;

class RestRequest extends StandardRequest implements HasJsonBody {

	use JsonBodyTrait;

}
