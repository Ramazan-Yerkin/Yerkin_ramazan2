<?php
/*
Widget-title: Basic category listing page
Widget-preview-image: /assets/img/widgets_preview/center_basic_category_listing.jpg
 */
?>

<?php

if(!function_exists('recursion_calc_count')) {
    function recursion_calc_count ($result_count, $tree_listings, $parent_title, $id, &$child_count){
        if (isset($tree_listings[$id]) && sw_count($tree_listings[$id]) > 0){
            foreach ($tree_listings[$id] as $key => $_child) {
                $options = $tree_listings[$_child->parent_id][$_child->id];
                if(isset($result_count[strtolower($parent_title.' - '.$options->value.' -')]))
                    $child_count+= $result_count[strtolower($parent_title.' - '.$options->value.' -')];

                $_parent_title = $parent_title.' - '.$options->value;
                if (isset($tree_listings[$_child->id]) && sw_count($tree_listings[$_child->id]) > 0){    
                    recursion_calc_count($result_count, $tree_listings, $_parent_title, $_child->id, $child_count);
                }
            }
        }
    }
}

$CI = & get_instance();
$treefield_id = 79;

$CI->load->model('treefield_m');
$CI->load->model('option_m');
$CI->load->model('file_m');

$treefields = array();

$check_option= $CI->option_m->get_by(array('id'=>$treefield_id));
// check if option exists
if(!$check_option)
    return false;

if($check_option[0]->type!='TREE')
    return false;

$tree_listings = $CI->treefield_m->get_table_tree($lang_id, $treefield_id, NULL, FALSE, '.order', ',image_filename, repository_id');

if(empty($tree_listings) || !isset($tree_listings[0]))
    return false;

// count listing
/*SELECT `property`.id, 
`property`.`is_activated`,
`property_value`.`property_id`,
`property_value`.`value`, 
COUNT(value)
FROM `property`
LEFT JOIN `property_value` ON `property`.id = `property_value`.`property_id`
 WHERE `option_id`= 64 and `language_id`=1 and `is_activated`=1 GROUP BY `value`
*/
$this->db->select('property_value.value, COUNT(value) as count');

$this->db->join('property_value', 'property.id = property_value.property_id');

$this->db->group_by('property_value.value');  
$this->db->where('option_id', $treefield_id);
$this->db->where('language_id', $lang_id);
$this->db->where('is_activated', 1);
$this->db->where('is_visible', 1);

if(config_db_item('listing_expiry_days') !== FALSE)
{
    if(is_numeric(config_db_item('listing_expiry_days')) && config_db_item('listing_expiry_days') > 0)
    {
        $this->db->where('date_modified >', date("Y-m-d H:i:s" , time() - config_db_item('listing_expiry_days')*86400));
    }
}

$query= $this->db->get('property');

$result_count = array();

if($query){
    $result = $query->result();
    foreach ($result as $key => $value) {
        if(!empty($value->value)) {
            $v = strtolower($value->value);
            $v = trim($v);
            $result_count[$v]= $value->count;
        }
    }
}

$_treefields = $tree_listings[0];
$treefields = array();
foreach ($_treefields as $val) {

    $options = $tree_listings[0][$val->id];
    $treefield = array();
    $field_name = 'value' ;
    $treefield['title'] = trim($options->$field_name);
    $treefield['title_chlimit'] = character_limiter($options->$field_name, 15);
    
    $treefield['count'] = 0;
    if(isset($result_count[strtolower($treefield['title'].' -')]))
        $treefield['count'] = $result_count[strtolower($treefield['title'].' -')];
    
    $treefield['url'] = '';
    /* link if have body */
    if(!empty($options->{'body'}))
    {
        $href = slug_url('treefield/'.$lang_code.'/'.$options->id.'/'.url_title_cro($options->value), 'treefield_m');
        $treefield['url'] = $href;
    } else {
        $href = site_url_nosuff($lang_code.'/'.$this->data['page_id'].'/?search={"v_search_option_'.$treefield_id.'":"'.rawurlencode($treefield['title'].' - ').'"}');
        $treefield['url'] = $href;
    }
    /* end if have body */
    
    // Thumbnail and big image
    if(!empty($options->image_filename) and file_exists(FCPATH.'files/thumbnail/'.$options->image_filename))
    {
        $files_r = $CI->file_m->get_by(array('repository_id' => $options->repository_id));
        // check second image
        if($files_r and isset($files_r[1])) {
            $treefield['thumbnail_url'] = base_url('files/thumbnail/'.$files_r[1]->filename);
            $treefield['image_url'] = base_url('files/'.$files_r[1]->filename);
        } else {
            $treefield['thumbnail_url'] = base_url('files/thumbnail/'.$options->image_filename);
            $treefield['image_url'] = base_url('files/'.$options->image_filename);
        }
        
    }
    else
    {
        $treefield['thumbnail_url'] = 'assets/img/648927-star-ratings-512.png';
        $treefield['image_url'] = 'assets/img/648927-star-ratings-512.png';
    }
    
    $childs_count = 0;
    $childs = array();
    if (isset($tree_listings[$val->id]) && sw_count($tree_listings[$val->id]) > 0)
        foreach ($tree_listings[$val->id] as $key => $_child) {
            $child = array();
            $options = $tree_listings[$_child->parent_id][$_child->id];
            $field_name = 'value';
            $child['title'] = trim($options->$field_name);
            $child['title_chlimit'] = character_limiter($options->$field_name, 10);
            
            $child['count']= 0;
            if(isset($result_count[strtolower($treefield['title'].' - '.$child['title'].' -')]))
                $child['count'] = $result_count[strtolower($treefield['title'].' - '.$child['title'].' -')];
            
            $child['url'] = '';
            /* link if have body */
                if(!empty($options->{'body'}))
                {
                    // If slug then define slug link
                    $href = slug_url('treefield/'.$lang_code.'/'.$options->id.'/'.url_title_cro($options->value), 'treefield_m');
                    $child['url'] = $href;
                } 
            /* end if have body */
            if (isset($tree_listings[$_child->id]) && sw_count($tree_listings[$_child->id]) > 0){
                $parent_title = $treefield['title'].' - '.$child['title'];
                recursion_calc_count($result_count, $tree_listings, $parent_title, $_child->id, $child['count']);
            }   
                   
            $childs_count+=$child['count'];
            $childs[] = $child;
        }

    
    $treefield['count'] += $childs_count;
    $treefield['childs'] = $childs;
    $treefield['childs_more'] = array_slice($childs, 5);
    $treefield['childs_5'] = array_slice($childs, 0, 5);
    $treefields[] = $treefield;
}

?>

<?php if(search_value($treefield_id)) : ?>
<?php _widget('center_recentproperties');?>  
<?php else: ?>
<div class="results_conteiner">
<div class="section-title-wr pg-opt style-title">
    <h2 class="section-title left section-title-min section-title-min-categories"><span><?php echo lang_check('Categories');?></span></h2>
</div>
<div class="row-fluid  treefield-list treefield-category clearfix row row-flex" style="margin-top: -0.5%;">
    <?php foreach ($treefields as $key=>$item): ?>
        <?php
          // if($key==0)echo '<div class="row">';
        ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="wp-block property grid b-category">
                    <div class="wp-block-body">
                        <div class="b-category-head"><a href='<?php _che($item['url']); ?>'><img src="<?php _che($item['thumbnail_url']);?>" alt="<?php _che($item['title']);?>" /></a></div>
                        <div class="b-category-c wp-block-content">
                            <div class="div b-category-title"><a href='<?php _che($item['url']); ?>' class="content-title"><?php _che($item['title']);?> <span class="item-count">(<?php _che($item['count']);?>)</span></a></div>
                            <ul class="div b-category-list">
                                <?php if(sw_count($item['childs_5']) > 0)foreach ($item['childs_5'] as $child):?>
                                <li>
                                    <?php if(!empty($child['url'])): ?>
                                        <a href='<?php _che($child['url']); ?>'><?php _che($child['title']); ?> <span class="item-count">(<?php _che($child['count']);?>)</span></a>
                                    <?php else:?>
                                        <a href='<?php echo site_url_nosuff($lang_code.'/'.$this->data['page_id'].'/?search={"v_search_option_'.$treefield_id.'":"'.rawurlencode($item['title_chlimit'].' - '.$child['title'].' - ').'"}'); ?>'><?php _che($child['title']); ?> <span class="item-count">(<?php _che($child['count']);?>)</span></a>
                                    <?php endif;?>
                                </li>
                                <?php endforeach;?>
                                <?php if(!empty($item['childs_more'])):?>
                                <ul class='b-category-more-list' style='display: none;'>
                                    <?php foreach ($item['childs_more'] as $child):?>
                                    <li>
                                        <?php if(!empty($child['url'])): ?>
                                            <a href='<?php _che($child['url']); ?>'><?php _che($child['title']); ?> <span class="item-count">(<?php _che($child['count']);?>)</span></a>
                                        <?php else:?>
                                            <a href='<?php echo site_url_nosuff($lang_code.'/'.$this->data['page_id'].'/?search={"v_search_option_'.$treefield_id.'":"'.rawurlencode($item['title_chlimit'].' - '.$child['title'].' - ').'"}'); ?>'><?php _che($child['title']); ?> <span class="item-count">(<?php _che($child['count']);?>)</span></a>
                                        <?php endif;?>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                                <li>
                                    <a href="#" class='b-category-more'> 
                                        <i class="fa fa-circle fa-1" aria-hidden="true"></i> 
                                        <i class="fa fa-circle fa-1" aria-hidden="true"></i> 
                                        <i class="fa fa-circle fa-1" aria-hidden="true"></i> 
                                    </a>
                                </li>
                                <?php endif;?>
                            
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php
          /* if( ($key+1)%3==0 )
            {
                echo '</div><div class="row">';
            }
            if( ($key+1)==sw_count($treefields) ) echo '</div>';*/
        ?>
    <?php endforeach; ?>
    </div>
</div>
<?php endif;?>

<script type="text/javascript">

$(function(){
    
    $('.b-category').each(function(){
        $(this).css('height',$(this).height()+'px')

    })
    
    
    $('.b-category .b-category-more').click(function(){
        var _this = $(this);
        
        if(_this.closest('.b-category').hasClass('open')) {
            _this.closest('.b-category').find('.b-category-more-list').slideUp('fast')  
            $('.b-category').removeClass('open')
            $('.b-category').find('.wp-block-body').css('width', '100%') 
            
        } else {
            $('.b-category').removeClass('open')
            $('.b-category').find('.wp-block-body').css('width', '100%') 
            $(this).closest('.b-category').addClass('open')
            
            _this.closest('.b-category').find('.b-category-more-list').slideDown('fast') 
            _this.closest('.b-category').find('.wp-block-body').css('width', '105%') 
        }
    })
})

</script>