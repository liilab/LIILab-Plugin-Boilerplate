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
        if ($handle === 'liilab-plugin-boilerplate-user') {
            $tag = '<script type="module" id="liilab-plugin-boilerplate-user" src="' . esc_url($src) . '"></script>';
        }
        return $tag;
    }


    /**
     * Enqueue scripts and styles.
     *
     * @return void
     */
    public function enqueue_scripts()
    {
        if (defined('LIILabPluginBoilerplate_DEVELOPMENT') && LIILabPluginBoilerplate_DEVELOPMENT === 'yes') {
            Vite\enqueue_asset(LIILabPluginBoilerplate_PATH . '/dist', 'src/user/main.tsx', ['handle' => 'liilab-plugin-boilerplate-user', 'in-footer' => true]);
        } else {

            wp_enqueue_style('liilab-plugin-boilerplate-user', LIILabPluginBoilerplate_URL . '/dist/css/main.css', [], LIILabPluginBoilerplate_VERSION);
            wp_enqueue_script('liilab-plugin-boilerplate-user', LIILabPluginBoilerplate_URL . '/dist/js/user.js', ['jquery'], LIILabPluginBoilerplate_VERSION, true);
        }

        //Localize the script with new data
        $data = array(
            'home_url' => home_url(),
        );
        wp_localize_script('liilab-plugin-boilerplate-user', 'userLocalize', $data);
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
