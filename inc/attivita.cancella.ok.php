<?php

/*
 * ©2013 Croce Rossa Italiana
 */

$a = new Attivita($_GET['id']);
paginaAttivita($a);

$a->cancella();

redirect('attivita');