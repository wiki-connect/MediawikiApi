<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;
use WikiConnect\MediawikiApi\DataModel\Revision;

/**
 * @access private
 */
class RevisionPatroller extends Service {

	public function patrol( Revision $revision ): bool {
		$this->api->request( ActionRequest::simplePost(
			'patrol', [
				'revid' => $revision->getId(),
				'token' => $this->getTokenForRevision( $revision ),
			] ) );
		return true;
	}

	private function getTokenForRevision( Revision $revision ): string {
		$result = $this->api->request( ActionRequest::simplePost( 'query', [
			'list' => 'recentchanges',
			'rcstart' => $revision->getTimestamp(),
			'rcend' => $revision->getTimestamp(),
			'rctoken' => 'patrol',
		] ) );
		$result = array_shift( $result['query']['recentchanges'] );
		return $result['patroltoken'];
	}

}
