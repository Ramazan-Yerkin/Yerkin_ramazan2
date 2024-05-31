<?php

$similar_estates = array();

$CI =& get_instance();

$where = array();
$where['language_id']  = $lang_id;
$where['is_activated'] = 1;
if(isset($CI->data['settings_listing_expiry_days']))
{
    if(is_numeric($CI->data['settings_listing_expiry_days']) && $CI->data['settings_listing_expiry_days'] > 0)
    {
         $where['property.date_modified >']  = date("Y-m-d H:i:s" , time()-$CI->data['settings_listing_expiry_days']*86400);
    }
}

//where (similar properties) price, purpose, county
if(!empty($estate_data_option_37))
{
    $where['field_37_int >'] = 0.7*$estate_data_option_37;
    $where['field_37_int <'] = 1.3*$estate_data_option_37;
}
    
if(!empty($estate_data_option_36))
{
    $where['field_36_int >'] = 0.7*$estate_data_option_36;
    $where['field_36_int <'] = 1.3*$estate_data_option_36;
}
    
if(!empty($estate_data_option_4))
{
    $where['field_4'] = $estate_data_option_4;
}

$where['is_activated'] = 1;
$where['property.id !='] = $property_id;

$similar_estates = $CI->estate_m->get_by($where, FALSE, 6, 'RAND()', 0, array(), NULL);

$similar_estates_array = array();
$CI->generate_results_array($similar_estates, $similar_estates_array, $options_name);

if(sw_count($similar_estates_array) > 0): ?>
<div class="wp-block pg-opt">
<h2 class="title"><?php _l('Similar properties'); ?></h2>
</div>
<div>
<?php 
foreach($similar_estates_array as $key=>$item): ?>
<?php
   if($key==0)echo '<div class="row">';
?>
<?php _generate_results_item(array('columns'=>3, 'key'=>$key, 'item'=>$item, 'icons'=>false, 'view_counter'=>false)); ?>
<?php
    if( ($key+1)%3==0 )
    {
        echo '</div><div class="row">';
    }
    if( ($key+1)==sw_count($similar_estates_array) ) echo '</div>';
    endforeach;
?>

</div>
<?php endif;?>