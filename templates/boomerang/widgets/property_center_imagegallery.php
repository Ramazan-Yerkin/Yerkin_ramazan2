<?php
/*  The Gallery as lightbox dialog, should be a child element of the document body 
*    use css/blueimp-gallery.min.css
*    use js/blueimp-gallery.min.js
*    use config assets/js/realsite.js
*   site https://github.com/blueimp/Gallery/blob/master/README.md#setup
*/
?>

{has_page_images}
<script>
    $(document).ready(function(){
        if (!$('#blueimp-gallery').length)
        $('body').append('<div id="blueimp-gallery" class="blueimp-gallery">\n\
                            <div class="slides"></div>\n\
                            <h3 class="title"></h3>\n\
                            <a class="prev">&lsaquo;</a>\n\
                            <a class="next">&rsaquo;</a>\n\
                            <a class="close">&times;</a>\n\
                            <a class="play-pause"></a>\n\
                            <ol class="indicator"></ol>\n\
                            </div>')
    })
</script>

<div class="wp-block pg-opt">
<h2 class="title">{lang_Imagegallery}</h2>
</div>
<ul data-target="#modal-gallery" data-toggle="modal-gallery" class="files files-list ui-sortable content-images">  
    <?php foreach ($page_images as $val):?>
    <li class="template-download fade in">
        <a data-gallery="gallery" href="<?php _che($val->url);?>" title="<?php _che($val->filename);?>" download="<?php _che($val->url);?>" class="preview show-icon" alt="<?php echo $val->alt;?>">
            <img src="assets/img/preview-icon.png" class="" />
        </a>
        <div class="preview-img"><img src="<?php echo _simg($val->thumbnail_url, '215x150');?>" data-src="<?php _che($val->url);?>" alt="<?php _che($val->filename);?>" class="" alt="<?php echo $val->alt;?>" /></div>
    </li>
    <?php endforeach;?>
</ul>
<br style="clear: both;" />
{/has_page_images}       