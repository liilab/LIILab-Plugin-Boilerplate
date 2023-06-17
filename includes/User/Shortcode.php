<?php

namespace LIILabPluginBoilerplate\User;

use LIILabPluginBoilerplate\Traits\Singleton;
use Kucrut\Vite;

/**
 * Shortcode class
 */

class Shortcode
{

    use Singleton;

    /**
     * Initialize the class
     */
    function __construct()
    {
        add_shortcode('liilab_current_user_info', [$this, 'liilab_current_user_info_callback']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }


    /**
     * Enqueue scripts and styles.
     *
     * @return void
     */
    public function enqueue_scripts()
    {
        Vite\enqueue_asset(LIILabPluginBoilerplate_PATH . '/dist', 'src/user/main.tsx', ['handle' => 'liilab-user', 'in-footer' => true]);

        // Define the data you want to pass to the script
        $data = array(
            'home_url' => home_url(),
        );

        // Localize the script with the data
        wp_localize_script('liilab-user', 'userLocalize', $data);


        // wp_enqueue_style('liilab-plugin-boilerplate-user-css', LIILabPluginBoilerplate_URL . '/dist/index.css', [], LIILabPluginBoilerplate_VERSION);
        // wp_enqueue_script('liilab-plugin-boilerplate-user-js', LIILabPluginBoilerplate_URL . '/dist/user.js', ['jquey], LIILabPluginBoilerplate_VERSION , true);
    }


    /**
     * Current user info shortcode callback
     *
     * @return void
     */


    public function liilab_current_user_info_callback($atts)
    {
        $atts = shortcode_atts(array(
            'id' => '0',
        ), $atts, 'liilab_current_user_info');

        $atts = htmlspecialchars(json_encode($atts));

        return '<div id="liilab_current_user_info" liilab_current_user_info="' . $atts . '"></div>';
    }
}
