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
                <div class="container">
                    <!-- SLOGAN -->
                    <div class="block-content block-content-small-padding">
                        <div class="row">
                            <div class="col-sm-12">
        <div class="row-fluid">
            <div class="span12 panel panel-default panel-sidebar-1">
            <div class="panel-heading"><h2 class=" home-page-body main-heading bottom-line"><?php echo $page_title; ?></h2></div>
            <div class="property_content panel-body">
                <div class="widget-content">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        	<th class="span5">#</th>
                            <th><?php echo lang_check('Info');?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        	<td><?php echo lang_check('Reservation id');?></td>
                            <td>#<?php echo $reservation['id']; ?></td>
                        </tr>       
                        <tr>
                        	<td><?php echo lang_check('Dates range');?></td>
                            <td><?php echo date('Y-m-d', strtotime($reservation['date_from'])).' - '.date('Y-m-d', strtotime($reservation['date_to'])); ?></td>
                        </tr>
                        <tr>
                        	<td><?php echo lang_check('Property');?></td>
                            <td><?php echo isset($options[$reservation['property_id']][10])?'<a href="'.site_url('property/'.$reservation['property_id'].'/'.$lang_code).'">'.$options[$reservation['property_id']][10].', #'.$reservation['property_id'].'</a>':''?></td>
                        </tr>
                        <tr>
                        	<td><?php echo lang_check('Total price');?></td>
                            <td><?php echo $reservation['total_price'].' '.$reservation['currency_code']; ?></td>
                        </tr>
                        <tr>
                        	<td><?php echo lang_check('Total paid');?></td>
                            <td><?php echo $reservation['total_paid'].' '.$reservation['currency_code']; ?></td>
                        </tr>
                        <tr>
                        	<td><?php echo lang_check('Is booked');?></td>
                            <td>
                                <?php if($reservation['is_confirmed'] == 0):?>
                                &nbsp;<span class="label label-important"><?php echo lang_check('Not confirmed')?></span>
                                <?php else: ?>
                                &nbsp;<span class="label label-success"><?php echo lang_check('Confirmed')?></span>
                                <?php endif;?>
                            </td>
                        </tr>
                        <?php if($reservation['total_paid'] == 0): ?>
                        <tr>
                        	<td><?php echo lang_check('Pay advance and reservation');?>, <?php echo number_format($reservation['total_price']*0.2, 2).' '.$reservation['currency_code']; ?></td>
                                <td>
                                <?php if(config_db_item('payments_enabled') == 1 && !_empty(config_db_item('paypal_email'))): ?>
                                    <a href="<?php echo site_url('frontend/do_purchase/'.$this->data['lang_code'].'/'.$reservation['id'].'/'.number_format($reservation['total_price']*0.2, 2)); ?>"><img style="height:36px; margin-right:10px;" src="assets/img/paypal.png" alt="" /></a>
                                <?php endif; ?>
                                <?php if(file_exists(APPPATH.'controllers/paymentconsole.php') && !_empty(config_item('authorize_api_login_id'))): ?>
                                    <a href="<?php echo site_url('paymentconsole/authorize_payment/'.$this->data['lang_code'].'/'.number_format($reservation['total_price']*0.2, 2).'/'.$reservation['currency_code'].'/'.$reservation['id'].'/RES'); ?>"><img style="height:36px; margin-right:10px;" src="assets/img/pay-creditcard.png" alt="" /></a>
                                <?php endif; ?>
                                <?php if(file_exists(APPPATH.'controllers/paymentconsole.php') && config_item('stripe_enabled') !== FALSE): ?>
                                    <a href="<?php echo site_url('paymentconsole/strip_payment/'.$this->data['lang_code'].'/'.number_format($reservation['total_price']*0.2, 2).'/'.$reservation['currency_code'].'/'.$reservation['id'].'/RES'); ?>"><img style="height:36px; margin-right:10px;" src="assets/img/stripe-logo.png" alt="" /></a>
                                <?php endif; ?>
                                </td>
                       </tr>
                        <?php endif; ?>
                        <?php if($reservation['total_paid'] < $reservation['total_price']): ?>
                        <tr>
                        	<td><?php echo lang_check('Pay total');?>, <?php echo number_format($reservation['total_price']-$reservation['total_paid'], 2).' '.$reservation['currency_code']; ?></td>
                                <td>    
                                    <?php if(config_db_item('payments_enabled') == 1 && !_empty(config_db_item('paypal_email'))): ?>
                                        <a href="<?php echo site_url('frontend/do_purchase/'.$this->data['lang_code'].'/'.$reservation['id'].'/'.number_format($reservation['total_price']-$reservation['total_paid'], 2)); ?>"><img style="height:36px; margin-right:10px;" src="assets/img/paypal.png" alt="" /></a>
                                    <?php endif; ?>
                                    <?php if(file_exists(APPPATH.'controllers/paymentconsole.php') && !_empty(config_item('authorize_api_login_id'))): ?>
                                        <a href="<?php echo site_url('paymentconsole/authorize_payment/'.$this->data['lang_code'].'/'.number_format($reservation['total_price']-$reservation['total_paid'], 2).'/'.$reservation['currency_code'].'/'.$reservation['id'].'/RES'); ?>"><img style="height:36px; margin-right:10px;" src="assets/img/pay-creditcard.png" alt="" /></a>
                                    <?php endif; ?>
                                    <?php if(file_exists(APPPATH.'controllers/paymentconsole.php') && config_item('stripe_enabled') !== FALSE): ?>
                                        <a href="<?php echo site_url('paymentconsole/strip_payment/'.$this->data['lang_code'].'/'.number_format($reservation['total_price']-$reservation['total_paid'], 2).'/'.$reservation['currency_code'].'/'.$reservation['id'].'/RES'); ?>"><img style="height:36px; margin-right:10px;" src="assets/img/stripe-logo.png" alt="" /></a>
                                    <?php endif; ?>
                                </td>
                        </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
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