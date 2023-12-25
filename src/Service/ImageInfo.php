<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;

/**
 * @access private
 */
class ImageInfo extends Service {

	public function get( string | array $filename, array $extraParams = [] ): array {
	    $params = $extraParams;
        if (is_string($filename)) {
            $params['titles'] = 'File:' . $filename;
        } elseif (is_array($filename)) {
            $params['titles'] = '';
            foreach ($filename as $key => $file) {
                if ($key === key(array_slice($filename, -1))) {
                    $params['titles'] = 'File:' . $file . $params['titles'];
                } else {
                    $params['titles'] = 'File:' . $file . '|' . $params['titles'];
                }
	        }
        }
	    $params['prop'] = 'imageinfo';
		$result =
			$this->api->request(
				ActionRequest::simpleGet(
					'query',
					$params
				)
			);
	    return $result['query']['pages'];
	}       
}
