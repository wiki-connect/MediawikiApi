<?php

namespace WikiConnect\MediawikiApi\Service;

use WikiConnect\MediawikiApi\Client\Action\Request\ActionRequest;
use WikiConnect\MediawikiApi\DataModel\Page;
use WikiConnect\MediawikiApi\DataModel\PageIdentifier;
use WikiConnect\MediawikiApi\DataModel\Pages;
use WikiConnect\MediawikiApi\DataModel\Title;

/**
 * @access private
 */
class Searcher extends Service {
    /**
     * Retrieves a list of pages that match the given search criteria.
     *
     * @link https://www.mediawiki.org/wiki/API:Search
     *
     * @param string $search The text to search for.
     * @param array $extraParams Additional parameters to include in the request.
     *
     * @return Pages A collection of pages that match the search criteria.
     */
    public function getListPages(string $search, array $extraParams = []  ) : Pages {
        // Initialize the collection to hold the search results.
        $pages = new Pages();

        // Set up the basic parameters for the request.
        $params = array_merge([
            'list' => 'search', // Specify the action to perform.
            'srsearch' => $search, // Specify the text to search for.
        ], $extraParams);

        // Initialize a variable to keep track of the current page ID.
        $negativeId = -1;

        // Loop until there are no more pages to retrieve.
        do {
            // Make the request to the API.
            $result = $this->api->request(ActionRequest::simpleGet('query', $params));

            // Output the total number of search results.
            echo $result['query']['searchinfo']['totalhits'] . "\n";

            // If the response doesn't contain a 'query' element, break the loop.
            if (!isset($result['query'])) {
                break;
            }

            // Retrieve the search results from the response.
            $searchResults = $result['query']['search'] ?? [];

            // Loop through each search result and create a new Page object.
            foreach ($searchResults as $member) {
                // Assign a negative page ID if the page doesn't exist.
                $pageId = $member['pageid'] ?? $negativeId;
                $negativeId--;

                // Create a new Page object with the page title and ID.
                $pageTitle = new Title($member['title'], $member['ns'] ?? 0);
                $pageIdentifier = new PageIdentifier($pageTitle, $pageId);
                $page = new Page($pageIdentifier);

                // Add the page to the collection.
                $pages->addPage($page);
            }

            // If the response contains a 'continue' element, update the parameters
            // with the new offset and continue the loop. Otherwise, break the loop.
            if (isset($result['continue']['sroffset'])) {
                $params['sroffset'] = $result['continue']['sroffset'];
            } else {
                break;
            }
        } while (true);

        // Return the collection of pages that match the search criteria.
        return $pages;
    }

}
