<?php
/*
Widget-title: Agents widget
Widget-preview-image: /assets/img/widgets_preview/right_agents.jpg
 */
?>

<div id="agents-block" class="section-title-wr pg-opt" style="padding-bottom: 15px;">
    <h3 class="section-title left"><span><?php _l('Search');?></span></h3>
</div>
<div class="widget">
    <form class="form-light form-search agents" action="<?php echo current_url().'#agents-block'; ?>" method="get">
        <div class="input-group">
            <input type="text" name="search-agent"  class="form-control input-medium"  value="<?php echo $this->input->get('search-agent'); ?>"  placeholder="{lang_CityorName}">
            <span class="input-group-btn">
                <button id="" class="btn btn-base"  type="submit">{lang_Search}</button>
            </span>
        </div>
    </form>
</div>
<div class="panel">
     <?php foreach($paginated_agents as $item): ?>
    <div class="wp-block testimonial style-1 base right-agents">
        <div class="testimonial-author light">  
            <div class="author-img">
                <a href="<?php  _che($item['agent_url']);?>">
                    <img src="<?php echo _simg($item['image_url'], '75x75'); ?>" alt="<?php  _che($item['name_surname']);?>">
                </a>
            </div>
            <div class="author-info">
                <span class="author-name"><a href="<?php  _che($item['agent_url']);?>"><?php  _che($item['name_surname']);?></a></span>
                <small class="author-pos"><?php  _che($item['phone']);?></small>
                <small class="author-pos"><a href="mailto:<?php  _che($item['mail']);?>" title="<?php  _che($item['mail']);?>"><?php  _che($item['mail']);?></a></small>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>