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
                         <div id="main-inner">
                <!-- MAP -->
                <div  class="container">
                    <!-- SLOGAN -->
                    <div class="block-content block-content-small-padding">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php //_widget('center_recentproperties'); ?>  
        <div class="row-fluid">
            <div class="span12 panel panel-default panel-sidebar-1">
            <div class="panel-heading"><h2><?php echo $page_title; ?></h2></div>
            <div class="property_content panel-body">
                <div class="widget-controls"> 
                    <span>
                    <?php _l('You can withdraw up to:'); ?>
                    <?php
                        $index=0;
                        $currencies = array(''=>'');
                        
                        if(sw_count($withdrawal_amounts) == 0)echo '0';
                        
                        foreach($withdrawal_amounts as $currency=>$amount)
                        {
                            $currencies[$currency] = $currency;
                            echo '<span class="label label-success">'.$amount.' '.$currency.'</span>&nbsp;';
                        }
                    ?>
                    </span>
                </div>
            
                    <?php echo validation_errors()?>
                    <?php if($this->session->flashdata('message')):?>
                    <?php echo $this->session->flashdata('message')?>
                    <?php endif;?>
                    <?php if($this->session->flashdata('error')):?>
                    <p class="alert alert-error"><?php echo $this->session->flashdata('error')?></p>
                    <?php endif;?>
                    <!-- Form starts.  -->
                    <?php echo form_open(current_url().'#form-block', array('class' => 'form-horizontal form-estate', 'role'=>'form'))?>                              
                        <div class="form-group control-group">
                          <label class="col-lg-2 control-label"><?php _l('Amount')?></label>
                          <div class="col-lg-10 controls">
                          <div class="input-append">
                            <?php echo form_input('amount', $this->input->post('amount') ? $this->input->post('amount') : '', ''); ?>
                          </div>
                          </div>
                        </div>
                        
                        <div class="form-group control-group">
                          <label class="col-lg-2 control-label"><?php _l('Currency code')?></label>
                          <div class="col-lg-10 controls">
                            <?php echo form_dropdown('currency', $currencies, $this->input->post('currency') ? $this->input->post('currency') : '', 'class="form-control"')?>
                          </div>
                        </div>

                        <div class="form-group control-group">
                          <label class="col-lg-2 control-label"><?php _l('Withdrawal email')?></label>
                          <div class="col-lg-10 controls">
                          <div class="input-append">
                            <?php echo form_input('withdrawal_email', $this->input->post('withdrawal_email') ? $this->input->post('withdrawal_email') : '', ''); ?>
                          </div>
                          </div>
                        </div>

                        <div class="control-group">
                          <div class="controls">
                            <?php echo form_submit('submit', lang_check('Request withdrawal'), 'class="btn btn-primary"')?>
                            <a href="<?php echo site_url('rates/payments/'.$lang_code)?>#content" class="btn btn-default" type="button"><?php echo lang_check('Cancel')?></a>
                          </div>
                        </div>
                    <?php echo form_close()?>
            </div>
            </div>
        </div>
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.block-content -->
                    <!-- SOCIAL -->
                    <?php //_widget('bottom_social'); ?>  
                    <!-- STATISTICS -->
                    <?php //_widget('bottom_stats'); ?> 
                </div><!-- /.container -->
            </div><!-- /#main-inner -->
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