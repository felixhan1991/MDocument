<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


require_once APPPATH.'/libraries/iObserver.php';

interface iSubject
{
    function attach(iObserver $observer_in);
    function detach(iObserver $observer_in);

    function notify();
    
}

?>
