<?php
/*
Widget-title:  List of maps (NOTE: Use on page with widget top_geosearchvisual)
Widget-preview-image: /assets/img/widgets_preview/center_demomaps.jpg
 */


/*
 * 
 * NOTE: Use on page with widget top_geosearchvisual.
 * 
 * Config: 
 * config_item('app_type') == 'demo'
 */

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
            
            $geo_map_prepared[]= $data;
        }
    }
}
asort($geo_map_prepared);
?>

<?php if(search_value(79)) : ?>
<?php _widget('center_recentproperties');?>  
<?php else: ?>
<div class="results_conteiner">
    <div class="section-title-wr pg-opt style-title">
        <h2 class="section-title left section-title-min"><span><?php _l('Select map'); ?></span></h2>
    </div>
    <ul class="list-maps clearfix row">
        <?php foreach ($geo_map_prepared as $map):?>
        <li class="col-md-4 col-sm-6">
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
<?php endif;?>