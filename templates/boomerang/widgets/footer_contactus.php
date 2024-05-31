<?php
/*
Widget-title: Contact information company
Widget-preview-image: /assets/img/widgets_preview/footer_contactus.jpg
 */
?>

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

      if(filter_var($str, FILTER_VALIDATE_EMAIL))
        $type = 'mail';

      $character_set = "+-.,0123456789@() ~!#$%^&*?ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz";

      $key = str_shuffle($character_set); 
      $cipher_text = ''; $id = 'e'.rand(1,999999999);
      for ($i=0;$i<strlen($str);$i+=1) {
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

<div class="col-md-4">
    <div class="col">
       <h4>{lang_Contactus}</h4>
       <ul>
            <li>{settings_address_footer}</li>
            <li><?php _l('Phone');?>: <?php echo anti_spam_field($settings_phone); ?> </li>
            <li><?php _l('Fax')?>: <?php echo anti_spam_field($settings_fax); ?> </li>
            <li><?php _l('Email');?>: <?php echo anti_spam_field($settings_email); ?></li>
        </ul>
     </div>
</div>