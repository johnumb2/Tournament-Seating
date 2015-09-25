<?php

class HomeController extends Controller 
{
 
    function home(){
        $this->set('title', 'Tournament Seating');
    }
}