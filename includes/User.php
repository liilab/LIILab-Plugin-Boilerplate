<?php

namespace LIILabPluginBoilerplate;
use LIILabPluginBoilerplate\Traits\Singleton;
use LIILabPluginBoilerplate\User\Shortcode, LIILabPluginBoilerplate\User\API;

/**
 * The User class
 */
class User {
    
    use Singleton;

    /**
     * Initialize the class
     */
    function __construct() {
        new Shortcode();
        new API();
    }
}
