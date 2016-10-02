<?php
/**
 * This file contains examples for using the MailWizzApi PHP-SDK.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 http://www.mailwizz.com/
 */
 
// require the setup which has registered the autoloader



require_once dirname(__FILE__) . '/MailWizzApi/Autoloader.php';


class OP_MailWizz{
	

			// register the autoloader.
			
	protected $apiPubKey = 'PASS_API_PUB_KEY_WHEN_INSTANTIATING_CLASS';
	
	protected $apiPrivKey = 'PASS_API_PRIV_KEY_WHEN_INSTANTIATING_CLASS';

    protected $apiUrl = 'PASS_API_URL_WHEN_INSTANTIATING_CLASS';


	
	 /**
     * @var OptimizePress_Modules_Email_LoggerInterface
     */
    protected $logger;
	
	 /**
     * Check cURL extension is loaded and that an API key has been passed
     * @param string $apiKey GetResponse API key
     * @return void
     */
    public function __construct($apiPubKey ,$apiPrivKey ,$apiUrl, OptimizePress_Modules_Email_LoggerInterface $logger)
    {

        if(is_null($apiPubKey) || is_null($apiPrivKey)  || is_null($apiUrl)) trigger_error('API keys + URL must be supplied', E_USER_ERROR);
		
        $this->apiPubKey = $apiPubKey;
		
        $this->apiPrivKey = $apiPrivKey;

        $this->apiUrl = $apiUrl;

				MailWizzApi_Autoloader::register();
				
				$config = new MailWizzApi_Config(array(
				'apiUrl'        => $this->apiUrl,
				'publicKey'     => $this->apiPubKey,
				'privateKey'    => $this->apiPrivKey,
				
				// components
				'components' => array(
					'cache' => array(
						'class'     => 'MailWizzApi_Cache_File',
						'filesPath' => dirname(__FILE__) . '/MailWizzApi/Cache/data/cache', // make sure it is writable by webserver
					)
				),
			));

			// now inject the configuration and we are ready to make api calls
			MailWizzApi_Base::setConfig($config);

			// start UTC
			date_default_timezone_set('UTC');
					/*
         * Initializing logger
         */
        $this->logger = $logger;
    }
	
	/* 
	Getting the Lists ( 3awed Choufeha )
	*/
	
	 public function getListings()
    {
        $endpoint = new MailWizzApi_Endpoint_Lists();
        $lists = $endpoint->getLists($pageNumber = 1, $perPage = 100);
		
		$array=$lists->body->toArray();

		$response=$array['data']['records'];
		
		return $response ;
    }

	/**
     * Return a campaign by ID
     */
    public function getCampaignByID($id)
    {
        
		$endpoint = new MailWizzApi_Endpoint_Campaigns();
		
		$client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl(sprintf('campaigns/%s', (string)$id)),
            'paramsGet'     => array(),
            'enableCache'   => true,
        ));
        
        $response = $client->request();

		return $response->body;
		
    }


	
	public function addSubscriber($listID,$email,$fname=null,$lname=null){ 
	
	$endpoint = new MailWizzApi_Endpoint_ListSubscribers();
	
	$response = $endpoint->create($listID, array(
    'EMAIL'    => $email, // the confirmation email will be sent!!! Use valid email address
    'FNAME'    => $fname,
    'LNAME'    => $lname
	));
	

	return $response->body;
	
	}
}
	
	