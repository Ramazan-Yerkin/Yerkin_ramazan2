<div class="wp-block pg-opt pg-opt-top">
    <h2 class="section-title left section-title-min"><?php _l('Results'); ?> : <?php echo $total_rows; ?></h2>
</div>
<!-- PAGINATION & FILTERS -->
<div class="wp-block default product-list-filters light-gray" style="padding:10px 15px">
    <div class="form-horizontal pull-left">
        <a style="" class="view-type <?php _che($view_grid_selected); ?>" ref="grid" href="#"><img src="assets/img/glyphicons/glyphicons_156_show_thumbnails.png" /></a>
        <a style="" class="view-type <?php _che($view_list_selected); ?>" ref="list" href="#"><img src="assets/img/glyphicons/glyphicons_157_show_thumbnails_with_lines.png" /></a>
    </div>
    <div class="filter sort-filter pull-right">
        <label><?php _l('OrderBy'); ?></label>
        <select class="selectpicker-small" style="margin-right:0;">
            <option value="id ASC" <?php _che($order_dateASC_selected); ?>><?php _l('DateASC'); ?></option>
            <option value="id DESC" <?php _che($order_dateDESC_selected); ?>><?php _l('DateDESC'); ?></option>
            <option value="price ASC" <?php _che($order_priceASC_selected); ?>><?php _l('PriceASC'); ?></option>
            <option value="price DESC" <?php _che($order_priceDESC_selected); ?>><?php _l('PriceDESC'); ?></option>
        </select>
    </div>
</div>
    {has_no_results}
    <div class="result-answer">
        <div class="alert alert-success">
            {lang_Noestates}
        </div>
    </div>
    {/has_no_results}
{has_view_grid}
<!-- PROPERTY LISTING -->
<?php foreach($results as $key=>$item): ?>
<?php
    if($key==0)echo '<div class="row">';
?>
    <?php _generate_results_item(array('key'=>$key, 'item'=>$item)); ?>
<?php
    if( ($key+1)%2==0 )
    {
        echo '</div><div class="row">';
    }
    if( ($key+1)==sw_count($results) ) echo '</div>';
    endforeach;
?>
{/has_view_grid}

{has_view_list}
<?php _widget('properties_list');?>
{/has_view_list}
<!-- PAGINATION & FILTERS -->
<div class="row-fluid clearfix text-center">
    <div class="pagination properties wp-block default product-list-filters light-gray">
       <?php echo $pagination_links; ?>
    </div>
</div>