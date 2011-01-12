<?php
/*
 * This is Example1 controller, here we will be checking input parameters coming from $_GET and $_POST
 * and invoking methods from our model (class.example1.php)
 *
 * Model instance is available under $module variable
 * To access smarty instance we will use $module->smarty 
 */


if(isset($_POST['test'])) {
    //some test form has been submitted, lets handle it somehow

    //...

    //
}

/*
 * In example model we've declared method called databaseExample() - now lets invoke it
 * and assign its returned value to template under example_var variable
 */

 $module->template->assign('example_var',$module->databaseExample());

?>