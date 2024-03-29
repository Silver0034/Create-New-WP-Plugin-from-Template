<?php

/**
 * The plugin loader for actions and filters
 * 
 * @since 1.0.0
 * @version 1.0.0
 */

// define namespace
namespace <%= template.namespace %>;

// Security: Prevent direct access to this file
defined('ABSPATH') || die();

/**
 * The loader class
 * 
 * @since 1.0.0
 * @version 1.0.0
 */
class Loader
{
    protected $actions;
    protected $filters;
    protected static $instance = NULL;

    /**
     * Get the existing instance of the class
     * 
     * @since 1.0.0
     * @version 1.0.0
     * @return <%= template.namespace %>\Loader
     */
    public static function get_instance()
    {
        // create an object
        if (NULL === self::$instance) {
            self::$instance = new self;
        }

        // return the instance of the class
        return self::$instance;
    }

    /**
     * Create arrays for actions and filters
     * 
     * @since 1.0.0
     * @version 1.0.0
     */
    public function __construct()
    {
        $this->actions = [];
        $this->filters = [];
    }

    /**
     * add action to collection
     * 
     * @since 1.0.0
     * @version 1.0.0
     * @param string $hook The hook to attach to
     * @param object $component The class object that contains the callback function
     * @param string $callback The name of the callback function to run
     * @param int $priority Control when to run the callback
     * @param int $accepted_args The number of accepted arguments
     * @return void 
     */
    public function add_action($hook, $component, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * add filters to collection
     * 
     * @since 1.0.0
     * @version 1.0.0
     * @param string $hook The filter to attach to
     * @param object $component The class object that contains the callback function
     * @param string $callback The name of the callback function to run
     * @param int $priority Control when to run the callback
     * @param int $accepted_args The number of accepted arguments
     * @return void 
     */
    public function add_filter($hook, $component, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * the add function
     * 
     * @since 1.0.0
     * @version 1.0.0
     * @param array $hooks Existing hooks to add to
     * @param $hook New hook to add to $hooks
     * @param object $component The class object that contains the callback function
     * @param string $callback The name of the callback function to run
     * @param int $priority Control when to run the callback
     * @param int $accepted_args The number of accepted arguments
     * @return array $hooks Modified array of hooks 
     */
    private function add($hooks, $hook, $component, $callback, $priority, $accepted_args)
    {
        $hooks[] = [
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'accepted_args' => $accepted_args
        ];
        return $hooks;
    }

    /**
     * register the filters and actions
     * 
     * @since 1.0.0
     * @version 1.0.0
     * @return void
     */
    public function run()
    {
        // add filters
        foreach ($this->filters as $hook) {
            add_filter(
                $hook['hook'],
                [$hook['component'], $hook['callback']],
                $hook['priority'],
                $hook['accepted_args']
            );
        }

        // add hooks
        foreach ($this->actions as $hook) {
            add_action(
                $hook['hook'],
                [$hook['component'], $hook['callback']],
                $hook['priority'],
                $hook['accepted_args']
            );
        }
    }
}
