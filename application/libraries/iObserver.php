<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once APPPATH.'/libraries/iSubject.php';

interface iObserver
{
    function update(iSubject $subject_in);
}

?>
