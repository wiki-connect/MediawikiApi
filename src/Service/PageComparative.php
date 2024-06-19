<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;
use WikiConnect\MediawikiApi\DataModel\Page;

/**
 * @access private
 */
class PageComparative extends Service {

	public function comparePages( Page $from, Page $to, array $extraParams = [] ): array {
	    $params = [
	        'fromid' => $from->getPageIdentifier()->getId(),
	        'toid' => $to->getPageIdentifier()->getId()
	    ];
	    
		return $this->api->request( ActionRequest::simplePost(
			'compare',
			array_merge( $extraParams, $params )
		) );
	}

	public function compareRevisions( int $from, int $to, array $extraParams = [] ): array {
	    $params = [
	        'fromrev' => $from,
	        'torev' => $to,
	    ];
		
		return $this->api->request( ActionRequest::simplePost(
			'compare',
			array_merge( $extraParams, $params )
		) );
	}

}
