<?php
/* 
For more examples up-to-date visit http://wiki.hostbillapp.com/index.php?title=Custom_Modules
zendesksso : shared login with www.zendesk.com
Description: This particular module is to allow SSO with ZenDesk. Users logged in in HB are alloowed to acess zendesk
 */
class Zendesksso extends OtherModule {
   
	protected $info = array(
		'haveadmin'=>true,
		'haveuser'=>true,
		'havelang'=>true,
		'needauth'=>true,
		'havetpl'=>true
	);


	/*
	Enabling configuration in class.zendesksso.php:
	Add array as below in your module - it will be rendered in HostBill module configuration in adminarea (under More in 2.3 and under "Edit Configuration" in 2.4+)
	HostBill will autoload your module with values entered by administrator and automatically stored in database.
	So to get organization value you call it by $this->configuration['organization']['value']
	*/
	protected $configuration = array(
		'organization'=>array(
			'value'=>'MyOrganization',
			'type'=>'input'
		),
		'token'=>array(
			'value'=>'yourzendeskremoteauthtoken',
			'type'=>'input'
		),
		'zendeskurl'=>array(
			'value'=>'http://myzendeskurl.zendesk.com/access/remote',
			'type'=>'input'
		),
	);

	const NAME = 'Zendesksso';
	const VER ='1.0';
	protected $version ='1.0';
	protected $filename='class.zendesksso.php';
	protected $description='Zendesksso - shared login for www.zendesk.com remote auth';
	protected $modname = 'ZenDesk shared login';

	public function errorMsg($msg) {
		$this->addError($msg);
	}
	public function infoMsg($msg) {
		$this->addInfo($msg);
	}

	public function userInfo($id, $ztime) {
		#$api = new APIWrapper();
		#$client = $api->getClientDetails($id);
		#return $client;

		# Get client details
		$query = $q=$this->db->prepare("SELECT * FROM `hb_client_details` WHERE `id` = $id");
		$query->execute();
		$numreg = $query->rowCount();
		if ( $numreg != 1 ) {
			#$this->addError("Error getting client details");
			$query->closeCursor();
			return "ERR-Error getting client details";
		}
		$clidata = $query->fetchAll(PDO::FETCH_ASSOC);
		$query->closeCursor();

		# Get client email
		$query = $q=$this->db->prepare("SELECT * FROM `hb_client_access` WHERE `id` = $id");
		$query->execute();
		$numreg = $query->rowCount();
		if ( $numreg != 1 ) {
			#$this->addError("Error getting client login");
			$query->closeCursor();
			return "ERR-Error getting client login";
		}
		$clilogin= $query->fetchAll(PDO::FETCH_ASSOC);
		$query->closeCursor();

		# Create URL
		$sFullName = $clidata[0]['firstname'] . ' ' . $clidata[0]['lastname'];
		$sEmail = $clilogin[0]['email'];
		$sExternalID = $sEmail;
		$sOrganization = $this->configuration['organization']['value'];
		$sToken = $this->configuration['token']['value'];
		$sZendeskUrl = $this->configuration['zendeskurl']['value'];
		$sMessage = $sFullName.$sEmail.$sExternalID.$sOrganization.$sToken.$ztime;
		$sHash = MD5($sMessage);
		$sso_url = $sZendeskUrl . "/?name=" . urlencode($sFullName) . "&email=" . urlencode($sEmail) . "&external_id=" . urlencode($sExternalID) . "&organization=" . urlencode($sOrganization) . "&timestamp=" . $ztime . "&hash=" . $sHash;
		
		return $sso_url;
	}

	public function Teste($id) {
		return "Funcionou";
	}

}
?>
