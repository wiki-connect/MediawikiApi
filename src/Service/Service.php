<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\ActionApi;

/**
 * The base service functions that all services inherit.
 */
abstract class Service {

	protected ActionApi $api;

	/**
	 * @param ActionApi $api The API to in for this service.
	 */
	public function __construct( ActionApi $api ) {
		$this->api = $api;
	}

}
