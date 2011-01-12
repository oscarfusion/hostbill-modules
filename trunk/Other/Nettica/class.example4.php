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
class Example4 extends OtherModule implements Observer {


    /*
     * protected $info
     * This is main addon set-up for developers.
     * For full modules possibilites visit: http://wiki.hostbillapp.com/index.php?title=Custom_Modules
     * In this module we will allow listening for events in both admin and clientarea
     */
    protected $info = array(
        'haveadmin'=>true,
        'haveclient'=>true,
        'isobserver'=>true
    );

    /*
     * const NAME
     * Note: This needs to reflect class name - case sensitive.
     */
    const NAME = 'Example4';

    /*
     * const VER
     * Insert your module version here
     */
    const VER ='1.0';

    /*
     * protected $filename
     * This needs to reflect actual filename of module - case sensitive.
     */
    protected $filename='class.example4.php';

    /*
     * protected $description
     * If you want, you can add description to module, so its potential users will know what its for.
     */
    protected $description='This module will listen for occurence of InvoicePaid event and ClientLogin event';

    /*
     * protected $modname
     * AKA. "Nice name" - you can additionally add this variable - its contents will be displayed as module name after activation
     */
    protected $modname = 'HostBill Example Addon #4';




    /*
     * Event handling section - all you need to do is add event handlers here - this needs to be
     * public functions with name same as event you want to listen to, and parameter same as
     * this from includes/core/class.events.php
     *
     * So we want to do something when ClientLogin and InvoicePaid events happen,  lets add methods for it
     */

    public function ClientLogin($client_id) {
        //client just logged in, perform some action - log him somewhere else, or send a message.
    }

    public function InvoicePaid($invoice) {
        //you will get $invoice from function argument - which is instance of Invoice class.
        //most important methods are getInvoiceId() and getInvoice() [returns array of invoice items, client details etc -
        //use print_r for more info]

        //in this example lets send message to some email with information that invoice has been paid
         $details=$invoice->getInvoice();

         //Mailer extends  PHPMailer class by  Brent R. Matzelle [http://www.phpclasses.org/package/264-PHP-Full-featured-email-transfer-class-for-PHP.html]
         //no need to provide path, HostBill takes care of autoloading
        $mailer = new Mailer();
        $mailer->AddAddress('example@mail.com');
        $mailer->Subject='Payment received for invoice #'.$invoice->getInvoiceId();
        $mailer->Body='Client '.$details['client']['firstname'].' '.$details['client']['lastname']."
            just paid for invoice #".$invoice->getInvoiceId()."
        ";

        $mailer->Send();

    }



}
?>