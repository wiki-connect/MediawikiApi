<?php

namespace WikiConnect\MediawikiApi\Client\Request;

/**
 * A generic request.
 * All API implementations should expect to take one of these.
 */
interface Request extends HasHeaders, HasMethod, HasPath, HasParameters, HasMultipartAbility {

}
