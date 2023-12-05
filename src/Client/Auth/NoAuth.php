<?php

namespace WikiConnect\MediawikiApi\Client\Auth;

use WikiConnect\MediawikiApi\Client\Request\Request;
use WikiConnect\MediawikiApi\Client\Request\Requester;

/**
 * For use with plain MediaWiki and no authentication (anon)
 */
class NoAuth implements AuthMethod {
    public bool $isLoggedIn = false;
	public function preRequestAuth( Request $request, Requester $requester ): Request {
		// Verify that the user is logged in if set to user, not logged in if set to anon, or has the bot user right if bot.
		$request->setParam( 'assert', 'anon' );
		return $request;
	}

	public function identifierForUserAgent(): ?string {
		return null;
	}
	
}
