<!-- SLIDEBAR -->

<?php
/*
 * 
 * Hidden and encoding string (for robots), add decoding btn for user
 * 
 * @param $str (string)  string for hiden
 * @param $class (string) css class`es
 * @param $preview_length (int), max preview character
 * 
 * return html string  (<div id="%id%" class="%$class%">
                            <span class="val_protected_mask">%$str%xxxxxxx</span> 
                            <a href="#" class="val_protected_spoiler">show</a>
                        </div>)
 */

if ( ! function_exists('anti_spam_field'))
{
    function anti_spam_field($str=NULL, $class='', $preview_length=2)
    { 
      if($str === NULL) return false;  
      $type ='';

      // set type mail if mail
      if(filter_var($str, FILTER_VALIDATE_EMAIL))
        $type = 'mail';

      $character_set = "+-.,0123456789@() ~!#$%^&*?ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz";

      $key = str_shuffle($character_set); 
      $cipher_text = ''; $id = 'e'.rand(1,999999999);
      for ($i=0;$i<strlen($str);$i+=1) {
        //check string and skip, if not avaible character
        if(strpos($character_set, $str[$i]) !== FALSE )
            $cipher_text.= $key[strpos($character_set,$str[$i])];
      }

      $script = '$("#'.$id.' .val_protected_spoiler").click(function(e){e.preventDefault();';
      $script.= 'var str = "'.$key.'";var length="'.$cipher_text.'";';
      $script.= 'var character_un = "'.$character_set.'";var r="";';
      $script.= 'for(var e=0;e<length.length;e++)r+=character_un.charAt(str.indexOf(length.charAt(e)));';
      $script.= '$(this).parent().find(".val_protected_mask").remove();';

      if($type == 'mail')
        $script.= 'var x = "<a href=\\"mailto:"+r+"\\">"+r+"</a>";';
      else 
        $script.= 'var x = "<span>"+r+"</span>";';

      $script.= '$(this).parent().prepend(x);$(this).remove();})';
      $script = '<script>'.$script.'</script>';

      return '<span id="'.$id.'" class="'.$class.'"><span class="val_protected_mask">'.substr($str, 0, $preview_length).'xxxxxx</span> <a href="#" class="val_protected_spoiler">'.lang_check('unhide').'</a></span>'.$script;
    }
}
?>

<section id="asideMenu" class="aside-menu right">
    <form class="form-horizontal form-search">
        <div class="input-group">
            <span class="input-group-btn text-right">
                <button id="btnHideAsideMenu" class="btn btn-close" type="button" title="Hide sidebar"><i class="fa fa-times"></i></button>
            </span>
        </div>
    </form>
    <h5 class="side-section-title"><?php _l('Social media');?></h5>
    <div class="social-media">
        <a href="#" data-url='{homepage_url}' data-title='{settings_websitetitle}' class="btn-share-fb"><i class="fa fa-facebook facebook"></i></a>
        <a href="#" data-url='{homepage_url}'  class="btn-share-google-plus"><i class="fa fa-google-plus google"></i></a>
        <a href="#" data-url='{homepage_url}' data-title='{settings_websitetitle}' class="btn-share-tw"><i class="fa fa-twitter twitter"></i></a>
    </div>
    
    <h5 class="side-section-title">{lang_Contactus}</h5>
    <div class="contact-info">
        <h5><?php _l('Address');?></h5>
        <p>{settings_address_footer}</p>
        
        <h5><?php _l('Email');?></h5>
        <p> <?php echo anti_spam_field($settings_email); ?> </p>
        
        <h5><?php _l('Phone');?></h5>
        <p> <?php echo anti_spam_field($settings_phone); ?> </p>
        
        <h5><?php _l('Fax');?></h5>
        <p> <?php echo anti_spam_field($settings_fax); ?> </p>

    </div>
</section>
