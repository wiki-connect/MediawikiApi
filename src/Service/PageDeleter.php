<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;
use WikiConnect\MediawikiApi\DataModel\Page;
use WikiConnect\MediawikiApi\DataModel\PageIdentifier;
use WikiConnect\MediawikiApi\DataModel\Revision;
use WikiConnect\MediawikiApi\DataModel\Title;

/**
 * @access private
 */
class PageDeleter extends Service {

	public function delete( Page $page, array $extraParams = [] ): bool {
		$this->api->request( ActionRequest::simplePost(
			'delete',
			$this->getDeleteParams( $page->getPageIdentifier(), $extraParams )
		) );
		return true;
	}

	public function deleteFromRevision( Revision $revision, array $extraParams = [] ): bool {
		$this->api->request( ActionRequest::simplePost(
			'delete',
			$this->getDeleteParams( $revision->getPageIdentifier(), $extraParams )
		) );
		return true;
	}

	public function deleteFromPageId( int $pageid, array $extraParams = [] ): bool {
		$this->api->request( ActionRequest::simplePost(
			'delete',
			$this->getDeleteParams( new PageIdentifier( null, $pageid ), $extraParams )
		) );
		return true;
	}

	/**
	 * @param Title|string $title
	 */
	public function deleteFromPageTitle( $title, array $extraParams = [] ): bool {
		if ( is_string( $title ) ) {
			$title = new Title( $title );
		}
		$this->api->request( ActionRequest::simplePost(
			'delete',
			$this->getDeleteParams( new PageIdentifier( $title ), $extraParams )
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
