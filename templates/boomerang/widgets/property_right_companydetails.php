<?php if(!empty($estate_data_option_67)): ?>
<div class="panel panel-default panel-sidebar-1">
    <div class="panel-heading"><h2><?php echo lang_check('Company details'); ?></h2></div>
    <div class="panel-body text-left">
    <?php if($is_private_listing): ?>
    <div class="purchase_package">
    <a href="{front_login_url}#content">{lang_PurchaseToShow}</a>
    </div>
    <?php else: ?>
    <?php if(is_array($this->session->userdata('contacted_agents'))&&in_array($agent_id, $this->session->userdata('contacted_agents'))): ?>
    <?php else: ?>
       <?php if(config_db_item('agent_masking_enabled') == TRUE):?> 
        <a class="popup-with-form hidden-agent-details" href="#test-form"><?php echo lang_check('Show agent contact details'); ?></a>
        <?php endif; ?>
    <?php endif; ?>
    <?php
    if(!empty($estate_data_option_74))
    {
        //Fetch repository
        $rep_id = $estate_data_option_74;
        $file_rep = $this->file_m->get_by(array('repository_id'=>$rep_id));
        $rep_value = '';
        if(sw_count($file_rep))
        {
            echo '<div class="image-company"><img src="'._simg('files/'.$file_rep[0]->filename, '380x250').'" alt="'.$estate_data_option_67.'" /></div>';
        }
    }
    ?>
    <?php if(!empty($estate_data_option_67)): ?><div class="name"><a href="{agent_url}#content"><?php echo $estate_data_option_67; ?></a></div><?php endif; ?>
    <?php if(!empty($estate_data_option_68)): ?><div class="phone"><?php echo $estate_data_option_68; ?></div><?php endif; ?>
    <?php if(!empty($estate_data_option_73)): ?><div class="hours"><?php echo lang_check('Office hours'); ?>: <?php echo $estate_data_option_73; ?></div><?php endif; ?>
    <?php if(!empty($estate_data_option_69)): ?><div class="website"><a target="_blank" style="color: blue;" href="<?php echo $estate_data_option_69; ?>"><?php echo lang_check('Website'); ?></a></div><?php endif; ?>
    <div style="padding: 5px;">
        <?php if(!empty($estate_data_option_73)): ?><div class="description"><em><?php echo $estate_data_option_73; ?></em></div><?php endif; ?>
        <?php if(!empty($estate_data_option_72)): ?><div class="description"><em><?php echo $estate_data_option_72; ?></em></div><?php endif; ?>
        <?php if(!empty($estate_data_option_70)): ?><a target="_blank" href="<?php echo $estate_data_option_70; ?>"><img src="assets/img/social-facebook-button-blue-icon.png" /></a><?php endif; ?>
        <?php if(!empty($estate_data_option_71)): ?><a target="_blank" href="<?php echo $estate_data_option_71; ?>"><img src="assets/img/social-twitter-button-blue-icon.png" /></a><?php endif; ?>
    </div>

    <?php endif; ?>
        
    </div>
</div>
<?php endif ?>

<?php if(config_db_item('agent_masking_enabled') == TRUE): ?>
<!-- form itself -->
<form id="test-form" class="form-horizontal mfp-hide white-popup-block">
    <div id="popup-form-validation">
    <p class="hidden alert alert-error"><?php echo lang_check('Submit failed, please populate all fields!'); ?></p>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputAre"><?php echo lang_check('YouAre'); ?></label>
        <div class="controls">
            <label class="radio inline">
            <input type="radio" name="visitor_type" id="optionsRadios1" value="Individual" <?php echo $this->session->userdata('visitor_type')=='Individual'?'checked':''; ?>>
            <?php echo lang_check('Individual'); ?>
            </label>
            <label class="radio inline">
            <input type="radio" name="visitor_type" id="optionsRadios2" value="Dealer" <?php echo $this->session->userdata('visitor_type')=='Dealer'?'checked':''; ?>>
            <?php echo lang_check('Dealer'); ?>
            </label>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputName"><?php echo lang_check('YourName'); ?></label>
        <div class="controls">
            <input type="text" name="name" id="inputName" value="<?php echo $this->session->userdata('name'); ?>" placeholder="<?php echo lang_check('YourName'); ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPhone"><?php echo lang_check('Phone'); ?></label>
        <div class="controls">
            <input type="text" name="phone" id="inputPhone" value="<?php echo $this->session->userdata('phone'); ?>" placeholder="<?php echo lang_check('Phone'); ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputEmail"><?php echo lang_check('Email'); ?></label>
        <div class="controls">
            <input type="text" name="email" id="inputEmail" value="<?php echo $this->session->userdata('email'); ?>" placeholder="<?php echo lang_check('Email'); ?>">
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <label class="checkbox">
                <input name="allow_contact" value="1" type="checkbox"> <?php echo lang_check('I allow agent and affilities to contact me'); ?>
            </label>
            <button id="unhide-agent-mask" type="button" class="btn"><?php echo lang_check('Submit'); ?></button>
            <img id="ajax-indicator-masking" src="assets/img/ajax-loader.gif" style="display: none;" />
        </div>
    </div>
</form>
<?php endif; ?>