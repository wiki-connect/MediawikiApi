<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;
use WikiConnect\MediawikiApi\DataModel\Page;
use WikiConnect\MediawikiApi\DataModel\Title;

/**
 * @access private
 */
class PageMover extends Service {

	public function move( Page $page, Title $target, array $extraParams = [] ): bool {
		$this->api->request(
			ActionRequest::simplePost(
				'move', $this->getMoveParams( $page->getId(), $target, $extraParams )
			)
		);

		return true;
	}

	public function moveFromPageId( int $pageid, Title $target, array $extraParams = [] ): bool {
		$this->api->request(
			ActionRequest::simplePost( 'move', $this->getMoveParams( $pageid, $target, $extraParams ) )
		);

		return true;
	}

	/**
	 * @return mixed[]
	 */
	private function getMoveParams( int $pageid, Title $target, array $extraParams ): array {
		$params = [];
		$params['fromid'] = $pageid;
		$params['to'] = $target->getTitle();
		$params['token'] = $this->api->getToken( 'move' );

		return array_merge( $extraParams, $params );
	}

}
