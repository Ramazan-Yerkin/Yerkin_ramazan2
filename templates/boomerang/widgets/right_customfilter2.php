<?php
/*
Widget-title: Secondary form custom search
Widget-preview-image: /assets/img/widgets_preview/right_customfilter.jpg
 */
?>

<?php if(config_db_item('secondary_disabled') === TRUE): ?>
    SECONDARY FORM DISABLED
<?php else: ?>

<!-- FILTERS -->
<div class="panel panel-default panel-sidebar-1 filter-checkbox-container">
    <div class="panel-heading"><h2>{lang_CustomFilters}</h2></div>
    <div class="panel-body">
        <form class="form-light secondary-form">
           <?php  _search_form_secondary(2); ?>
           <div style="height: 10px; display: block;clear:both;">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-block btn-base btn-icon btn-icon-right btn-search refresh_filters">
                        <span>{lang_RefreshResults}</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>