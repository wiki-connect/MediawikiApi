<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;
use WikiConnect\MediawikiApi\DataModel\Page;

/**
 * @access private
 */
class PageComparative extends Service {

	public function comparePages( Page $from, Page $to, array $extraParams = [] ): bool {
	    $params[
	        'fromid' => $from->getPageIdentifier()->getId(),
	        'toid' => $to->getPageIdentifier()->getId()
	    ];
	    
	    array_merge( $extraParams, $params );
	    
		$this->api->request( ActionRequest::simplePost(
			'compare',
			$params
		) );
		
		return true;
	}

	public function compareRevisions( int $from, int $to, array $extraParams = [] ): bool {
	    $params = [
	        'fromrev' => $from,
	        'torev' => $to,
	    ];
		array_merge( $extraParams, $params );
		
		$this->api->request( ActionRequest::simplePost(
			'compare',
			$params
		) );
		return true;
	}

}
