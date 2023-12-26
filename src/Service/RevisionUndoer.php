<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;
use WikiConnect\MediawikiApi\DataModel\EditInfo;
use WikiConnect\MediawikiApi\DataModel\Revision;

/**
 * @access private
 */
class RevisionUndoer extends Service {

	public function undo( Revision $revision , EditInfo $editInfo = null, $undoafter = null ): bool {
	    $params = $this->getParamsFromRevision( $revision );
	    if ( $undoafter != null ) {
	        $params['undoafter'] = $undoafter;
	    }
	    if ( $editInfo !== null ) {
			$params['summary'] = $editInfo->getSummary();
			if ( $editInfo->getMinor() ) {
				$params['minor'] = true;
			}
			if ( $editInfo->getBot() ) {
				$params['bot'] = true;
				$params['assert'] = 'bot';
			}
			if ( $editInfo->getMaxlag() ) {
				$params['maxlag'] = $editInfo->getMaxlag();
			}
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
