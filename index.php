<?php

include('app/init.php');

$template->set_data('header','hello');
$template->set_alert('alert!');
$template->load('app/views/v_public_home.php', 'Welcome!');

 ?>

