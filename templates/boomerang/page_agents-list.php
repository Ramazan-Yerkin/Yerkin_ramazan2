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
     <section class="slice bg-white section-agent">
        <div class="wp-section">
            <div id="content-block" class="container">
                 <div class="row">  
                        <div class="col-md-3 agent-search-phone">
                              <div class="sidebar">
                                <!-- Search blog -->
                                <div class="section-title-wr wp-block pg-opt" style="padding-bottom: 15px;">
                                   <h3 class="section-title left"><span><?php _l('Search');?></span></h3>
                                </div>
                                <div class="wp-block base">
                                    <div class="wp-block-body">
                                        <form class="form-light">
                                           <div class="input-group">
                                                <input type="text" value="<?php echo $this->input->get('search-agent'); ?>" name="search-agent" class="form-control input-medium  btn-base btn-base-form" placeholder="<?php _l('CityorName');?>">
                                               <span class="input-group-btn btn-b-white btn-b-white-form">
                                                   <button type="submit" id="btn-search_showroom" class="btn btn-base">{lang_Search}</button>
                                               </span>
                                           </div>
                                       </form>
                                    </div>
                                </div>
                            </div>
                	</div>
                     
                	<div class="col-md-9">
                            <div class="wp-block pg-opt">
                                <h2 class="title">{page_title}</h2>
                            </div>
                            <div class="wp-block box-content">
                                {page_body}
                                 <?php _widget('center_imagegallery');?>
                                {has_page_documents}
                                <h2>{lang_Filerepository}</h2>
                                <ul>
                                {page_documents}
                                <li>
                                    <a href="{url}">{filename}</a>
                                </li>
                                {/page_documents}
                                </ul>
                                {/has_page_documents}
                            </div>
                            <div class="row animate-hover-slide-3 agents-list"> 
                                <?php foreach($paginated_agents as $item): ?>
                                <div class="col-md-4">
                                    <div class="wp-block inverse">
                                        <div class="figure">
                                            <a href="<?php  _che($item['agent_url']);?>">
                                                <img alt="" src="<?php echo _simg($item['image_url'], '600x600'); ?>" class="img-responsive">
                                            </a>
                                            <div class="figcaption">                                    
                                                <ul class="social-icons text-right">
                                                    <li class="text pull-left"><?php _l('More on');?>: </li>
                                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                    <?php if(!empty($item['facebook_link'])): ?>
                                                    <li><a href="<?php echo $item['facebook_link']; ?>"><i class="fa fa-facebook"></i></a></li>
                                                    <?php endif; ?>
                                                    <?php if(!empty($item['youtube_link'])): ?>
                                                        <li><a href="<?php echo $item['youtube_link']; ?>"><i class="fa fa-youtube"></i></a></li>
                                                    <?php endif; ?>
                                                    <?php if(!empty($item['gplus_link'])): ?>
                                                        <li><a href="<?php echo $item['gplus_link']; ?>"><i class="fa fa-google-plus"></i></a></li>
                                                    <?php endif; ?>
                                                    <?php if(!empty($item['twitter_link'])): ?>
                                                        <li><a href="<?php echo $item['twitter_link']; ?>"><i class="fa fa-twitter"></i></a></li>
                                                    <?php endif; ?>
                                                    <?php if(!empty($item['linkedin_link'])): ?>
                                                        <li><a href="<?php echo $item['linkedin_link']; ?>"><i class="fa fa-linkedin"></i></a></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <h2>  <a href="<?php  _che($item['agent_url']);?>"><?php  _che($item['name_surname']);?></a><!--<small>CEO</small>--></h2>
                                        <p>
                                           <?php  echo anti_spam_field(_ch($item['phone'])); ?> <br/>
                                           <?php  echo anti_spam_field(_ch($item['mail'])); ?>
                                                            
                                           <!-- Example to print specific custom field with label -->
                                           <?php //profile_cf_single(1, TRUE, $item); ?>
                                        </p>
                                    </div>
                                </div>
                                <?php endforeach;?>
                            </div>
                            <div class="row">
                            <div class="col-sm-12">
                                <div class="pagination pagination-centered">
                                    <?php echo $agents_pagination; ?>
                                </div>
                            </div>
                        </div>
                	</div> 
                	<div class="col-md-3">
                              <div class="sidebar agent-search-desktop">
                                <!-- Search blog -->
                                <div class="section-title-wr wp-block pg-opt" style="padding-bottom: 15px;">
                                   <h3 class="section-title left"><span><?php _l('Search');?></span></h3>
                                </div>
                                <div class="wp-block base">
                                        <div class="wp-block-body">
                                            <form class="form-light">
                                               <div class="input-group">
                                                    <input type="text" value="<?php echo $this->input->get('search-agent'); ?>" name="search-agent" class="form-control input-medium  btn-base btn-base-form" placeholder="<?php _l('CityorName');?>">
                                                   <span class="input-group-btn btn-b-white btn-b-white-form">
                                                       <button type="submit" id="btn-search_showroom" class="btn btn-base">{lang_Search}</button>
                                                   </span>
                                               </div>
                                           </form>
                                        </div>
                                </div>
                            </div>
                	</div>
                </div>
          
            </div>
        </div>
    </section>
    <section class="slice bg-white bb animate-hover-slide-3 no-padding">
    <div class="wp-section">
        <div class="container">
         
        </div>
    </div>
</section>
    <!-- FOOTER -->
    <?php _subtemplate( 'footers', _ch($subtemplate_footer, 'standard')); ?>
</div>

<?php _widget('custom_javascript');?>
</body>
</html>