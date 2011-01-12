<?php
/*
 This is example addon module for HostBill.
 http://wiki.hostbillapp.com/index.php?title=Custom_Modules
 In order to make it work place it under includes/modules/Other directory, and activate from adminarea.
 *
 *
 *
 Example3 : embedding custom javascript/css/html code to hostbill, enabling admin configuration for module
 Description: This module will show you how to add your custom javascript code to HostBill.
 You're able to add your javascript/css/html code to every HostBill page.
 This will also show you how add configuration possibilities for module, so it can interact with user.
 *
 *
 */
class Example3 extends OtherModule {


    /*
     * protected $info
     * This is main addon set-up for developers.
     * For full modules possibilites visit: http://wiki.hostbillapp.com/index.php?title=Custom_Modules
     * In this module we will be using header javascript (it requires havetpl=true) in adminarea
     */
    protected $info = array(
        'haveadmin'=>true,
        'havetpl'=>true,
        'header_js'=>true
    );

    /*
     * const NAME
     * Note: This needs to reflect class name - case sensitive.
     */
    const NAME = 'Example3';

    /*
     * const VER
     * Insert your module version here
     */
    const VER ='1.0';

    /*
     * protected $filename
     * This needs to reflect actual filename of module - case sensitive.
     */
    protected $filename='class.example3.php';

    /*
     * protected $description
     * If you want, you can add description to module, so its potential users will know what its for.
     */
    protected $description='This module will add custom header code to each adminarea page in HostBill';

    /*
     * protected $modname
     * AKA. "Nice name" - you can additionally add this variable - its contents will be displayed as module name after activation
     */
    protected $modname = 'HostBill Example Addon #3';


    /*
     * protected $configuration
     * Adminarea configuration array - types allowed: check, input, select, password
     * Values of this array will be automatically loaded from database with values configured by administrator
     */
    protected $configuration=array(
        'FIELD1'=>array(
        'value'=>'',
        'type'=>'input'
        ),
        'FIELD2'=>array(
        'value'=>'value1',
        'type'=>'select',
        'default'=>array('value1','value2','value3')
        ),
        'FIELD3'=>array(
        'value'=>'',
        'type'=>'password'
        ),
        'FIELD4'=>array(
        'value'=>'0',
        'type'=>'check'
        ),
    );
    
    //language array - each element key should start with module NAME
    protected $lang=array(
        'english'=>array(
            'Example3FIELD1'=>'Some value',
            'Example3FIELD2'=>'Pick one',
            'Example3FIELD3'=>'Password',
            'Example3FIELD4'=>'Check?',
        )
    );
        
    //EOF: Module configuration


    /*
     * This method will be invoked (because we've decided in $info array) on every
     * page in adminarea, so it should return code that needs to be added in document header section.
     *
     * Note1: You can check $_GET variable for cmd values - its main division on section in Hostbill,
     * for ex. cmd=invoices is invioces section
     * Note2: HostBill uses jQuery both in admin and clientarea, so you can use its rich features!
     */
     public function getHeaderJS() {

            //lets check where this method was invoked, if not invoices, alert stored value of FIELD2
            if($_GET['cmd']!='invoices') {
                return "<script type='text/javascript'>alert('Pick one value is : ".$this->configuration['FIELD2']['value'].", this message is from Example3 module')</script>";
            }

            //note that you can add other type of code - css or html meta tags using this method.

     }

}
?>