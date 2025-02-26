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
    
    
    $f_id = $field->id;
    $class_add = $field->class;
    if(empty($class_add))
        $class_add = ' col-sm-12';
    
?>

<div class="field-tree multiple <?php echo $class_add; ?>" style="<?php _che($field->style); ?>">
    <div class="form-group form-group-lg field_select">
        <select id="search_option_<?php echo $f_id; ?>_multi" class="form-control selectpicker base no-padding tree-input" multiple="multiple" title="<?php echo _l('Choose');?> <?php _che(${'options_name_'.$f_id}); ?>" placeholder="<?php _che(${'options_name_'.$f_id}); ?>">
            <?php _che(${'options_values_'.$f_id}); ?>
        </select>
    </div><!-- /.select-wrapper -->
</div><!-- /.form-group -->
