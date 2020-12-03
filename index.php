<?php

include('app/init.php');

echo "<pre>";
print_r($products->get(1));
echo"</pre>";
exit;
// get category nav
/*$category_nav= $categories->create_category_nav('home');
$template->set_data('page_nav',$category_nav);


$template->load('app/views/v_public_home.php', 'Welcome!');*/
 ?>

