<?php

/**
 * The plugin loader for actions and filters
 * 
 * @since 1.0.0
 */

// Security: Prevent direct access to this file
defined('ABSPATH') || die();

/**
 * The loader class
 * 
 * @since 1.0.0
 */
class <%= template.class %>_Loader
{
    protected $actions;
    protected $filters;

    /**
     * Create arrays for actions and filters
     * 
     * @since 1.0.0
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
     */
    public function add_action($hook, $component, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * add filters to collection
     * 
     * @since 
     */
    public function add_filter($hook, $component, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * the add function
     * 
     * @since 1.0.0
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
