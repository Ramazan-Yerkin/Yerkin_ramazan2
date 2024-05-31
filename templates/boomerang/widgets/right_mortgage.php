<?php
/*
Widget-title: Mortgage
Widget-preview-image: /assets/img/widgets_preview/right_mortgage.jpg
 */
?>

<?php 

$price_mortgage='';
if(isset($estate_data_option_36)&&!empty($estate_data_option_36)) 
    $price_mortgage = $estate_data_option_36;
elseif(isset($estate_data_option_37)&&!empty($estate_data_option_37))
    $price_mortgage = $estate_data_option_37;

if(!empty($price_mortgage)):

$price_mortgage = str_replace(',', '', $price_mortgage);
$price_mortgage = number_format($price_mortgage, 2, '.', '');;

endif; 
?>

<div class="panel panel-default panel-sidebar-1 filter-checkbox-container">  
    <div class="panel-heading"><h2><?php _l('Mortgage'); ?></h2></div>
    <div class="panel-body">
        <form method="get" action="#" class="bottom-line line-before form-light "  id="mortgage_calculator">
            <div class="form-group">
                <input id="mortgage_balance" type="text" class="input-block-level form-control" placeholder="<?php _l('House price'); ?>*" value="<?php echo $price_mortgage ;?>">
            </div>
<div class="form-group">
    <input id="mortgage_interest" type="text" class="form-control input-block-level" placeholder="<?php _l('Interest'); ?>*" value="<?php echo (!empty($price_mortgage)) ? config_item('mortgage_interest'):'';?>">
</div><div class="form-group">
            <input id="mortgage_downpayment"  type="text" class="form-control input-block-level" placeholder="<?php _l('Down payment'); ?>">
</div><div class="form-group">
            <input id="mortgage_years" type="text" class="form-control input-block-level" placeholder="<?php _l('Years'); ?>*" value="<?php echo (!empty($price_mortgage)) ? config_item('mortgage_years'):'';?>">
</div>
            <label class="control-label"><?php _l('Monthly Repayments'); ?></label>
            <p id="results_monthly" class="form-control-static center "><?php _che($options_prefix_36); ?> 0 <?php _che($options_suffix_36); ?></p>

            <label class="control-label"><?php _l('Weekly Repayments'); ?></label>
            <p id="results_weekly" class="form-control-static center"><?php _che($options_prefix_36); ?> 0 <?php _che($options_suffix_36); ?></p>

            <input type="submit" class=" input-block-level btn-proper btn-large" value="<?php _l('Calculate'); ?>" />
        </form>
    </div>
</div>
<script type="text/javascript">

(function($) {
	$.fn.calculateMortgage = function(options) {
		var defaults = {
			currency_prefix: '<?php _che($options_prefix_36); ?>',
            currency_suffix: '<?php _che($options_suffix_36); ?>',
			params: {}
		};
		options = $.extend(defaults, options);
		
		var calculate = function(params) {
			params = $.extend({
				balance: 0,
				rate: 0,
				term: 0,
				period: 0,
                                results_weekly: null,
                                results_monthly: null
			}, params);
			
			var N = params.term * params.period;
			var I = (params.rate / 100) / params.period;
			var v = Math.pow((1 + I), N);
			var t = (I * v) / (v - 1);
			var result = params.balance * t;
			
			return result;
		};
		
		return this.each(function() {
			var $element = $(this);
			var $result_custom = calculate(options.params);
            var $result_month = calculate($.extend(options.params, {period: 12}));
            var $result_week = calculate($.extend(options.params, {period: 52}));
            
            $element.find('div.alert').remove();
            
			var output_week = options.currency_prefix + ' ' + $result_week.toFixed(2) + ' ' + options.currency_suffix;
            if(mortgage_is_numeric($result_week.toFixed(2)))
            {
                options.results_weekly.html(output_week);
            }
            else
            {
                $element.prepend('<div class="alert alert-danger" role="alert"><?php _l('Please fill empty fields'); ?></div>');
            }
			     
		
			var output_month = options.currency_prefix + ' ' + $result_month.toFixed(2) + ' ' + options.currency_suffix;
			if(mortgage_is_numeric($result_month.toFixed(2)))
                options.results_monthly.html(output_month);
            
		});

	};

})(jQuery);

$(function() {
	$('#mortgage_calculator').on('submit', function(e) {
		e.preventDefault();
		var $params = {
			balance: $('#mortgage_balance').val() - $('#mortgage_downpayment').val(),
			rate: $('#mortgage_interest').val(),
			term: $('#mortgage_years').val(),
			period: 12
		};
		
		$(this).calculateMortgage({
			params: $params,
            results_weekly: $('#results_weekly'),
            results_monthly: $('#results_monthly')
		})
	
	});	


});

function mortgage_is_numeric(mixed_var) {
  var whitespace =
    " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
  return (typeof mixed_var === 'number' || (typeof mixed_var === 'string' && whitespace.indexOf(mixed_var.slice(-1)) === -
    1)) && mixed_var !== '' && !isNaN(mixed_var);
}
<?php if($price_mortgage):?>
$('document').ready(function(){
    $("#mortgage_calculator input[type='submit']").trigger( "click" );
});
<?php endif;?>
    
    $('document').ready(function(){
        $('#mortgage_balance').on('keyup keypress', function(e) {

            var key = e.which || e.keyCode || 0;
            var letters='1234567890.';
            if( key==8  
                || key==9
                || key==13
                || key==16
                || key==17
                || key==18
                || key==27
                || key==46
                || key==45
                || (key>=33 && key<=40)
                || (e.ctrlKey && (a == 88/*ctrl+x*/ || a == 67/*ctrl+c*/ || a == 86/*ctrl+v*/ || a == 90/*ctrl+z*/))
                || !String.fromCharCode(key) || String.fromCharCode(key)==''){
            return true;
            }

            return (letters.indexOf(String.fromCharCode(key))!=-1);
        
        });
        
        $('#mortgage_balance').on('keyup keypress', function(e) {
            var key = e.which || e.keyCode || 0;
            var letter='.';
            var val = $(this).val();
            if(letter==String.fromCharCode(key)){
                return (val.indexOf((String.fromCharCode(key)))==-1);
            };
        });
    });
    
</script>









