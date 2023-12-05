<?php

namespace WikiConnect\MediawikiApi\Client\Auth;

use WikiConnect\MediawikiApi\Client\Action\ActionApi;
use WikiConnect\MediawikiApi\Client\Action\Tokens;
use WikiConnect\MediawikiApi\Client\Action\Exception\UsageException;
use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;
use WikiConnect\MediawikiApi\Client\Request\Request;
use WikiConnect\MediawikiApi\Client\Request\Requester;
use InvalidArgumentException;

/**
 * For use with plain MediaWiki logins
 */
class UserAndPassword implements AuthMethod {

	private string $password;
	private string $username;
	public bool $isLoggedIn = false;

	public function __construct( string $username, string $password ) {
		if ( empty( $username ) || empty( $password ) ) {
			throw new InvalidArgumentException( 'Username and Password are not allowed to be empty' );
		}
		$this->username = $username;
		$this->password = $password;
	}

	public function getUsername(): string {
		return $this->username;
	}

	public function getPassword(): string {
		return $this->password;
	}

	public function equals( UserAndPassword $other ): bool {
		return $this->getUsername() === $other->getUsername()
			&& $this->getPassword() === $other->getPassword();
	}

	public function preRequestAuth( Request $request, Requester $requester ): Request {
		if ( !$requester instanceof ActionApi ) {
			// TODO remove / alter this when doing REST
			die( 'Only works with ActionApi for now' );
		}

		// Do nothing if we are already logged in
		if ( $this->isLoggedIn ) {
			// Verify that the user is logged in if set to user, not logged in if set to anon, or has the bot user right if bot.
			$request->setParam( 'assert', 'user' );
			return $request;
		}

		// Do not try to login if thi is a self call (we are logging in)
		$paramsRequest = $request->getParams();
        if (($paramsRequest['action'] ?? null) === 'login' || ($paramsRequest['type'] ?? null) === 'login') {
            return $request;
        }

		if ( (array_key_exists( 'action', $request->getParams() ) && $request->getParams()['action'] === 'login') || (array_key_exists( 'type', $request->getParams() ) && $request->getParams()['type'] === 'login') ) {
			return $request;
		}

		$loginParams = [
			'lgname' => $this->getUsername(),
			'lgpassword' => $this->getPassword(),
		];

		$token = new Tokens($requester);
		$lgtoken = $token->get('login');
		$params = array_merge( [ 'lgtoken' => $lgtoken ], $loginParams );
	    $result = $requester->request( ActionRequest::simplePost( 'login', $params ) );
		
		// Check for success
		if ( $result['login']['result'] == 'Success' ) {
			$this->isLoggedIn = true;
			return $request;
		}

		$this->isLoggedIn = false;

		$this->throwLoginUsageException( $result );

		return $request;
	}
	public function logout( Requester $requester ): void {
	    $token = new Tokens($requester);
		$csrftoken = $token->get('csrf');
		$this->isLoggedIn = false;
		$requester->request( ActionRequest::simplePost( 'logout', ['token' => $csrftoken] ) );
	}
    
	protected function additionalParamsForPreRequestAuthCall(): array {
		return [];
	}

	/**
	 * @throws UsageException
	 */
	private function throwLoginUsageException( array $result ): void {
		$loginResult = $result['login']['result'];

		// TODO use an Auth exception instead? (to make it easier to catch etc?)
		throw new UsageException(
			'login-' . $loginResult,
			array_key_exists( 'reason', $result['login'] )
				? $result['login']['reason']
				: 'No Reason given',
			$result
		);
	}

	public function identifierForUserAgent(): ?string {
		return 'user/' . $this->getUsername();
	}

}
