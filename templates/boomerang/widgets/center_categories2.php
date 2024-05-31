<?php
/*
Widget-title: Listing Categories 2
Widget-preview-image: /assets/img/widgets_preview/center_categories.jpg
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

$treefields = array();

$check_option= $CI->option_m->get_by(array('id'=>$treefield_id));

$disabled = false;
// check if option exists
if(!$check_option)
    $disabled = true;

if($check_option[0]->type!='TREE')
    $disabled = true;

$tree_listings = $CI->treefield_m->get_table_tree($lang_id, $treefield_id, NULL, FALSE, '.order', ',image_filename');

if(empty($tree_listings) || !isset($tree_listings[0]))
    $disabled = true;

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

if(!$disabled) {
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
        $treefield['title'] = $options->$field_name;
        $treefield['title_chlimit'] = character_limiter($options->$field_name, 15);

        $field_name = 'body';
        $treefield['descriotion'] = $options->$field_name;
        $treefield['description_chlimit'] = character_limiter($options->$field_name, 50);

        $treefield['count'] = 0;
        if(isset($result_count[strtolower($treefield['title'].' -')]))
            $treefield['count'] = $result_count[strtolower($treefield['title'].' -')];

        $treefield['url'] = '';

        /* link if have body */
        if(!empty($options->$field_name))
        {
            $href = slug_url('treefield/'.$lang_code.'/'.$options->id.'/'.url_title_cro($options->value), 'treefield_m');
            $treefield['url'] = $href;
        }
        /* end if have body */

        // Thumbnail and big image
        if(!empty($options->image_filename) and file_exists(FCPATH.'files/thumbnail/'.$options->image_filename))
        {
            $treefield['thumbnail_url'] = base_url('files/thumbnail/'.$options->image_filename);
            $treefield['image_url'] = base_url('files/'.$options->image_filename);
        }
        else
        {
            $treefield['thumbnail_url'] = 'assets/img/no_image.jpg';
            $treefield['image_url'] = 'assets/img/no_image.jpg';
        }

        $childs_count = 0;
        $childs = array();
        if (isset($tree_listings[$val->id]) && sw_count($tree_listings[$val->id]) > 0)
            foreach ($tree_listings[$val->id] as $key => $_child) {
                $child = array();
                $options = $tree_listings[$_child->parent_id][$_child->id];
                $field_name = 'value';
                $child['title'] = $options->$field_name;
                $child['title_chlimit'] = character_limiter($options->$field_name, 10);

                $field_name = 'body';
                $child['descriotion'] = $options->$field_name;
                $child['descriotion_chlimit'] = character_limiter($options->$field_name, 50);

                $child['count']= 0;
                if(isset($result_count[strtolower($treefield['title'].' - '.$child['title'].' -')]))
                    $child['count'] = $result_count[strtolower($treefield['title'].' - '.$child['title'].' -')];

                $child['url'] = '';

                /* link if have body */
                    if(!empty($options->$field_name))
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
        $treefield['childs_more'] = array_slice($childs, 8);
        $treefield['childs_8'] = array_slice($childs, 0, 8);
        $treefields[] = $treefield;
    }
}

?>

<?php if(search_value($treefield_id)) : ?>
<?php _widget('center_recentproperties');?>  
<?php else: ?>
<div class="results_conteiner">
    
<?php if(!$disabled): ?>
    <div class="section-title-wr pg-opt style-title">
        <h2 class="section-title left section-title-min section-title-min-categories"><span><?php echo lang_check('Categories');?></span></h2>
    </div>
    <div class="row-fluid  treefield-list treefield-category clearfix" style="margin-top: -0.5%;">
        <?php foreach ($treefields as $key=>$item): ?>
            <?php
               if($key==0)echo '<div class="row">';
            ?>

            <div class='col-md-4 treefield-item'>
                 <div class="wp-block property grid">
                    <div class="wp-block-title wp-block-body">
                        <h3 class="wp-block-content">
                            <?php if(!empty($item['url'])) : ?>
                                <a class="content-title" href='<?php _che($item['url']);?>'><?php _che($item['title_chlimit']); ?> <span class="item-count">(<?php _che($item['count']);?>)</span></a>
                            <?php else: ?> 
                                <a class="content-title" href='<?php echo site_url_nosuff($lang_code.'/'.$this->data['page_id'].'/?search={"v_search_option_'.$treefield_id.'":"'.rawurlencode($item['title_chlimit'].' - ').'"}'); ?>'><?php _che($item['title_chlimit']); ?> <span class="item-count">(<?php _che($item['count']);?>)</span></a>
                            <?php endif;?>
                        </h3>
                    </div>
                    <div class="wp-block-body wp-block-property">
                        <div class="wp-block-img">
                                <img src="<?php echo _simg($item['thumbnail_url'], '380x250'); ?>" alt="">
                            <?php if(!empty($item['url'])) : ?>
                                <a href="<?php echo $item['url']; ?>"></a>
                            <?php else:?>
                                <a href=' <?php echo site_url_nosuff($lang_code.'/'.$this->data['page_id'].'/?search={"v_search_option_'.$treefield_id.'":"'.rawurlencode($item['title_chlimit'].' - ').'"}'); ?>'></a>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="wp-block-footer">
                    <div class="tf-item-dist">
                        <div class='treefield-category clearfix'>
                            <?php if (sw_count($item['childs_8']) > 0) foreach ($item['childs_8'] as $child): ?>
                                    <?php if(!empty($child['url'])): ?>
                                       <a class="treefield-box-item btn-default" href='<?php _che($child['url']); ?>'><?php _che($child['title']); ?> <span class="item-count">(<?php _che($child['count']);?>)</span></a>
                                    <?php else:?>
                                       <a class="treefield-box-item btn-default" href='<?php echo site_url_nosuff($lang_code.'/'.$this->data['page_id'].'/?search={"v_search_option_'.$treefield_id.'":"'.rawurlencode($item['title_chlimit'].' - '.$child['title'].' - ').'"}'); ?>'><?php _che($child['title']); ?> <span class="item-count">(<?php _che($child['count']);?>)</span></a>
                                    <?php endif;?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php if (sw_count($item['childs_more']) > 0): ?>    
                    <div class="tf-item-dist-other">
                        <div>
                            <span id='more_category' class="btn btn-sm btn-base">
                                <?php echo lang_check('More'); ?>:
                            </span>

                        </div>
                        <div class='tf-item-childs clearfix'>
                            <?php end($item['childs_more']);
                                  $lastElementKey = key($item['childs']);

                                  foreach ($item['childs_more'] as $key_c=>$child): ?>
                                <?php if(!empty($child['url'])): ?>
                                   <a class="treefield-box-item btn-default" href='<?php _che($child['url']); ?>'><?php _che($child['title']); ?> <span class="item-count">(<?php _che($child['count']);?>)</span></a>
                                <?php else:?>
                                   <a class="treefield-box-item btn-default"  href=' <?php echo site_url_nosuff($lang_code.'/'.$this->data['page_id'].'/?search={"v_search_option_'.$treefield_id.'":"'.rawurlencode($item['title_chlimit'].' - '.$child['title'].' - ').'"}'); ?>'><?php _che($child['title']); ?> <span class="item-count">(<?php _che($child['count']);?>)</span></a>
                                <?php endif;
                                if($lastElementKey != $key_c)echo '';
                                ?>

                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>  
                    </div>
                </div>
            </div>

            <?php
               if( ($key+1)%3==0 )
                {
                    echo '</div><div class="row">';
                }
                if( ($key+1)==sw_count($treefields) ) echo '</div>';
            ?>
        <?php endforeach; ?>
        </div>
    <?php endif;?>
    </div>
<?php endif;?>

<script>

    $('document').ready(function(){
        $('.treefield-item .tf-item-dist-other #more_category').on('click', function(){
            $(this).closest('.treefield-item').find('.tf-item-childs').slideToggle('fast');
            $('.treefield-item').not($(this).closest('.treefield-item')).find('.tf-item-childs').slideUp('fast')
        })
    })

</script>