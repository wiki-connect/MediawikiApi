<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;
use WikiConnect\MediawikiApi\DataModel\User;
use InvalidArgumentException;

/**
 * @access private
 */
class UserBlocker extends Service {

	/**
	 * @param User|string $user
	 *
	 * @throws InvalidArgumentException
	 */
	public function block( $user, array $extraParams = [] ): bool {
		if ( !$user instanceof User && !is_string( $user ) ) {
			throw new InvalidArgumentException( '$user must be either a string or User object' );
		}

		if ( $user instanceof User ) {
			$user = $user->getName();
		}

		$params = [
			'user' => $user,
			'token' => $this->api->getToken( 'block' ),
		];

		$params = array_merge( $extraParams, $params );

		$this->api->request( ActionRequest::simplePost( 'block', $params ) );
		return true;
	}

}
