<?php

/**
 * Class Home
 *
 * 
 * 
 * 
 *
 */
class Errors extends Controller
{
    /**
     * PAGE: 404
     * 
     */
    public function notFound()
    {
        // load views.
        require 'application/views/errors/404.php';
    }
}
