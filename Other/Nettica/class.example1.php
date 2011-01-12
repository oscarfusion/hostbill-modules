<?php
/* 
 This is example addon module for HostBill.
 http://wiki.hostbillapp.com/index.php?title=Custom_Modules
 In order to make it work place it under includes/modules/Other directory, and activate from adminarea.
 *
 *
 *
 Example1 : basic concepts, db access, error/info handling
 Description: This particular module is to show basic concepts of module that is available from adminarea,
 have template and fetch some data directly from database.
 *
 *
 */
class Example1 extends OtherModule {


    /*
     * protected $info
     * This is main addon set-up for developers.
     * For full modules possibilites visit: http://wiki.hostbillapp.com/index.php?title=Custom_Modules
     * In this example we will add template for admin, and display link to it in Extras menu in HostBill
     */
    protected $info = array(
       'haveadmin'=>true,
       'havetpl'=>true,
       'extras_menu'=>true
    );

    /*
     * const NAME
     * Note: This needs to reflect class name - case sensitive.
     */
    const NAME = 'Example1';

    /*
     * const VER
     * Insert your module version here
     */
    const VER ='1.0';

    /*
     * protected $filename
     * This needs to reflect actual filename of module - case sensitive.
     */
    protected $filename='class.example1.php';

    /*
     * protected $description
     * If you want, you can add description to module, so its potential users will know what its for.
     */
    protected $description='If you want, you can add description to module, so its potential users will know what its for.
This module have some basic template for admin to see, it also place itself automatically inder Extra menu';

    /*
     * protected $modname
     * AKA. "Nice name" - you can additionally add this variable - its contents will be displayed as module name after activation
     */
    protected $modname = 'HostBill Example Addon #1';



    //EOF: Module configuration

    /*
     * We will be invoking this method from module controller, and assigning its return value to template to be displayed in adminarea.
     * In this example we will get list of 10 last invoices directly from HostBill database
     *
     * We're accessing global database instance from inherited from OtherModule $db variable
     *
     * Note: HostBill uses PDO, and on servers that dont have PDO installed its using our custom class that share same api methods as PDO
     * Remember that our custom class have limited possibilities, so methods as PDO::beginTransaction() od PDO::commit() wont work as expected.
     *
     * For more informations about PDO visit: http://php.net/manual/en/book.pdo.php
     *
     *
     */
    public function databaseExample() {

        //lets call demo methods
        $this->infoDemo();
        $this->errorDemo();

        //creating pdo statement
        $query = $q=$this->db->prepare("SELECT * FROM hb_invoices ORDER BY date DESC LIMIT 10");

        //executing prepared statement
        $query->execute();

        //fetching returned data
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        //closing data cursor
        $query->closeCursor();

        return $data;
        
    }

    /*
     * If you want to show some informations for admin/user on screen in form of notification,
     * use inherited method addInfo();
     */
    private function infoDemo() {
        $this->addInfo('Hello World! this is notification from example module');
    }

    /*
     * If something went wrong and you want to notify admin/user about it
     * use inherited method addError()
     */
    private function errorDemo() {
        $this->addInfo('Oops something went wrong, dont worry, its just demo');
    }

}
?>
