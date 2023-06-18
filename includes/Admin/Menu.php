<?php

namespace  LIILabPluginBoilerplate\Admin;

use LIILabPluginBoilerplate\Traits\Singleton;
use Kucrut\Vite;

/**
 * The Menu handler class
 */
class Menu
{
    use Singleton;

    /**
     * Initialize the class
     */
    function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
        add_filter('script_loader_tag', array($this, 'add_module_to_script'), 10, 3);
    }

    /**
     * Add module to script
     *
     * @param string $tag
     * @param string $handle
     * @param string $src
     * @return string
     */

    public function add_module_to_script($tag, $handle, $src)
    {
        if ($handle === 'liilab-plugin-boilerplate-admin') {
            $tag = '<script type="module" id="liilab-plugin-boilerplate-admin" src="' . esc_url($src) . '"></script>';
        }
        return $tag;
    }

    /**
     * Enqueue scripts and styles.
     *
     * @return void
     */
    public function admin_enqueue_scripts()
    {
        if (defined('LIILabPluginBoilerplate_DEVELOPMENT') && LIILabPluginBoilerplate_DEVELOPMENT === 'yes') {
            Vite\enqueue_asset(LIILabPluginBoilerplate_PATH . '/dist', 'src/admin/main.tsx', ['handle' => 'liilab-plugin-boilerplate-admin', 'in-footer' => true]);
        } else {

            wp_enqueue_style('liilab-plugin-boilerplate-admin', LIILabPluginBoilerplate_URL . '/dist/css/main.css', [], LIILabPluginBoilerplate_VERSION);
            wp_enqueue_script(
                'liilab-plugin-boilerplate-admin',
                LIILabPluginBoilerplate_URL . '/dist/js/admin.js',
                array('wp-element'),
                LIILabPluginBoilerplate_VERSION,
                true
            );
        }
        //Localize the script with new data
        $data = array(
            'home_url' => home_url(),
        );
        wp_localize_script('liilab-plugin-boilerplate-admin', 'userLocalize', $data);
    }

    /**
     * Register admin menu
     *
     * @return void
     */
    public function admin_menu()
    {
        $parent_slug = 'liilab-plugin-boilerplate';
        $capability = 'manage_options';

        add_menu_page(__('LIILab Plugin Boilerplate', 'liilab-plugin-boilerplate'), __('LIILab Plugin Boilerplate', 'liilab-plugin-boilerplate'), $capability, $parent_slug,  [$this, 'liilab_plugin_boilerplate'], 'dashicons-admin-post', '2.1');
        global $submenu;

        $submenu[$parent_slug]['dashboard'] = array(
            'Dashboard',
            'manage_options',
            'admin.php?page=liilab-plugin-boilerplate#/dashboard',
        );

        $submenu[$parent_slug]['contact'] = array(
            'Contact',
            'manage_options',
            'admin.php?page=liilab-plugin-boilerplate#/contact',
        );
    }

    /**
     * Render the main
     *
     * @return void
     */
    public function liilab_plugin_boilerplate()
    {
        echo '<div id="liilab-plugin-boilerplate"></div>';
    }
}
