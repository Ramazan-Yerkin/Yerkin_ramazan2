/* [START] Dependent fields */
$(document).ready(function(){
    <?php 
    $CI =& get_instance();
    $CI->load->model('dependentfield_m');
    $dependent_fields = $CI->dependentfield_m->get();
    $dependent_fields_prepare = array();
    foreach($dependent_fields as $key_d_field=>$d_field)
    {
        $dependent_fields_prepare[$d_field->field_id][$d_field->selected_index] = $d_field->hidden_fields_list;
    }

    $id_lang = $lang_id;

    foreach($dependent_fields_prepare as $d_field_id=>$d_field_indexes):
    ?>
    $("form.search-form select[name='option<?php echo $d_field_id.'_'.$id_lang; ?>'], "+
      "form.search-form input[rel][name='option<?php echo $d_field_id.'_'.$id_lang; ?>']").change(function () {

        var index = $(this).children('option:selected').index();
        var parent_elem = $(this).parent().parent().parent();
        var parent_elem_hide = $(this).parent().parent();

        var index_tree = $(this).attr('rel');
        if (typeof index_tree !== typeof undefined && index_tree !== false) {
          index = index_tree;
          parent_elem = parent_elem.parent();
          parent_elem_hide = parent_elem_hide.parent();
        }

        $('.dependenthide').removeClass('dependenthide');
        
                
                
        <?php if(config_item('auto_category_display_fields') !== FALSE):?>
        if(index == '') {
            if($('form.secondary-form').length) {
                $('form.secondary-form').find('input,select').closest('.form-group,.secondary-checkbox').addClass('dependenthide');
            }
        }
        <?php endif;?>

        if (typeof index_tree !== typeof undefined && index_tree !== false) {
          $(this).parent().parent().find('select').each(function(){
            if($(this).val() != '')
            {
                hide_related_<?php echo $d_field_id.'_'.$id_lang; ?>(parent_elem, parent_elem_hide, $(this).val());
            }
          });
        }
        else
        {
            hide_related_<?php echo $d_field_id.'_'.$id_lang; ?>(parent_elem, parent_elem_hide, index);
        }

    });


    function hide_related_<?php echo $d_field_id.'_'.$id_lang; ?>(parent_elem, parent_elem_hide, index)
    {
        <?php foreach($d_field_indexes as $d_selected_index=>$d_hidden_fields_list): ?>
        if(index == '<?php echo $d_selected_index; ?>')
        {
            <?php 
            $hidden_fields_list = explode(',', $d_hidden_fields_list);
            $generate_selector_list = array();
            $generate_selector = '';
            foreach($hidden_fields_list as $hide_field_id)
            {
                $generate_selector_list[] = "#search_option_".$hide_field_id."_from";
                $generate_selector_list[] = "#search_option_".$hide_field_id."_to";
                $generate_selector_list[] = "#search_option_".$hide_field_id;
                $generate_selector_list[] = "[option_id='".$hide_field_id."']";
            }
            $generate_selector = implode(',', $generate_selector_list);
            ?>

            $("<?php echo $generate_selector; ?>").not('.skip-input').each( function() {
                if(this.type=='text' || this.type=='textarea'){
                    this.value = '';
                }
                else if(this.type=='radio' || this.type=='checkbox'){
                    this.checked=false;
                }
                else if(this.type=='select-one' || this.type=='select-multiple'){
                    this.value ='';
                    if(this.value != '')this.value ='-';
                }
                else if(this.type == 'hidden')
                {
                    this.value ='';
                }
            });

            $("<?php echo $generate_selector; ?>").each( function() {
                if(this.type=='text' || this.type=='textarea'){
                    $(this).parent().not('form.search-form').addClass('dependenthide');
                }
                else if(this.type=='radio' || this.type=='checkbox'){
                    $(this).parent().parent().not('form.search-form').addClass('dependenthide');
                }
                else if(this.type=='select-one' || this.type=='select-multiple'){
                    $(this).parent().not('form.search-form').addClass('dependenthide');
                }
                else if(this.type == 'hidden')
                {
                    $(this).parent().not('form.search-form').addClass('dependenthide');
                }

            });


            if($('form.secondary-form div:not(.dependenthide) input[option_id]').length == 0)
            {
            }

        }
        <?php endforeach; ?>
    }

    <?php endforeach; ?>

    $(".search-form .TREE-GENERATOR select").trigger('change');

});

/* [END] Dependent fields */