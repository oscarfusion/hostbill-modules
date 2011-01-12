<?php
/*
 This is example addon module for HostBill.
 http://wiki.hostbillapp.com/index.php?title=Custom_Modules
 In order to make it work place it under includes/modules/Other directory, and activate from adminarea.
 *
 *
 *
 Example2 : installation / unistallation / activation possibilites, cron access
 Description: This module will show you how HostBill addons can have install
 and uninstall methods - to create database tables for example.
 We will also learn how our module can be accessed from cron
 *
 *
 */
class Example2 extends OtherModule {


    /*
     * protected $info
     * This is main addon set-up for developers.
     * For full modules possibilites visit: http://wiki.hostbillapp.com/index.php?title=Custom_Modules
     * In this example we wont be using any templates, we only need to allow being accessed by cronjob
     */
    protected $info = array(
       'havecron'=>true
    );

    /*
     * const NAME
     * Note: This needs to reflect class name - case sensitive.
     */
    const NAME = 'Example2';

    /*
     * const VER
     * Insert your module version here
     */
    const VER ='1.0';

    /*
     * protected $filename
     * This needs to reflect actual filename of module - case sensitive.
     */
    protected $filename='class.example2.php';

    /*
     * protected $description
     * If you want, you can add description to module, so its potential users will know what its for.
     */
    protected $description='This module will attempt to create table example2_table in your database, and remove it while uninstall is invoked';

    /*
     * protected $modname
     * AKA. "Nice name" - you can additionally add this variable - its contents will be displayed as module name after activation
     */
    protected $modname = 'HostBill Example Addon #2';



    //EOF: Module configuration

    /*
     * While initially activating module HostBill will look for install method, if present
     * it will invoke it, so place database/file creation methods here
     */
    public function install() {
        //in this example lets create simple table example2_table

        $this->db->exec("CREATE TABLE `example2_table` (
                            `id` INT(11) NOT NULL
                        );
        ");

        //cool everything worked so far ;)
        return true;
    }

    /*
     * If module is going to have unistall method available admin will see uninstall button
     * in module management section next to this module. Once clicked it will invoke this method
     * Its usefull for cleaning up after module, removing unnecessary files or database tables.
     *
     * return bool
     */
    public function uninstall() {        
        //in this example, lets drop created table
        //call exec() method from PDO
        $this->db->exec('DROP TABLE `example2_table`;');

        //lets assume everyghing went ok, we're returning true
        return true;

    }

    /*
     * Once module is being activated (after deactivation, not initially!) this method
     * will be invoked (if present) automatically
     */
    public function activate() {

        // module get activated again - what about using this method for license check of module?

        return true;
    }


    /*
     * In $info variable we've enabled cronjob access to this module.
     * Cron while going through modules will be looking for method called cronRun(), and if its available it will
     * get invoked.
     */
    public function cronRun() {

        //cronjob is invoked by default every 5 minutes
        //so if you want to do some task once daily for example check time or store previous run date somewhere
        //
        //

    }

}
?>