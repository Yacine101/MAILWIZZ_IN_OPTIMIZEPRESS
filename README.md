#Mailwizz Integration into OptimizePress 

To integrate MailWizz into OptimizePress , Do the three steps :

1- Copying new files :

+ Not all the files in lib are new files , copy the following : 

		FILE 	  --  lib\modules\email\provider\MailWizz.php
		FILE 	  --  lib\tpl\sections\email_marketing_services\mailwizz.php
		DIRECTORY --  vendor\MailWizz

2- Adjust the following files :

+ lib\modules\email\ProviderFactory.php : 
   
   Add the following (File Attached )

		case 'mailwizz':
        	      	require_once(OP_MOD . 'email/provider/MailWizz.php');
                	$provider = new OptimizePress_Modules_Email_Provider_MailWizz($logger);
                	break;	

+ lib\sections\dashboard\email_marketing_services.php

   Add the following to the array  $sections (File attached) : 
 	
		'mailwizz' => array(
                    	'title' => __('MailWizz', OP_SN),
                    	'action' => array($this,'mailwizz'),
                    	'save_action' => array($this,'save_mailwizz')
                	),

   And the functions mailwizz and save_mailwizz .
	

3- Integrating to the Optin Form : 

a- OptimizePress uses external JS , in order to make the optin form support Provider List , we need to make mailwizz 
another provider's ID , so exchange between 'mailwizz' and the targeted provider .

Example : 
	 
		'aweber'=> array(
                    'title' => __('MailWizz', OP_SN),
                    'action' => array($this,'mailwizz'),
                    'save_action' => array($this,'save_mailwizz')
                ),
		'mailwizz' => array(
                    'title' => __('AWeber', OP_SN),
                    'action' => array($this,'aweber'),
                    'save_action' => array($this,'save_aweber')
                ),
