<?php

namespace LIILabPluginBoilerplate;
use LIILabPluginBoilerplate\Traits\Singleton;

/**
 * The admin class
 */
class Admin {
    
    use Singleton;

    /**
     * Initialize the class
     */
    function __construct() {
        new Admin\Menu();
    }
}
