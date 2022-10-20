<?php
if ( ! function_exists( "add_filter" ) ) {
    /**
     * @param $filter_name
     * @param callable $func
     * @param int $priority
     * @param int $lengthOfParam
     */
    function add_filter($filter_name, $func, $priority = 10, $lengthOfParam = 1)
    {
        AddOnManager::AddFilter($filter_name, $func, $priority, $lengthOfParam);
    }
}
if ( ! function_exists( "add_action" ) ) {
    /**
     * @param $action_name
     * @param callable $func
     * @param int $priority
     * @param int $lengthOfParam
     */
    function add_action($action_name, $func, $priority=10, $lengthOfParam=1)
    {
        AddOnManager::AddAction($action_name, $func, $priority, $lengthOfParam);
    }
}
if ( ! function_exists( "apply_filter" ) ) {
    /**
     * @param string $filter_name
     * @param mixed ...$args
     */
    function apply_filter($filter_name,...$args)
    {
        $args = func_get_args();
        return call_user_func_array("AddOnManager::DoFilter", $args);
    }
}
if ( ! function_exists( "do_action" ) ) {
    /**
     * @param string $action_name
     * @param mixed ...$args
     */
    function do_action($action_name,...$args)
    {
        $args = func_get_args();
        call_user_func_array("AddOnManager::DoAction", $args);
    }
}
