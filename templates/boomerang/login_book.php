<!DOCTYPE html>
<html>  
<head>
 <?php _widget('head');?>
</head>
<body class="body-wrap <?php _widget('custom_paletteclass'); ?>">

<?php _widget('slidebar'); ?>
<!-- MAIN WRAPPER -->
<div class="">
    <?php _widget('custom_palette');?>
    
    <!-- HEADER -->
    <div id="divHeaderWrapper">
    <header class="header-standard-3"> 
        <?php _widget('header_loginmenu');?>
        <?php _widget('header_mainmenu');?>
    </header>   
    </div>

    <!-- MAIN CONTENT -->
    <section class="slice bg-white bb" id="main">
        <div class="wp-section">
            <div id="content-block" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-12">
        <div class="row-fluid">
            <div class="span6 register-form">
            <h2 id="form">{lang_Register}</h2>
            <div class="property_content">
                <?php if($this->session->flashdata('error_registration') != ''):?>
                <p class="alert alert-success"><?php echo $this->session->flashdata('error_registration')?></p>
                <?php endif;?>
                <?php echo validation_errors()?>
                  <!-- Login form -->
                  <?php echo form_open(NULL, array('class' => 'form-horizontal'))?>
                                <div class="control-group">
                                  <label class="control-label"><?php echo lang('FirstLast')?></label>
                                  <div class="controls">
                                    <?php echo form_input('name_surname', set_value('name_surname', _ch($data_contact_r['name_surname'])), 'class="form-control" id="inputNameSurname" placeholder="'.lang('FirstLast').'"')?>
                                  </div>
                                </div>
                                
                                <div class="control-group">
                                  <label class="control-label"><?php echo lang('Username')?></label>
                                  <div class="controls">
                                    <?php echo form_input('username', set_value('username', ''), 'class="form-control" id="inputUsername" placeholder="'.lang('Username').'"')?>
                                  </div>
                                </div>
                                
                                <div class="control-group">
                                  <label class="control-label">Password</label>
                                  <div class="controls">
                                    <?php echo form_password('password', set_value('password', ''), 'class="form-control" id="inputPassword" placeholder="'.lang('Password').'" autocomplete="new-password"')?>
                                  </div>
                                </div>
                                
                                <div class="control-group">
                                  <label class="control-label"><?php echo lang('Confirmpassword')?></label>
                                  <div class="controls">
                                    <?php echo form_password('password_confirm', set_value('password_confirm', ''), 'class="form-control" id="inputPasswordConfirm" placeholder="'.lang('Confirmpassword').'" autocomplete="new-password"')?>
                                  </div>
                                </div>
                                
                                <div class="control-group">
                                  <label class="control-label"><?php echo lang('Address')?></label>
                                  <div class="controls">
                                    <?php echo form_textarea('address', set_value('address', _ch($data_contact_r['address'])), 'placeholder="'.lang('Address').'" rows="3" class="form-control"')?>
                                  </div>
                                </div>          
                                
                                <div class="control-group">
                                  <label class="control-label"><?php echo lang('Phone')?></label>
                                  <div class="controls">
                                    <?php echo form_input('phone', set_value('phone', _ch($data_contact_r['phone'])), 'class="form-control" id="inputPhone" placeholder="'.lang('Phone').'"')?>
                                  </div>
                                </div>
                                
                                <div class="control-group">
                                  <label class="control-label"><?php echo lang('Email')?></label>
                                  <div class="controls">
                                    <?php echo form_input('mail', set_value('mail', _ch($data_contact_r['mail'])), 'class="form-control" id="inputMail" placeholder="'.lang('Email').'"')?>
                                  </div>
                                </div>
                                
                    <div class="control-group">
                        <div class="controls">
    						<button type="submit" class="btn btn-danger"><?php echo lang('Register')?></button>
    						<button type="reset" class="btn btn-success"><?php echo lang('Reset')?></button>
    					</div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <a href="{front_login_url}"><i class="icon-user"></i> {lang_HaveAcc}</a>
    					</div>
                    </div>
                  <?php echo form_close()?>
            </div></div>
        
        
        
        
            <div class="span6 login-form">
            <h2>{lang_ReservationInfo}</h2>
            <div class="property_content">
                <table class="table table-striped">
                    <tr>
                    	<td><?php echo lang_check('Dates range');?></td>
                        <td><?php echo date('Y-m-d', strtotime($reservation['date_from'])).' - '.date('Y-m-d', strtotime($reservation['date_to'])); ?></td>
                    </tr>
                    <tr>
                    	<td><?php echo lang_check('Property');?></td>
                        <td><?php echo isset($options[$reservation['property_id']][10])?$options[$reservation['property_id']][10].', #'.$reservation['property_id']:''?></td>
                    </tr>
                    <tr>
                    	<td><?php echo lang_check('Total price');?></td>
                        <td><?php echo $reservation['total_price'].' '.$reservation['currency_code']; ?></td>
                    </tr>
                </table>
            </div></div>

        </div>
                                
                            </div>
                        </div><!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FOOTER -->
    <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'standard')); ?>
</div>

<?php _widget('custom_javascript');?>

</body>
</html>