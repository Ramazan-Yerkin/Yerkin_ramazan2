<?php if(file_exists(APPPATH.'controllers/admin/booking.php')):?>
<div class="row-fluid clearfix form-group-data" >
<div class="col-sm-6" style="text-">
    <div class="form-group form-group-lg field_select field_select_booking_date_from">
        <input id="booking_date_from" type="text" class="form-control noavtoWidth" value="<?php echo search_value('date_from'); ?>"  placeholder="<?php _l('Fromdate'); ?>" autocomplete="off" />
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group form-group-lg field_select field_select_booking_date_to">
        <input id="booking_date_to" type="text" class="form-control noavtoWidth" value="<?php echo search_value('date_to'); ?>"  placeholder="<?php _l('Todate'); ?>" autocomplete="off" />
    </div>
</div>
</div>


        
<?php endif; ?>
