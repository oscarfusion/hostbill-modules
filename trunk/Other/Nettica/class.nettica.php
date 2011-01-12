<?php
/*
 This is example addon module for HostBill.
 http://wiki.hostbillapp.com/index.php?title=Custom_Modules
 In order to make it work place it under includes/modules/Other directory, and activate from adminarea.
 *
 *
 *
 Example4 : listening for HostBill events from a module
 Description: This module will show you how you can listen to and react on event occurence in HostBill.
 For full list of available events visit http://wiki.hostbillapp.com/index.php?title=Events

 *
 *
 */
class Nettica extends OtherModule implements Observer {


    /*
     * protected $info
     * This is main addon set-up for developers.
     * For full modules possibilites visit: http://wiki.hostbillapp.com/index.php?title=Custom_Modules
     * In this module we will allow listening for events in both admin and clientarea
     */
    protected $info = array(
        'haveadmin'=>true,
        'haveclient'=>false,
        'isobserver'=>true
    );

    /*
     * const NAME
     * Note: This needs to reflect class name - case sensitive.
     */
    const NAME = 'Nettica';

    /*
     * const VER
     * Insert your module version here
     */
    const VER ='1.0';

    /*
     * protected $filename
     * This needs to reflect actual filename of module - case sensitive.
     */
    protected $filename='class.nettica.php';

    /*
     * protected $description
     * If you want, you can add description to module, so its potential users will know what its for.
     */
    protected $description='A cada dominio registrado sua zona e criada nos servidores DNS Nettica';

    /*
     * protected $modname
     * AKA. "Nice name" - you can additionally add this variable - its contents will be displayed as module name after activation
     */
    protected $modname = 'Nettica';




    /*
     * Event handling section - all you need to do is add event handlers here - this needs to be
     * public functions with name same as event you want to listen to, and parameter same as
     * this from includes/core/class.events.php
     *
     * So we want to do something when ClientLogin and InvoicePaid events happen,  lets add methods for it
     */

    public function AfterRegistrarRegistration($details) {
	$xfd = fopen("/tmp/hb-nettica.txt", "w");
	fwrite($xfd, print_r($server_alias, true) );
	fclose($xfd);
    }


}
?>
