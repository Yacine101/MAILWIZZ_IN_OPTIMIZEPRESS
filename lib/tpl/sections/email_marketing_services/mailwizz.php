<div class="op-bsw-grey-panel-content op-bsw-grey-panel-no-sidebar cf">        
    <label for="op_sections_email_marketing_services_mailwizz_api_public_key" class="form-title"><?php _e('MailWizz API Public key', OP_SN); ?></label>
    <p class="op-micro-copy"><?php _e('Copy MailWizz API Public key here.', OP_SN); ?></p>
    <?php op_text_field('op[sections][email_marketing_services][mailwizz_api_public_key]', op_get_option('mailwizz_api_public_key')); ?>
	<label for="op_sections_email_marketing_services_mailwizz_api_private_key" class="form-title"><?php _e('MailWizz API Private key', OP_SN); ?></label>
    <p class="op-micro-copy"><?php _e('Copy MailWizz API Private key here.', OP_SN); ?></p>
    <?php op_text_field('op[sections][email_marketing_services][mailwizz_api_private_key]', op_get_option('mailwizz_api_private_key')); ?>
    <label for="op_sections_email_marketing_services_mailwizz_api_url" class="form-title"><?php _e('MailWizz API calls URL', OP_SN); ?></label>
    <p class="op-micro-copy"><?php _e('If needed copy MailWizz custom API calls URL here.', OP_SN); ?></p>
    <?php 
    	$apiUrl = op_get_option('mailwizz_api_url');
    	
		op_text_field('op[sections][email_marketing_services][mailwizz_api_url]', $apiUrl); 
	?>
</div>