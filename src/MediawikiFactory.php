<?php

namespace WikiConnect\MediawikiApi;

use WikiConnect\MediawikiApi\Client\Action\ActionApi;
use WikiConnect\MediawikiApi\Service\CategoryTraverser;
use WikiConnect\MediawikiApi\Service\FileUploader;
use WikiConnect\MediawikiApi\Service\ImageRotator;
use WikiConnect\MediawikiApi\Service\LogListGetter;
use WikiConnect\MediawikiApi\Service\NamespaceGetter;
use WikiConnect\MediawikiApi\Service\PageDeleter;
use WikiConnect\MediawikiApi\Service\PageGetter;
use WikiConnect\MediawikiApi\Service\PageListGetter;
use WikiConnect\MediawikiApi\Service\PageMover;
use WikiConnect\MediawikiApi\Service\PageProtector;
use WikiConnect\MediawikiApi\Service\PagePurger;
use WikiConnect\MediawikiApi\Service\PageRestorer;
use WikiConnect\MediawikiApi\Service\PageWatcher;
use WikiConnect\MediawikiApi\Service\Parser;
use WikiConnect\MediawikiApi\Service\RevisionDeleter;
use WikiConnect\MediawikiApi\Service\RevisionPatroller;
use WikiConnect\MediawikiApi\Service\RevisionRestorer;
use WikiConnect\MediawikiApi\Service\RevisionRollbacker;
use WikiConnect\MediawikiApi\Service\RevisionSaver;
use WikiConnect\MediawikiApi\Service\RevisionUndoer;
use WikiConnect\MediawikiApi\Service\UserBlocker;
use WikiConnect\MediawikiApi\Service\UserCreator;
use WikiConnect\MediawikiApi\Service\UserGetter;
use WikiConnect\MediawikiApi\Service\UserRightsChanger;
use WikiConnect\MediawikiApi\Service\ImageInfo;
use WikiConnect\MediawikiApi\Service\ImageDeleter;
use WikiConnect\MediawikiApi\Service\PageComparative;
use WikiConnect\MediawikiApi\Service\Searcher;

/**
 * @access public
 */
class MediawikiFactory {

	private ActionApi $api;

	public function __construct( ActionApi $api ) {
		$this->api = $api;
	}

	/**
	 * Get a new CategoryTraverser object for this API.
	 */
	public function newCategoryTraverser(): CategoryTraverser {
		return new CategoryTraverser( $this->api );
	}

	public function newRevisionSaver(): RevisionSaver {
		return new RevisionSaver( $this->api );
	}

	public function newRevisionUndoer(): RevisionUndoer {
		return new RevisionUndoer( $this->api );
	}

	public function newPageGetter(): PageGetter {
		return new PageGetter( $this->api );
	}

	public function newUserGetter(): UserGetter {
		return new UserGetter( $this->api );
	}

	public function newPageDeleter(): PageDeleter {
		return new PageDeleter( $this->api );
	}

	public function newPageMover(): PageMover {
		return new PageMover( $this->api );
	}

	public function newPageListGetter(): PageListGetter {
		return new PageListGetter( $this->api );
	}

	public function newPageRestorer(): PageRestorer {
		return new PageRestorer( $this->api );
	}

	public function newPagePurger(): PagePurger {
		return new PagePurger( $this->api );
	}

	public function newRevisionRollbacker(): RevisionRollbacker {
		return new RevisionRollbacker( $this->api );
	}

	public function newRevisionPatroller(): RevisionPatroller {
		return new RevisionPatroller( $this->api );
	}

	public function newPageProtector(): PageProtector {
		return new PageProtector( $this->api );
	}

	public function newPageWatcher(): PageWatcher {
		return new PageWatcher( $this->api );
	}

	public function newRevisionDeleter(): RevisionDeleter {
		return new RevisionDeleter( $this->api );
	}

	public function newRevisionRestorer(): RevisionRestorer {
		return new RevisionRestorer( $this->api );
	}

	public function newUserBlocker(): UserBlocker {
		return new UserBlocker( $this->api );
	}

	public function newUserRightsChanger(): UserRightsChanger {
		return new UserRightsChanger( $this->api );
	}

	public function newUserCreator(): UserCreator {
		return new UserCreator( $this->api );
	}

	public function newLogListGetter(): LogListGetter {
		return new LogListGetter( $this->api );
	}

	public function newFileUploader(): FileUploader {
		return new FileUploader( $this->api );
	}

	public function newImageRotator(): ImageRotator {
		return new ImageRotator( $this->api );
	}

	public function newParser(): Parser {
		return new Parser( $this->api );
	}

	public function newNamespaceGetter(): NamespaceGetter {
		return new NamespaceGetter( $this->api );
	}
	public function newImageInfo(): ImageInfo {
		return new ImageInfo( $this->api );
	}
	
	public function newImageDeleter(): ImageDeleter {
		return new ImageDeleter( $this->api );
	}
	public function newPageComparative(): PageComparative {
		return new PageComparative( $this->api );
	}
	public function newSearcher(): Searcher {
		return new Searcher( $this->api );
	}
}
