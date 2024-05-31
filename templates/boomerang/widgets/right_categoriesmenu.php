<?php
/*
Widget-title: Categories menu
Widget-preview-image: /assets/img/widgets_preview/right_categoriesmenu.jpg
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

$treefields = array();

$check_option= $CI->option_m->get_by(array('id'=>$treefield_id));
// check if option exists
if(!$check_option)
    return false;

if($check_option[0]->type!='TREE')
    return false;

$tree_listings = $CI->treefield_m->get_table_tree($lang_id, $treefield_id, NULL, FALSE, '.order', ',image_filename');

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
    $treefields[] = $treefield;
}

$active_first = '';
$active_second = '';
if(search_value($treefield_id)) {

   $active = search_value($treefield_id);
   $active = explode('-', $active);
   $active_first = trim($active[0]);
   $active_second = trim($active[1]);
}

?>

<div class="panel panel-default panel-sidebar-1">
    <div class="panel-heading"><h2><?php echo _l('Categories');?></h2></div>
    <div class="panel-body">
        <ul class="nav nav-stacked right_categoriesmenu nav-pills" id="right_categoriesmenu">
            <?php foreach ($treefields as $key=>$item): ?>
            <li class="<?php echo ($active_first== $item['title']) ? 'active' : '';?>">
                
                <?php if (sw_count($item['childs']) > 0):?>
                <div class="nav-item"> 
                    <a data-toggle="collapse" data-parent="#right_categoriesmenu" href="#submenu<?php echo $key;?>"><i class="fa fa-chevron-right menu-icon"></i></a>
                    <a href='<?php _che($item['url']); ?>' class="nav-item-page"><span class="item"><?php _che($item['title']); ?> </span> <span class="item-count">(<?php _che($item['count']);?>)</span></a>
                </div>
                <?php else:?>
                <div class="nav-item"> 
                    <a data-toggle="collapse" data-parent="#right_categoriesmenu" href="#"><i class="fa fa-chevron-right menu-icon"></i></a>
                    <a href='<?php _che($item['url']); ?>' class="nav-item-page"><span class="item"><?php _che($item['title']); ?> </span> <span class="item-count">(<?php _che($item['count']);?>)</span></a>
                </div>
                <?php endif;?>

                <?php if (sw_count($item['childs']) > 0):?>
                <ul id="submenu<?php echo $key;?>" class="nav-pills collapse <?php echo ($active_first == $item['title'] || ($key==0 && empty($active_first))) ? 'in' : '';?>">
                <?php foreach ($item['childs'] as $child): ?>
                    <li  class="<?php echo ($active_second == $child['title']) ? 'active' : '';?>">
                    <?php if(!empty($child['url'])): ?>
                        <a href="<?php _che($child['url']); ?>"><i class="fa fa-link"></i> <?php _che($child['title']); ?> <span class="item-count">(<?php _che($child['count']);?>)</span></a>
                    <?php else:?>
                        <a href='<?php echo site_url_nosuff($lang_code.'/'.$this->data['page_id'].'/?search={"v_search_option_'.$treefield_id.'":"'.rawurlencode($item['title_chlimit'].' - '.$child['title'].' - ').'"}'); ?>'><i class="fa fa-link"></i> <?php _che($child['title']); ?> <span class="item-count">(<?php _che($child['count']);?>)</span></a>
                    <?php endif;?>
                    </li>
                <?php endforeach; ?>
                </ul>
                <?php endif;?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>