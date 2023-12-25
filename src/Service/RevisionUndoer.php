<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;
use WikiConnect\MediawikiApi\DataModel\Revision;

/**
 * @access private
 */
class RevisionUndoer extends Service {

	public function undo( Revision $revision , $undoafter = null ): bool {
	    $params = $this->getParamsFromRevision( $revision );
	    if ( $undoafter != null ) {
	        $params['undoafter'] = $undoafter;
	    }
		$this->api->request( ActionRequest::simplePost(
			'edit',
			$params
		) );
		return true;
	}
	
	/**
	 *
	 * @return array <string int|string|null>
	 */
	private function getParamsFromRevision( Revision $revision ): array {
		$params = [
			'undo' => $revision->getId(),
			'token' => $this->api->getToken(),
		];

		if ( $revision->getPageIdentifier()->getId() !== null ) {
			$params['pageid'] = $revision->getPageIdentifier()->getId();
		} else {
			$params['title'] = $revision->getPageIdentifier()->getTitle()->getTitle();
		}

		return $params;
	}

}
