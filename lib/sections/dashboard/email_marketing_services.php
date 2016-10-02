<?php
class OptimizePress_Sections_Email_Marketing_Services {
    function sections(){
        static $sections;
        if(!isset($sections)){
            $sections = array(
                'oneshoppingcart' => array(
                    'title' => __('1ShoppingCart', OP_SN),
                    'action' => array($this,'oneshoppingcart'),
                    'save_action' => array($this,'save_oneshoppingcart')
                ),
                'activecampaign' => array(
                    'title' => __('ActiveCampaign', OP_SN),
                    'action' => array($this,'activecampaign'),
                    'save_action' => array($this,'save_activecampaign')
                ),
                'aweber' => array(
                    'title' => __('AWeber', OP_SN),
                    'action' => array($this,'aweber'),
                    'save_action' => array($this,'save_aweber')
                ),
                'campaignmonitor' => array(
                    'title' => __('CampaignMonitor', OP_SN),
                    'action' => array($this,'campaignmonitor'),
                    'save_action' => array($this,'save_campaignmonitor')
                ),
                'egoi' => array(
                    'title' => __('Egoi', OP_SN),
                    'action' => array($this,'egoi'),
                    'save_action' => array($this,'save_egoi')
                ),
                'emma' => array(
                    'title' => __('Emma', OP_SN),
                    'action' => array($this,'emma'),
                    'save_action' => array($this,'save_emma')
                ),
                'getresponse' => array(
                    'title' => __('GetResponse', OP_SN),
                    'action' => array($this,'getresponse'),
                    'save_action' => array($this,'save_getresponse')
                ),
                'gotowebinar' => array(
                    'title' => __('GoToWebinar', OP_SN),
                    'action' => array($this,'gotowebinar'),
                    'save_action' => array($this,'save_gotowebinar')
                ),
                'icontact' => array(
                    'title' => __('iContact', OP_SN),
                    'action' => array($this,'icontact'),
                    'save_action' => array($this,'save_icontact')
                ),
                'infusionsoft' => array(
                    'title' => __('InfusionSoft', OP_SN),
                    'action' => array($this,'infusionsoft'),
                    'save_action' => array($this,'save_infusionsoft')
                ),
                'mailchimp' => array(
                    'title' => __('MailChimp', OP_SN),
                    'action' => array($this,'mailchimp'),
                    'save_action' => array($this,'save_mailchimp')
                ),
                'maropost' => array(
                    'title' => __('Maropost', OP_SN),
                    'action' => array($this,'maropost'),
                    'save_action' => array($this,'save_maropost')
                ),
                'officeautopilot' => array(
                    'title' => __('OfficeAutopilot', OP_SN),
                    'action' => array($this,'officeautopilot'),
                    'save_action' => array($this,'save_officeautopilot')
                ),
                'ontraport' => array(
                    'title' => __('Ontraport', OP_SN),
                    'action' => array($this,'ontraport'),
                    'save_action' => array($this,'save_ontraport')
                ),
				'mailwizz' => array(
                    'title' => __('MailWizz', OP_SN),
                    'action' => array($this,'mailwizz'),
                    'save_action' => array($this,'save_mailwizz')
                ),
            );
            $sections = apply_filters('op_edit_sections_email_marketing_services',$sections);
        }
        return $sections;
    }

    /* GoToWebinar */
    function gotowebinar(){
        echo op_load_section('gotowebinar', array(), 'email_marketing_services');
    }

    function save_gotowebinar($op){
        if ($gotowebinar = op_get_var($op['email_marketing_services'], 'gotowebinar_api_key')) {
            $this->op_update_trim_option('gotowebinar_api_key', $gotowebinar);
        }
    }

    /* Aweber */
    function aweber(){
        echo op_load_section('aweber', array(), 'email_marketing_services');
    }

    function save_aweber($op){
        if ($aweber = op_get_var($op, 'aweber')){
            op_update_option('aweber', $aweber);
        }
    }

    /* iContact */
    function icontact(){
        echo op_load_section('icontact', array(), 'email_marketing_services');
    }

    function save_icontact($op){
        $icontactUsername = op_get_var($op['email_marketing_services'], 'icontact_username');
        $icontactPassword = op_get_var($op['email_marketing_services'], 'icontact_password');

        if ($icontactUsername) {
            op_update_option('icontact_username', $icontactUsername);
        } else {
            op_delete_option('icontact_username');
        }

        if ($icontactPassword) {
            op_update_option('icontact_password', $icontactPassword);
        } else {
            op_delete_option('icontact_password');
        }

    }

    /* MailChimp */
    function mailchimp(){
        echo op_load_section('mailchimp', array(), 'email_marketing_services');
    }

    function save_mailchimp($op){
        if ($mailchimp = op_get_var($op['email_marketing_services'], 'mailchimp_api_key')){
            $this->op_update_trim_option('mailchimp_api_key', $mailchimp);
        } else {
            op_delete_option('mailchimp_api_key');
        }
    }

    /* Emma */
    function emma(){
        echo op_load_section('emma', array(), 'email_marketing_services');
    }

    function save_emma($op){

        if ($account_id = op_get_var($op['email_marketing_services'], 'emma_account_id')){
            $this->op_update_trim_option('emma_account_id',$account_id);
        } else {
            op_delete_option('emma_account_id');
        }
        if ($public_key = op_get_var($op['email_marketing_services'], 'emma_public_key')){
            $this->op_update_trim_option('emma_public_key', $public_key);
        } else {
            op_delete_option('emma_public_key');
        }
        if ($private_key = op_get_var($op['email_marketing_services'], 'emma_private_key')){
            $this->op_update_trim_option('emma_private_key', $private_key);
        } else {
            op_delete_option('emma_private_key');
        }

    }

    /* E-Goi */
    function egoi(){
        echo op_load_section('egoi', array(), 'email_marketing_services');
    }

    function save_egoi($op){
        if ($public_key = op_get_var($op['email_marketing_services'], 'egoi_api_key')){
            $this->op_update_trim_option('egoi_api_key', $public_key);
        } else {
            op_delete_option('egoi_api_key');
        }
    }

    /* Maropost */
    function maropost(){
        echo op_load_section('maropost', array(), 'email_marketing_services');
    }

    function save_maropost($op){
        if ($account_id = op_get_var($op['email_marketing_services'], 'maropost_acount_id')){
            $this->op_update_trim_option('maropost_acount_id', $account_id);
        } else {
            op_delete_option('maropost_acount_id');
        }
        if ($public_key = op_get_var($op['email_marketing_services'], 'maropost_auth_token')){
            $this->op_update_trim_option('maropost_auth_token', $public_key);
        } else {
            op_delete_option('maropost_auth_token');
        }
    }


    /* CampaignMonitor */
    function campaignmonitor(){
        echo op_load_section('campaignmonitor', array(), 'email_marketing_services');
    }

    function save_campaignmonitor($op){
        if ($campaignmonitor = op_get_var($op['email_marketing_services'], 'campaignmonitor_api_key')){
            $this->op_update_trim_option('campaignmonitor_api_key', $campaignmonitor);
        } else {
            op_delete_option('campaignmonitor_api_key');
        }
    }

    /* InfusionSoft */
    function infusionsoft(){
        echo op_load_section('infusionsoft', array(), 'email_marketing_services');
    }

    function save_infusionsoft($op){
        $accountId = op_get_var($op['email_marketing_services'], 'infusionsoft_account_id');
        $apiKey = op_get_var($op['email_marketing_services'], 'infusionsoft_api_key');

        if ($accountId) {
            op_update_option('infusionsoft_account_id', $accountId);
        } else {
            op_delete_option('infusionsoft_account_id');
        }

        if ($apiKey) {
            $this->op_update_trim_option('infusionsoft_api_key', $apiKey);
        } else {
            op_delete_option('infusionsoft_api_key');
        }
    }

    /* GetResponse */
    function getresponse(){
        echo op_load_section('getresponse', array(), 'email_marketing_services');
    }

    function save_getresponse($op){
        $apiKey = op_get_var($op['email_marketing_services'], 'getresponse_api_key');
        $apiUrl = op_get_var($op['email_marketing_services'], 'getresponse_api_url');

        if ($apiKey) {
            $this->op_update_trim_option('getresponse_api_key', $apiKey);
        } else {
            op_delete_option('getresponse_api_key');
        }

        if ($apiUrl) {
            $this->op_update_trim_option('getresponse_api_url', $apiUrl);
        } else {
            op_delete_option('getresponse_api_url');
        }
    }
	
	
	/*MailWizz*/
	
	function mailwizz(){
        echo op_load_section('mailwizz', array(), 'email_marketing_services');
    }

    function save_mailwizz($op){
        $apiPubKey = op_get_var($op['email_marketing_services'], 'mailwizz_api_public_key');
        $apiPrivKey = op_get_var($op['email_marketing_services'], 'mailwizz_api_private_key');
        $apiUrl = op_get_var($op['email_marketing_services'], 'mailwizz_api_url');

        if ($apiPubKey) {
            $this->op_update_trim_option('mailwizz_api_public_key', $apiPubKey);
        } else {
            op_delete_option('mailwizz_api_public_key');
        }
		
		if ($apiPrivKey) {
            $this->op_update_trim_option('mailwizz_api_private_key', $apiPrivKey);
        } else {
            op_delete_option('mailwizz_api_private_key');
        }

        if ($apiUrl) {
            $this->op_update_trim_option('mailwizz_api_url', $apiUrl);
        } else {
            op_delete_option('mailwizz_api_url');
        }
    }
	
    /* 1ShoppingCart */
    function oneshoppingcart(){
        echo op_load_section('oneshoppingcart', array(), 'email_marketing_services');
    }

    function save_oneshoppingcart($op){}

    /* OfficeAutopilot */
    function officeautopilot(){
        echo op_load_section('officeautopilot', array(), 'email_marketing_services');
    }

    function save_officeautopilot($op){
        $appId = op_get_var($op['email_marketing_services'], 'officeautopilot_app_id');
        $apiKey = op_get_var($op['email_marketing_services'], 'officeautopilot_api_key');

        if ($appId) {
            $this->op_update_trim_option('officeautopilot_app_id', $appId);
        } else {
            op_delete_option('officeautopilot_app_id');
        }

        if ($apiKey) {
            op_update_trim_option('officeautopilot_api_key', $apiKey);
        } else {
            op_delete_option('officeautopilot_api_key');
        }
    }

    /* Ontraport */
    function ontraport(){
        echo op_load_section('ontraport', array(), 'email_marketing_services');
    }

    function save_ontraport($op){
        $appId = op_get_var($op['email_marketing_services'], 'ontraport_app_id');
        $apiKey = op_get_var($op['email_marketing_services'], 'ontraport_api_key');

        if ($appId) {
            $this->op_update_trim_option('ontraport_app_id', $appId);
        } else {
            op_delete_option('ontraport_app_id');
        }

        if ($apiKey) {
            $this->op_update_trim_option('ontraport_api_key', $apiKey);
        } else {
            op_delete_option('ontraport_api_key');
        }
    }

    /* ActiveCampaign */
    function activecampaign(){
        echo op_load_section('activecampaign', array(), 'email_marketing_services');
    }

    function save_activecampaign($op){
        $accountUrl = op_get_var($op['email_marketing_services'], 'activecampaign_account_url');
        $apiKey = op_get_var($op['email_marketing_services'], 'activecampaign_api_key');

        if ($accountUrl) {
            $this->op_update_trim_option('activecampaign_account_url', $accountUrl);
        } else {
            op_delete_option('activecampaign_account_url');
        }

        if ($apiKey) {
            $this->op_update_trim_option('activecampaign_api_key', $apiKey);
        } else {
            op_delete_option('activecampaign_api_key');
        }
    }
    function op_update_trim_option($name,$value){
        op_update_option($name, preg_replace("/\s+/",'', $value));
    }
}