<?php

/**
 * Plugin Name:       LIILab Plugin Boilerplate
 * Description:       A plugin to demonstrate Vite for LIILab Plugin Boilerplate
 * Requires at least: 6.2
 * Requires PHP:      7.0
 * Version:           1.0
 * Author:            LII Lab
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       liilab-plugin-boilerplate
 */


if (!defined('ABSPATH')) {
    exit;
}

/**
 * The main plugin class
 */
final class LIILabPluginBoilerplate
{

    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0';

    /**
     * Class construcotr
     */
    private function __construct()
    {
        require_once __DIR__ . '/vendor/autoload.php';
        
        $this->define_constants();

        register_activation_hook(__FILE__, [$this, 'activate']);

        add_action('plugins_loaded', [$this, 'init_plugin']);
    }


    /**
     * Initializes a singleton instance
     *
     * @return \LIILabPluginBoilerplate
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants()
    {
        define('LIILabPluginBoilerplate_VERSION', self::version);
        define('LIILabPluginBoilerplate_FILE', __FILE__);
        define('LIILabPluginBoilerplate_PATH', __DIR__);
        define('LIILabPluginBoilerplate_URL', plugins_url('', LIILabPluginBoilerplate_FILE));
        define('LIILabPluginBoilerplate_ASSETS', LIILabPluginBoilerplate_URL . '/assets');
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin()
    {

        if (is_admin()) {
            new LIILabPluginBoilerplate\Admin();
        }
        else {
            new LIILabPluginBoilerplate\User();
        }
    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate()
    {
        $installer = new LIILabPluginBoilerplate\Installer();
        $installer->run();
    }
}

/**
 * Initializes the main plugin
 *
 * @return \LIILabPluginBoilerplate
 */
function LIILabPluginBoilerplate()
{
    return LIILabPluginBoilerplate::init();
}

// kick-off the plugin
LIILabPluginBoilerplate();
