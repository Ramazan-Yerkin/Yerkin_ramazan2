<!DOCTYPE html>
<html>  
<head>
 <?php _widget('head');?>
        <link href="assets/js/footable/css/footable.core.css" rel="stylesheet">  
    <script src="assets/js/footable/js/footable.js"></script>
    <script>
    $(document).ready(function(){
        $('.footable').footable();
    });    
    </script>
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
            <div class="panel-heading"><h2><?php echo lang_check('My rates and availability'); ?></h2></div>
            <div class="property_content panel-body">
                <div class="widget-controls"> 
                    <?php echo anchor('rates/rate_edit/'.$lang_code.'#content', '<i class="icon-plus"></i>&nbsp;&nbsp;'.lang_check('Add rate'), 'class="btn btn-info"')?>
                </div>
                <div class="widget-content">
                
                    <?php if($this->session->flashdata('message')):?>
                    <?php echo $this->session->flashdata('message')?>
                    <?php endif;?>
                    <?php if($this->session->flashdata('error')):?>
                    <p class="alert alert-error"><?php echo $this->session->flashdata('error')?></p>
                    <?php endif;?>
                    <table class="table table-striped footable">
                      <thead>
                        <tr>
                        	<th>#</th>
                            <th><?php echo lang_check('From date');?></th>
                            <th ><?php echo lang_check('To date');?></th>
                            <th><?php echo lang_check('Property');?></th>
                            <th class="control" data-hide="phone"><?php echo lang_check('Edit');?></th>
                        	<th class="control" data-hide="phone"><?php echo lang_check('Delete');?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(sw_count($listings)): foreach($listings as $listing_item):?>
                                    <tr>
                                        <td><?php echo $listing_item->id; ?></td>
                                        <td><?php echo $listing_item->date_from; ?></td>
                                        <td><?php echo $listing_item->date_to; ?></td>
                                        <td><?php echo $properties[$listing_item->property_id]; ?></td>
                                        <td><?php echo btn_edit('rates/rate_edit/'.$lang_code.'/'.$listing_item->id)?></td>
                                        <td><?php echo btn_delete('rates/rate_delete/'.$lang_code.'/'.$listing_item->id)?></td>
                                    
                                    </tr>
                        <?php endforeach;?>
                        <?php else:?>
                                    <tr>
                                    	<td colspan="20"><?php echo lang_check('We could not find any');?></td>
                                    </tr>
                        <?php endif;?>           
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