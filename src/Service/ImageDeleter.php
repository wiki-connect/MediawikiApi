<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;

/**
 * @access private
 */
class ImageDeleter extends Service {

	public function delete( string $name, array $extraParams = [] ): bool {
	    $params = [
	        'title' => $name,
	        'token' => $this->api->getToken( 'delete' )
	    ];
		$this->api->request( ActionRequest::simplePost(
			'delete',
			$params
		) );
		return true;
	}

	public function deleteOld( string $name, string $archivename, array $extraParams = [] ): bool {
	    $params = [
	        'title' => $name,
	        'oldimage' => $archivename,
	        'token' => $this->api->getToken( 'delete' )
	    ];
		$this->api->request( ActionRequest::simplePost(
			'delete',
			$params
		) );
		return true;
	}
	
	/**
	 * @return mixed[]
	 */
	private function getDeleteParams( PageIdentifier $identifier, array $extraParams ): array {
		$params = [];

		if ( $identifier->getId() !== null ) {
			$params['pageid'] = $identifier->getId();
		} else {
			$params['title'] = $identifier->getTitle()->getTitle();
		}

		$params['token'] = $this->api->getToken( 'delete' );

		return array_merge( $extraParams, $params );
	}
}
