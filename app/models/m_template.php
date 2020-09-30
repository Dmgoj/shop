<?php

/*
    Template Class
    Handle all templating tasks - displaying views, alerts, errors and view data
*/

class Template
{
    function __construct(){}

    /**
     * Load specified url
     * 
     * @access public
     * @param string
     * @return null
     */

    public function load($url)
    {
        include($url);
    }

      /**
     * Redirects to specified url
     * 
     * @access public
     * @param string
     * @return null
     */
    public function redirect($url)
    {
        header("Loaction: $url");
        exit;
    }
}