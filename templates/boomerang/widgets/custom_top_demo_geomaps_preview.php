<?php

/*
 * Show dropdown with svg maps for demo preview
 * 
 * NOTE: Use on page with widget top_geosearchvisual.
 * 
 * Config: 
 * config_item('app_type') == 'demo'
 */

if(config_item('app_type') != 'demo' || $this->uri->uri_string() !='') return false;

$geo_map_prepared = array();
if( file_exists(FCPATH.'templates/'.$this->data['settings']['template'].'/assets/svg_maps/')) {
    $svg_files = array_diff( scandir(FCPATH.'templates/'.$this->data['settings']['template'].'/assets/svg_maps/'), array('..', '.'));
    
    foreach ($svg_files  as $svg) {
        $sql_o = file_get_contents(FCPATH.'templates/'.$this->data['settings']['template'].'/assets/svg_maps/'.$svg);
        $match = '';
        $title="";
        preg_match_all('/(data-title-map)=("[^"]*")/i', $sql_o, $match);
        $preview_link = $page_current_url.'?geo_map_preview='.basename($svg, '.svg');
        if(!empty($match[2])) {
            $title = trim(str_replace('"', '', $match[2][0]));
        } else if(stristr($sql_o, "http://amcharts.com/ammap") != FALSE ) {
            $match='';
            preg_match_all('/(SVG map) of ([^"]* -)/i', $sql_o, $match2);
            if(!empty($match2) && isset($match2[2][0])) {
                $title = str_replace(array(" -","High","Low"), '', $match2[2][0]);
            }
        }
        if(!empty($title)) {
            $data = array();
            $data['title'] = $title;
            $data['url'] = $preview_link;
            
            $icon='';
            
            $flag='';
            preg_match_all('/(flag_code)=("[^"]*")/i', $sql_o, $flag);
            if(isset($flag[2]) && !empty($flag[2])) {
                $flag = $flag[2][0];
                $flag = str_replace('"', '', $flag);
                $flag = trim($flag);
                if(file_exists(FCPATH.'templates/'.$this->data['settings']['template'].'/assets/img/flags/'.$flag.'.png')) {
                    $icon='assets/img/flags/'.$flag.'.png';
                } else {
                    continue;
                }
            }
            $data['icon'] = $icon;
            
            $geo_map_prepared[basename($svg, '.svg')]= $data;
        }
    }
}
asort($geo_map_prepared);

$current_label = array(
    'icon'=> 'assets/img/flags/globe.png',
    'title'=> lang_check('Map')
);

if(isset($geo_map_prepared['us'])) {
    $current_label = $geo_map_prepared['us'];
}

$geo_map_preview='';
if(isset($_GET['geo_map_preview']) &&  !empty($_GET['geo_map_preview'])) {
    $geo_map_preview = $page_current_url.'?geo_map_preview='.trim($_GET['geo_map_preview']);  
    
    if(isset($geo_map_prepared[trim($_GET['geo_map_preview'])])) {
        $current_label = $geo_map_prepared[trim($_GET['geo_map_preview'])];
    }
}

?>
<div class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 login-menu">
                <div class="geo_map_preview">
                    <label for="inputgeo_map"><?php echo lang_check('Select your country map:'); ?> </label>
                    <button class="btn-maplist" data-toggle="modal" data-target="#country-modal">
                        <?php if(!empty($current_label['icon'])):?>
                        <img src="<?php echo $current_label['icon'];?>">
                        <?php endif;?>
                        <span><?php echo $current_label['title'];?></span>
                        <i class="fa fa-caret-down"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $('#geo_map_preview').change(function(){
        var url = $(this).val();
        window.location.href=url;
    })
})
</script>


    <div class="modal fade modal-country-list" id="country-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo lang_check('Select country');?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-maps clearfix">
                        <?php foreach ($geo_map_prepared as $map):?>
                        <li class="col-md-3 col-sm-4">
                            <a href="<?php echo $map['url'];?>">
                                <?php if(!empty($map['icon'])):?>
                                <img src="<?php echo $map['icon'];?>">
                                <?php endif;?>
                                <span><?php echo $map['title'];?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    