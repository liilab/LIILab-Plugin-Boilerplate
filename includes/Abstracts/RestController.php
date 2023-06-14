<?php

namespace LIILabPluginBoilerplate\Abstracts;
use WP_REST_Controller;

/**
 * Class RestController
 * @package LIILabPluginBoilerplate\Abstract
 */

abstract class RestController extends WP_REST_Controller
{
    /**
     * Endpoint namespace.
     *
     * @var string
     */
    protected $namespace = 'liilab-plugin-boilerplate/v1';

    /**
     * Route base.
     *
     * @var string
     */
    protected $rest_base = '';

}