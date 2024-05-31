    <?php foreach($agent_estates as $key=>$item): ?>
    <?php
        if($key==0)echo '<div class="row">';
    ?>
        <?php _generate_results_item(array('key'=>$key, 'item'=>$item)); ?>
    <?php
        if( ($key+1)%2==0 )
        {
            echo '</div><div class="row">';
        }
        if( ($key+1)==sw_count($agent_estates) ) echo '</div>';
        endforeach;
    ?>   
<div class="row-fluid clearfix text-center">
    <div class="pagination-ajax-results pagination wp-block default product-list-filters light-gray pagination">
       <?php echo $pagination_links_agent; ?>
    </div>
</div>