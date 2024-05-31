<?php
/*
Widget-title: Featured properties grid
Widget-preview-image: /assets/img/widgets_preview/center_recentproperties.jpg
*/
?>

<div class="results_conteiner">
<div class="wp-block pg-opt">
    <h2 class="title">{page_title}</h2>
</div>
<!-- PROPERTY LISTING -->
<?php foreach($featured_properties as $key=>$item): ?>
<?php
    if($key==0)echo '<div class="row">';
?>
    <?php _generate_results_item(array('key'=>$key, 'item'=>$item, 'columns'=>3)); ?>
<?php
    if( ($key+1)%3==0 )
    {
        echo '</div><div class="row">';
    }
    if( ($key+1)==sw_count($featured_properties) ) echo '</div>';
    endforeach;
?>
</div>