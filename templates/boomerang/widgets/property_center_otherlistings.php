                        <?php if(sw_count($agent_estates) > 0): ?>
                        <div class="wp-block pg-opt">
                        <h2 class="title">{lang_Agentestates}</h2>
                        </div>
                        <div id="ajax_results">
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
                             <div class="pagination-ajax-results pagination properties wp-block default product-list-filters light-gray pagination" rel="ajax_results">
                                <?php echo $pagination_links_agent; ?>
                             </div>
                         </div>
                         </div>
                        <?php endif;?>
                        <br style="clear:both;" />