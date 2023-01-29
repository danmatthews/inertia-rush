<?php

namespace App;

use Attribute;

#[Attribute]
class HttpVerb {

    function __construct(public string $verb = 'POST') {
        
    }
}
