<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;
use WikiConnect\MediawikiApi\DataModel\Revision;

/**
 * @access private
 */
class RevisionRestorer extends Service {

	public function restore( Revision $revision ): bool {
		$params = [
			'type' => 'revision',
			'show' => 'content',
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
