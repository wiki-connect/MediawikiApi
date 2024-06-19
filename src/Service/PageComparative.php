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
	    
	    
		$this->api->request( ActionRequest::simplePost(
			'compare',
			array_merge( $extraParams, $params )
		) );
		
		return true;
	}

	public function compareRevisions( int $from, int $to, array $extraParams = [] ): bool {
	    $params = [
	        'fromrev' => $from,
	        'torev' => $to,
	    ];
		
		$this->api->request( ActionRequest::simplePost(
			'compare',
			array_merge( $extraParams, $params )
		) );
		return true;
	}

}
