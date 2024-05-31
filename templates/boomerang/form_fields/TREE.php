<?php if(config_item('tree_field_enabled') === TRUE):?>

<?php
    $col=6;
    $f_id = $field->id;
    $placeholder = _ch(${'options_name_'.$f_id});
    $direction = $field->direction;
    if($direction == 'NONE'){
        $col=12;
        $direction = '';
    }
    else
    {
        $placeholder = lang_check($direction);
        $direction=strtolower('_'.$direction);
    }
    
    $suf_pre = _ch(${'options_prefix_'.$f_id}, '')._ch(${'options_suffix_'.$f_id}, '');
    if(!empty($suf_pre))
        $suf_pre = ' ('.$suf_pre.')';
        
    $class_add = $field->class;
    if(empty($class_add))
        $class_add = ' col-sm-'.$col;
    
?>

<script>
    
    /* [START] TreeField */
  
    $(function() {
        $(".search-form .TREE-GENERATOR#TREE-GENERATOR_ID_<?php echo $f_id;?> select").change(function(e, trigger){
            console.log('change');
            if (typeof trigger === 'undefined') trigger = [];
            
            var s_value = $(this).val();
            var s_name_splited = $(this).attr('name').split("_"); 
            var s_level = parseInt(s_name_splited[3]);
            var s_lang_id = s_name_splited[1];
            var s_field_id = s_name_splited[0].substr(6);
            
            if(trigger.isTrigger)
                load_by_field($(this), true, trigger.s_values_splited);
            else
                load_by_field($(this));
                
            var generated_val = '';
            var last_selected_numeric = '';
            $(this).parent().parent()
            .find('select').each(function(index){
                if(index > s_level)
                {
                    if(!trigger.isTrigger) {
                        $(this).find("option:gt(0)").remove();
                        $(this).val('');
                        $(this).selectpicker('refresh');
                    }
                }
                else
                {
                    last_selected_numeric = $(this).val();
                    generated_val+=$(this).find("option:selected").text()+" - ";
                }    
            });
            $("#sinputOption_"+s_lang_id+"_"+s_field_id).val(generated_val);
            
            $("#inputOption_"+s_lang_id+"_"+s_field_id).attr('rel', last_selected_numeric);
            $("#inputOption_"+s_lang_id+"_"+s_field_id).val(generated_val);
            $("#inputOption_"+s_lang_id+"_"+s_field_id).trigger("change");

        });
        
        

    });
    
    function load_by_field(field_element, autoselect_next, s_values_splited, first_load)
    {
        if (typeof first_load === 'undefined') first_load = false;
        if (typeof autoselect_next === 'undefined') autoselect_next = false;
        if (typeof s_values_splited === 'undefined') s_values_splited = [];
        
       /* console.log('load_by_field');*/
        var s_value = field_element.val();
        var s_name_splited = field_element.attr('name').split("_"); 
        var s_level = parseInt(s_name_splited[3]);
        var s_lang_id = s_name_splited[1];
        var s_field_id = s_name_splited[0].substr(6);
        
       
        var ajax_indicator = field_element.parent().parent().parent().find('.ajax_loading');
        var select_element = $("select[name=option"+s_field_id+"_"+s_lang_id+"_level_"+parseInt(s_level+1)+"]");
        if(select_element.length > 0 && s_value != '')
        {
            ajax_indicator.css('display', 'block');
            $.getJSON( "<?php echo site_url('api/get_level_values_select'); ?>/"+s_lang_id+"/"+s_field_id+"/"+s_value+"/"+parseInt(s_level+1), function( data ) {
                ajax_indicator.css('display', 'none');
                
                select_element.html(data.generate_select);
                select_element.selectpicker('refresh');
                
                if(autoselect_next)
                {
                    if(s_values_splited[s_level+1] != '')
                    {
                        var id = select_element.find('option').filter(function () { return $(this).html() == s_values_splited[s_level+1]; }).attr('selected', 'selected').val();
                        select_element.selectpicker('val', id);
                        load_by_field(select_element, true, s_values_splited);
                        
                    }
                }
                if(first_load === true){
                    var trigger = {'isTrigger' : true, 's_values_splited':s_values_splited};
                    $(".search-form .TREE-GENERATOR#TREE-GENERATOR_ID_<?php echo $f_id;?>").find('select:first').trigger('change', [trigger]);
                }
                
            })
            <?php if(config_item('auto_category_display')=== TRUE):?>
            .success(function(data){
                var count = 0;
                var i;
                for (i in data.values_arr) {
                    if (data.values_arr.hasOwnProperty(i)) {
                        count++;
                    }
                }
                if(field_element.val() !='' &&  count > 1) {
                    field_element.closest('.field-tree').next().show();
                } else {
                    field_element.closest('.field-tree').nextAll().hide().find('select').val('');
                }
            });
            <?php endif;?>
        } else {
            <?php if(config_item('auto_category_display')=== TRUE):?>
            field_element.closest('.field-tree').nextAll().hide().find('select').val('');
            <?php endif;?>
        }
        
    }
    
    /* [END] TreeField */

</script>

<!-- [START] TreeSearch -->
<?php if(config_item('tree_field_enabled') === TRUE):?>
<div class=" <?php echo $class_add; ?>" style="<?php _che($field->style); ?>">
    <div class="form-group form-group-lg field_select">
<?php

    $CI =& get_instance();
    $CI->load->model('treefield_m');
    $field_id = $f_id;
    $drop_options = $CI->treefield_m->get_level_values($lang_id, $field_id);
    $drop_selected = array();
    echo '<div class="tree TREE-GENERATOR" id="TREE-GENERATOR_ID_'.$f_id.'">';
    echo '<div class="field-tree">';
    echo form_dropdown('option'.$field_id.'_'.$lang_id.'_level_0', $drop_options, $drop_selected, 'class="form-control selectpicker base no-padding tree-input" id="sinputOption_'.$lang_id.'_'.$field_id.'_level_0'.'"');
    echo '</div>';

    $levels_num = $CI->treefield_m->get_max_level($field_id);
    
    if($levels_num>0)
    for($ti=1;$ti<=$levels_num;$ti++)
    {
        $lang_empty = lang('treefield_'.$field_id.'_'.$ti);
        if(empty($lang_empty))
            $lang_empty = lang_check('Please select parent');
        
        echo '<div class="field-tree">';
        echo form_dropdown('option'.$field_id.'_'.$lang_id.'_level_'.$ti, array(''=>$lang_empty), array(), 'class="form-control selectpicker base no-padding tree-input" id="sinputOption_'.$lang_id.'_'.$field_id.'_level_'.$ti.'"');
        echo '</div>';
    }
    echo '</div>';

?>
    </div><!-- /.select-wrapper -->
</div><!-- /.form-group -->

                <script>
                
            $(window).load(function()  {
                    var load_val = '<?php echo search_value($field_id); ?>';
                    var s_values_splited = (load_val+" ").split(" - "); 
                    var first_load = true;
                    if(s_values_splited[0] != '')
                    {
                        var first_select = $('.TREE-GENERATOR#TREE-GENERATOR_ID_<?php echo $f_id;?>').find('select:first');
                        var id = first_select.find('option').filter(function () { return $(this).html() ==  s_values_splited[0]; }).attr('selected', 'selected').val();
                        if(!id && s_values_splited[0].indexOf('&')>=0) {
                            s_values_splited[0] =  s_values_splited[0].replace(/&/g, "&amp;");
                            id = first_select.find('option').filter(function () { return $(this).html() == s_values_splited[0]; }).attr('selected', 'selected').val();
                        }
                        /* test fix */
                        first_select.val(id);
                        first_select.selectpicker('refresh');
                        /* end test fix */
                        
                        load_by_field(first_select, true, s_values_splited, first_load);
                        first_load = false;
                    }
                    
                });
                
                </script>

<?php endif; ?>
<!-- [END] TreeSearch -->

<?php 

echo form_input('option' . $field_id . '_' . $lang_id, '', 'class="form-control tree-input-value hidden skip" id="inputOption_' . $lang_id . '_' . $field_id . '" rel=""'); 

?>

<?php endif; ?>

<?php if(config_item('auto_category_display')=== TRUE):?>
<style type="text/css">
    #TREE-GENERATOR_ID_<?php echo $f_id;?> .field-tree:not(:first-child) {
        display: none;
    } 
</style>
<?php endif;?>