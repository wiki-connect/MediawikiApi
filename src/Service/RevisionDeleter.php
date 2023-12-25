<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;
use WikiConnect\MediawikiApi\DataModel\Revision;

/**
 * @access private
 */
class RevisionDeleter extends Service {

	public function delete( Revision $revision ): bool {
		$params = [
			'type' => 'revision',
			'hide' => 'content',
			// Note: pre 1.24 this is a delete token, post it is csrf
			'token' => $this->api->getToken( 'delete' ),
			'ids' => $revision->getId(),
		];

		$this->api->request( ActionRequest::simplePost(
			'revisiondelete',
			$params
		) );

		return true;
	}

}
