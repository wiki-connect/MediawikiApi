<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\Exception\UsageException;
use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;
use WikiConnect\MediawikiApi\DataModel\File;

/**
 * @access private
 */
class ImageRotator extends Service {

	/**
	 * NOTE: This service has not been fully tested
	 *
	 * @param int $rotation Degrees to rotate image clockwise, One value: 90, 180, 270
	 * @throws UsageException
	 */
	public function rotate( File $file, int $rotation ): bool {
		$params = [
			'rotation' => $rotation,
			'token' => $this->api->getToken(),
		];

		if ( $file->getPageIdentifier()->getTitle() !== null ) {
			$params['titles'] = $file->getPageIdentifier()->getTitle()->getText();
		} else {
			$params['pageids'] = $file->getPageIdentifier()->getId();
		}

		$result = $this->api->request( ActionRequest::simplePost( 'imagerotate', $params ) );

		// This module sometimes gives odd errors so deal with them..
		if ( array_key_exists( 'imagerotate', $result ) ) {
			$imageRotate = array_pop( $result['imagerotate'] );
			if ( array_key_exists( 'result', $imageRotate ) &&
				$imageRotate['result'] == 'Failure'
			) {
				throw new UsageException(
					'imagerotate-Failure',
					$imageRotate['errormessage'],
					$result
				);
			}
		}

		return true;
	}

}
