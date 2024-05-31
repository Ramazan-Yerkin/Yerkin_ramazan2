<?php
/*
Widget-title: Main menu with Logo 
Widget-preview-image: /assets/img/widgets_preview/header_mainmenu.jpg
*/
?>

<!-- MAIN NAV -->
    <div class="navbar navbar-fixed navbar-wp navbar-arrow mega-nav" data-spy="affix2" data-offset-top="150">
        <div class="container">
            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle navbar-toggle-aside-menu">
                    <i class="fa fa-outdent icon-custom"></i>
                </button>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars icon-custom"></i>
                </button>
                <a class="navbar-brand" href="{homepage_url_lang}" title="{settings_websitetitle}">
                    <img src="<?php echo $website_logo_url; ?>" alt="{settings_websitetitle}">
                </a>
            </div>
            
                <div class="top-header">
                    <nav class="top-header-menu">
                        <ul class="top-menu">
                            <li class="aux-languages dropdown <!-- animate-hover -->" data-animate-in="<!-- animated bounceIn -->">
                                <?php
                                     $lang_array = $this->language_m->get_array_by(array('is_frontend'=>1));
                                     if(sw_count($lang_array) > 1):
                                 ?> 
                                <?php   
                                    $flag_icon = '';
                                    if(file_exists(FCPATH.'templates/'.$settings_template.'/assets/img/flags/'.$this->data['lang_code'].'.png'))
                                    {
                                        $flag_icon = '&nbsp; <img class="flag-icon" src="'.'assets/img/flags/'.$this->data['lang_code'].'.png" alt="" />';
                                    }

                                    ?>
                                
                                    <a href="#"><span class="language name"><?php echo $this->data['lang_code'].' '.$flag_icon;?></span></a>
                                    <?php 
                                      echo get_lang_menu($this->language_m->get_array_by(array('is_frontend'=>1)), $this->data['lang_code'], 'id="auxLanguages" class="sub-menu"');
                                    ?>
                                    <?php endif;?>
                        </ul>
                    </nav>
                </div>
            
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown-aux hidden-xs">
                        <a href="#" id="cmdAsideMenu" class="dropdown-toggle dropdown-form-toggle" title="Open sidebar">
                            <i class="fa fa-outdent"></i>
                        </a>
                    </li>
                </ul>   
                
                <?php
               if ( ! function_exists('get_menu_custom'))
               {
               //menu generate function
               function get_menu_custom ($array, $child = FALSE, $lang_code='en')
               {
                       $CI =& get_instance();
                       $str = '';

                   $is_logged_user = ($CI->user_m->loggedin() == TRUE);

                       if (sw_count($array)) {
                           $str .= $child == FALSE ? '<ul class="nav navbar-nav navbar-right">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;
                                               $position = 0;
                               foreach ($array as $key=>$item) {
                                       $position++;

                           $active = $CI->uri->segment(2) == url_title_cro($item['id'], '-', TRUE) ? TRUE : FALSE;

                           if($position == 1 && $child == FALSE){
                               //$item['navigation_title'] = '<img src="assets/img/home-icon.png" alt="'.$item['navigation_title'].'" />';

                               if($CI->uri->segment(2) == '')
                                   $active = TRUE;
                           }

                           if($item['is_visible'] == '1')
                           if(empty($item['is_private']) || $item['is_private'] == '1' && $is_logged_user)
                                       if (isset($item['children']) && sw_count($item['children'])) {

                               $href = slug_url($lang_code.'/'.$item['id'].'/'.url_title_cro($item['navigation_title'], '-', TRUE), 'page_m');
                               if(substr($item['keywords'],0,4) == 'http')
                                   $href = $item['keywords'];
                                   
                               if(substr($item['keywords'],0,6) == 'search')
                               {
                                    $href = $href.'?'.$item['keywords'];
                                    $href = str_replace('"', '%22', $href);
                                    if(config_item('json_url_encoding')!==FALSE){
                                        $href = str_replace('}', '%7D', $href);
                                        $href = str_replace('{', '%7B', $href);
                                    }
                               }
                               
                                $target = '';
                                if(substr($item['keywords'],0,4) == 'http')
                                {
                                    $href = $item['keywords'];
                                    if(substr($item['keywords'],0,10) != substr(site_url(),0,10))
                                    {
                                        $target=' target="_blank"';
                                    }
                                }
                                   
                               if($item['keywords'] == '#')
                                   $href = '#';

                                               $str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
                                               $str .= '<a href="' . $href . '" class="dropdown-toggle" data-toggle="dropdown" '.$target.'>' . $item['navigation_title'];
                                               $str .= '</a>' . PHP_EOL;

                                               $str .= get_menu_custom($item['children'], TRUE, $lang_code);
                                       }
                                       else {

                               $href = slug_url($lang_code.'/'.$item['id'].'/'.url_title_cro($item['navigation_title'], '-', TRUE), 'page_m');
                               if(substr($item['keywords'],0,4) == 'http')
                                   $href = $item['keywords'];
                                   
                               if(substr($item['keywords'],0,6) == 'search')
                               {
                                    $href = $href.'?'.$item['keywords'];
                                    $href = str_replace('"', '%22', $href);
                                    if(config_item('json_url_encoding')!==FALSE){
                                        $href = str_replace('}', '%7D', $href);
                                        $href = str_replace('{', '%7B', $href);
                                    }
                               }
                               
                                $target = '';
                                if(substr($item['keywords'],0,4) == 'http')
                                {
                                    $href = $item['keywords'];
                                    if(substr($item['keywords'],0,10) != substr(site_url(),0,10))
                                    {
                                        $target=' target="_blank"';
                                    }
                                }

                               if($item['keywords'] == '#')
                                   $href = '#';

                                               $str .= $active ? '<li class="active">' : '<li>';
                                               $str .= '<a href="' . $href . '" '.$target.'>' . $item['navigation_title'] . '</a>';

                                       }
                                       $str .= '</li>' . PHP_EOL;
                               }

                               $str .= '</ul>' . PHP_EOL;
                       }

                       return $str;
               }
               }
               ?>
               <?php
                   $CI =& get_instance();
                   echo get_menu_custom($CI->temp_data['menu'], FALSE, $lang_code);
               ?>
             
               
            </div><!--/.nav-collapse -->
        </div>
    </div>
    <div class="slice bg-white">
        <div class="container">
            <?php echo print_breadcrump(null, ' > ', 'class="breadcrumb nav"');?>
        </div>
    </div>