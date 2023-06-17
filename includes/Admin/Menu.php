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
    }

    /**
     * Enqueue scripts and styles.
     *
     * @return void
     */
    public function admin_enqueue_scripts()
    {
        Vite\enqueue_asset( LIILabPluginBoilerplate_PATH . '/dist', 'src/admin/main.tsx',['handle' => 'vite-for-wp-react','in-footer' => true]);

        // wp_enqueue_style('liilab-plugin-boilerplate-admin-css', LIILabPluginBoilerplate_URL . '/dist/assets/main-2f422850.css', [], LIILabPluginBoilerplate_VERSION);
        // wp_enqueue_script('liilab-plugin-boilerplate-admin-js', LIILabPluginBoilerplate_URL . '/dist/assets/main-273f4d52.js', [], LIILabPluginBoilerplate_VERSION , true);
       
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

        // echo '<pre>';

        // var_dump($submenu);

        // echo '</pre>';
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
