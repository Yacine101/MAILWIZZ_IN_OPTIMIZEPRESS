<?php

require_once(OP_MOD . 'email/ProviderInterface.php');
require_once(OP_MOD . 'email/LoggerInterface.php');
require_once(OP_LIB . 'vendor/MailWizz/MailWizz_API.php');

/**
 * MailWizz email integration provider
 * @author Luka Peharda <luka.peharda@gmail.com>
 */
class OptimizePress_Modules_Email_Provider_MailWizz implements OptimizePress_Modules_Email_ProviderInterface
{
	/*
	 * Infos
	 */
	const OPTION_NAME_API_URL = 'mailwizz_api_url';
	const OPTION_NAME_API_PUBLIC_KEY = 'mailwizz_api_public_key';
	const OPTION_NAME_API_PRIVATE_KEY = 'mailwizz_api_private_key';
    

    /**
     * @var OP_MailWizz
     */
    protected $client = null;

    /**
     * @var boolean
     */
    protected $apiPubKey = false;
	
    protected $apiPrivKey = false;
	
    protected $apiUrl = false;
	

    /**
     * @var OptimizePress_Modules_Email_LoggerInterface
     */
    protected $logger;

    /**
     * Initializes client object and fetches API KEY
     */
    public function __construct(OptimizePress_Modules_Email_LoggerInterface $logger)
    {
        /*
         * Fetching API key from the wp_options table
         */
        $this->apiPubKey = op_get_option(self::OPTION_NAME_API_PUBLIC_KEY);
        $this->apiPrivKey = op_get_option(self::OPTION_NAME_API_PRIVATE_KEY);
        $this->apiUrl = op_get_option(self::OPTION_NAME_API_URL);

        /*
         * Initializing logger
         */
        $this->logger = $logger;
    }
	
	
    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::getClient()
     */
    public function getClient()
    {
        if (null === $this->client) {
            $this->client = new OP_MailWizz($this->apiPubKey,$this->apiPrivKey,$this->apiUrl, $this->logger);
        }

        return $this->client;
    }
	

    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::getLists()
     */
    public function getLists()
    {	

        $lists = $this->getClient()->getListings();

        $this->logger->info('Lists: ' . print_r($lists, true));

        return $lists;
    }

	
	
    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::getData()
     */
	 
	 
    public function getData()
    {
        $data = array(
            'lists' => array()
        );
		
        /*
         * List parsing
         */
        $lists = $this->getLists();
        if ($lists) {
            foreach ($lists as $id => $list) {
                $data['lists'][$list['general']['list_uid']] = array('name' => $list['general']['name']); 
            }
        }

        $this->logger->info('Formatted lists: ' . print_r($data, true));

        return $data;
    }

    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::getItems()
     */
    public function getItems()
    {
        $data = $this->getData();

        $this->logger->info('Items: ' . print_r($data, true));

        return $data;
    }

    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::subscribe()
     */
    public function subscribe($data)
    {
        $this->logger->info('Subscribing user: ' . print_r($data, true));

        if (isset($data['list']) && isset($data['email'])) {


            try {
                $status = $this->getClient()->addSubscriber($data['list'],$data['email'],op_post('fname') !== false ? op_post('fname') : 'Friend',op_post('lname') !== false ? op_post('lname') : 'Friend'); // See Again . 

                $this->logger->notice('Subscription status: ' . print_r($status, true));
            } catch (Exception $e) {
                $this->logger->error('Error ' . $e->getCode() . ': ' . $e->getMessage());
            }

            return true;
        } else {
            $this->logger->alert('Mandatory information not present [list and/or email address]');
            wp_die('Mandatory information not present [list and/or email address ].');
        }
    }

    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::register()
     */
    public function register($list, $email, $fname, $lname)
    {
        $this->logger->info('Registering user: ' . print_r(func_get_args(), true));

        try {
            $status = $this->getClient()->addSubscriber($list,$email,$fname,$lname); // See Again .

            $this->logger->notice('Registration status: ' . print_r($status, true));
        } catch (Exception $e) {
            $this->logger->error('Error ' . $e->getCode() . ': ' . $e->getMessage());
        }

        return true;
    }

    /**
     * Searches for possible form fields from POST and adds them to the collection
     * @return null|array     Null if no value/field found
     */
    protected function prepareMergeVars($listID)
    {
        $vars = array();
        $allowed = array_keys($this->getListFields($listID));

        foreach ($allowed as $name) {
            if ($name !== 'name' && op_post($name) !== false) {
                $vars[$name] = op_post($name);
            }
        }

        if (count($vars) === 0) {
            $vars = null;
        }

        return $vars;
    }

    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::isEnabled()
     */
    public function isEnabled()
    {
        return (($this->apiPubKey === false) || ($this->apiPrivKey === false) || ($this->apiUrl === false)) ? false : true;
    }
	
	public function getListFields($listID){
		
		return null;
		
	}
  
}