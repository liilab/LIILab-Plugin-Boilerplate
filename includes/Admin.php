<?php

namespace LIILabPluginBoilerplate;
use LIILabPluginBoilerplate\Traits\Singleton;
use LIILabPluginBoilerplate\Admin\Menu, LIILabPluginBoilerplate\Admin\API;

/**
 * The admin class
 */
class Admin {
    
    use Singleton;

    /**
     * Initialize the class
     */
    function __construct() {
        new Menu();
    }
}
