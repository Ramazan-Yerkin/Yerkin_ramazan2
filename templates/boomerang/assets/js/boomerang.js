/* TOOLS */
function sw_anim_scroll() {
    var $ = jQuery;
    var that = this;
    // Calc current offset and get all animatables
    var $animatables = $('[data-original]:not(.lazyloaded)');
    var doAnimations = function() {
        if ($animatables.length == 0) {
            $(window).off('scroll', doAnimations);
        }
        $animatables.each(function(i) {
        var $animatable = $(this);
        if ($animatable.sw_isInViewport()) {
                setTimeout(function() {
                    if(!$animatable.hasClass('lazyloaded')) {
                        $animatable.attr('src',$animatable.attr('data-original')).addClass('lazyloaded');
                    }
                },2000);
        } else {
        } 
        });
    };
    $(window).on('scroll', doAnimations);
    $(window).trigger('scroll');
}

$(document).ready(function(){
    
    $.fn.sw_isInViewport  = function() {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height()-40;
        return elementBottom > viewportTop && elementTop < viewportBottom;
    }; 
    sw_anim_scroll();
    
    jQuery('ul.nav li.dropdown').click(function(e) {
        var target = $(e.target)
        if($(this).hasClass('open'))
        { 
             if(target.is('ul.nav li.dropdown>a'))
             {
                window.location = $(this).find('a').attr('href');
             } 
        }
        else if( $(this).find('.dropdown-menu').css('display') != 'block')
        {
          $(this).addClass('open');
          jQuery(this).find('.dropdown-menu').fadeIn();
          return false;
        }
    });
    
    $("a.developed_by").hover(
      function () {
        $(this).animate({ 
            opacity: 1
        }, 200 );
      }, 
      function () {
        $(this).animate({ 
            opacity: 0.4
        }, 200 );
      }
    );
    
    // iOS (touchstart), other (click)
    $(document).on('click', 'a.preview:not(.direct-download)', function () {
        var myLinks = new Array();
        var current = $(this).attr('href');
        var curIndex = 0;
         
        $('.files-list a:not(.direct-download)').each(function (i) {
            var img_href = $(this).attr('href');
            myLinks[i] = img_href;
            if(current == img_href)
                curIndex = i;
        });
        
        options = {index: curIndex}
        
        blueimp.Gallery(myLinks,options);
        
        return false;
    });   
});

function support_history_api()
{
    return !!(window.history && history.pushState);
}

/* End Image gallery script. Big Image */ 

function custom_number_format(val)
{
    return val.toFixed(3);
}

$(document).ready(function() {
  // Custom 
  var stickyToggle = function(sticky, stickyWrapper, scrollElement) {
    var stickyHeight = sticky.outerHeight();
    var stickyTop = stickyWrapper.offset().top;
    if (scrollElement.scrollTop() >= 200){
      stickyWrapper.height(stickyHeight);
      sticky.addClass("affix");
       sticky.removeClass("affix-top");
    }
    else{
      sticky.removeClass("affix");
      sticky.addClass("affix-top");
      stickyWrapper.height('auto');
    }
  };
  
  // Find all data-toggle="sticky-onscroll" elements
  $('[data-spy="affix2"]').each(function() {
    var sticky = $(this);
    var stickyWrapper = $('<div>').addClass('sticky-wrapper'); // insert hidden element to maintain actual top offset on page
    sticky.before(stickyWrapper);
    sticky.addClass('sticky');
    
    // Scroll & resize events
    $(window).on('scroll.sticky-onscroll resize.sticky-onscroll', function() {
      stickyToggle(sticky, stickyWrapper, $(this));
    });
    
    // On page load
    stickyToggle(sticky, stickyWrapper, $(window));
  });
  
    $('[data-spy="affix"]').on('affixed.bs.affix', function(){
       $('.sticky-wrapper').css('display','block')
    });
  
    $('[data-spy="affix"]').on('affix-top.bs.affix', function(){
       $('.sticky-wrapper').css('display','none')
    });
    
    
      /***********************************************************
     * palette
     ***********************************************************/
    // LAYOUT COLOR/dark
    // Select option
    if($("#wpStylesheet").attr("href") == "assets/css/styles_dark.css"){
        $("#cmbLayoutColor").find('option[value="2"]').attr("selected",true)
    } else if ($("#wpStylesheet").attr("href") == "assets/css/styles.css"){
        $("#cmbLayoutColor").find('option[value="1"]').attr("selected",true)
    }
    
    $("#cmbLayoutColor").change(function(){
            if($("#cmbLayoutColor").val() == 2){
                $('body').addClass('dark-style');
                $("#template_style").attr("href", "assets/css/template_dark.css");
            }
            else{
                $('body').removeClass('dark-style');
                $("#template_style").attr("href", "");
            }
});
    // end LAYOUT COLOR/dark

    // SCHEMES
    $("#cmdSchemeRed").click(function(){
            // Select option
            $("#cmdSchemeRed, #cmdSchemeViolet, #cmdSchemeBlue, #cmdSchemeGreen, #cmdSchemeYellow, #cmdSchemeOrange, #cmdSchemeBW, #cmdSchemeDark, #cmdSchemeFlat").removeClass("active");
            $(this).addClass("active");

            // Set option
            $("#wpStylesheet").attr("href", "assets/css/styles_red.css");
            return false;
    });
    $("#cmdSchemeViolet").click(function(){
            // Select option
            $("#cmdSchemeRed, #cmdSchemeViolet, #cmdSchemeBlue, #cmdSchemeGreen, #cmdSchemeYellow, #cmdSchemeOrange, #cmdSchemeBW, #cmdSchemeDark, #cmdSchemeFlat").removeClass("active");
            $(this).addClass("active");

            // Set option
            $("#wpStylesheet").attr("href", "assets/css/styles_violet.css");
            return false;
    });
    $("#cmdSchemeBlue").click(function(){
            // Select option
            $("#cmdSchemeRed, #cmdSchemeViolet, #cmdSchemeBlue, #cmdSchemeGreen, #cmdSchemeYellow, #cmdSchemeOrange, #cmdSchemeBW, #cmdSchemeDark, #cmdSchemeFlat").removeClass("active");
            $(this).addClass("active");

            // Set option
            $("#wpStylesheet").attr("href", "assets/css/styles_blue.css");
            return false;
    });
    $("#cmdSchemeGreen").click(function(){
            // Select option
            $("#cmdSchemeRed, #cmdSchemeViolet, #cmdSchemeBlue, #cmdSchemeGreen, #cmdSchemeYellow, #cmdSchemeOrange, #cmdSchemeBW, #cmdSchemeDark, #cmdSchemeFlat").removeClass("active");
            $(this).addClass("active");

            // Set option
            $("#wpStylesheet").attr("href", "assets/css/styles_green.css");
            return false;
    });
    $("#cmdSchemeYellow").click(function(){
            // Select option
            $("#cmdSchemeRed, #cmdSchemeViolet, #cmdSchemeBlue, #cmdSchemeGreen, #cmdSchemeYellow, #cmdSchemeOrange, #cmdSchemeBW, #cmdSchemeDark, #cmdSchemeFlat").removeClass("active");
            $(this).addClass("active");

            // Set option
            $("#wpStylesheet").attr("href", "assets/css/styles_yellow.css");
            return false;
    });
    $("#cmdSchemeOrange").click(function(){
            // Select option
            $("#cmdSchemeRed, #cmdSchemeViolet, #cmdSchemeBlue, #cmdSchemeGreen, #cmdSchemeYellow, #cmdSchemeOrange, #cmdSchemeBW, #cmdSchemeDark, #cmdSchemeFlat").removeClass("active");
            $(this).addClass("active");

            // Set option
            $("#wpStylesheet").attr("href", "assets/css/styles_orange.css");
            return false;
    });

    // SPECIAL SCHEMES
    $("#cmdSchemeBW").click(function(){
            // Select option
            $("#cmdSchemeRed, #cmdSchemeViolet, #cmdSchemeBlue, #cmdSchemeGreen, #cmdSchemeYellow, #cmdSchemeOrange, #cmdSchemeBW, #cmdSchemeDark, #cmdSchemeFlat").removeClass("active");
            $(this).addClass("active");

            // Set option
            $("#wpStylesheet").attr("href", "assets/css/styles_bw.css");
            return false;
    });
    $("#cmdSchemeDark").click(function(){
            // Select option
            $("#cmdSchemeRed, #cmdSchemeViolet, #cmdSchemeBlue, #cmdSchemeGreen, #cmdSchemeYellow, #cmdSchemeOrange, #cmdSchemeBW, #cmdSchemeDark, #cmdSchemeFlat").removeClass("active");
            $(this).addClass("active");

            // Set option
            $("#wpStylesheet").attr("href", "assets/css/styles_dark.css");
            return false;
    });
    $("#cmdSchemeFlat").click(function(){
            // Select option
            $("#cmdSchemeRed, #cmdSchemeViolet, #cmdSchemeBlue, #cmdSchemeGreen, #cmdSchemeYellow, #cmdSchemeOrange, #cmdSchemeBW, #cmdSchemeDark, #cmdSchemeFlat").removeClass("active");
            $(this).addClass("active");

            // Set option
            $("#wpStylesheet").attr("href", "assets/css/styles_flat.css");
            return false;
    });

//// SCHEMES SETOPTION
var scheme = $.cookie('scheme');

if($("#wpStylesheet").attr("href") == "assets/css/styles_red.css") {
	// Select option
	$("#cmdSchemeRed").addClass("active");

	// Set option
	$("#wpStylesheet").attr("href", "assets/css/styles_red.css");
}
else if($("#wpStylesheet").attr("href") == "assets/css/styles_violet.css") {
	// Select option
	$("#cmdSchemeViolet").addClass("active");

	// Set option
	$("#wpStylesheet").attr("href", "assets/css/styles_violet.css");
}
else if($("#wpStylesheet").attr("href") == "assets/css/styles_blue.css") {
	// Select option
	$("#cmdSchemeBlue").addClass("active");

	// Set option
	$("#wpStylesheet").attr("href", "assets/css/styles_blue.css");
}
else if($("#wpStylesheet").attr("href") == "assets/css/styles_green.css") {
	// Select option
	$("#cmdSchemeGreen").addClass("active");

	// Set option
	$("#wpStylesheet").attr("href", "assets/css/styles_green.css");
}
else if($("#wpStylesheet").attr("href") == "assets/css/styles_yellow.css") { 
	// Select option
	$("#cmdSchemeYellow").addClass("active");

	// Set option
	$("#wpStylesheet").attr("href", "assets/css/styles_yellow.css");
}
else if($("#wpStylesheet").attr("href") == "assets/css/styles_orange.css") {
	// Select option
	$("#cmdSchemeOrange").addClass("active");

	// Set option
	$("#wpStylesheet").attr("href", "assets/css/styles_orange.css");
}

// SPECIAL SCHEMES
else if($("#wpStylesheet").attr("href") == "assets/css/styles_bw.css") {
	// Select option
	$("#cmdSchemeBW").addClass("active");

	// Set option
	$("#wpStylesheet").attr("href", "assets/css/styles_bw.css");
}
else if(scheme == "dark") {
	// Select option
	$("#cmdSchemeDark").addClass("active");

	// Set option
	$("#wpStylesheet").attr("href", "assets/css/styles_dark.css");
}
else if($("#wpStylesheet").attr("href") == "assets/css/styles_flat.css") {
	// Select option
	$("#cmdSchemeFlat").addClass("active");

	// Set option
	$("#wpStylesheet").attr("href", "assets/css/styles_flat.css");
}

$('#design-reset').click(function(){
    $('body').attr('class','body-wrap');
    $("#wpStylesheet").attr("href", "assets/css/styles.css");
    
})
    $('.color-switch:not(#cmbBodyBg) a').click(function (e) { 
      e.preventDefault();
      manualSearch(0,false,false,$(this).attr('color'));
      return false;
    });
    $('#design-reset').click(function (e) { 
      e.preventDefault();
      $('.color-switch a').removeClass('active');
      $('body').removeClass('dark-style');
      $("#template_style").attr("href", "");
      manualSearch(0,false,false, 'default');
      return false;
    });
    
    /***********************************************************
     * end palette
     ***********************************************************/
    
    /***********************************************************
     * blueimp gallery
     ***********************************************************/
    $('div.image-gallery a.post-picture-target').bind("click touchstart", function(event)
    {
        var myLinks = new Array();
        var current = $(this).attr('href');
        var curIndex = 0;
        $('div.image-gallery a.post-picture-target').each(function (i) {
            var img_href = $(this).attr('href');
            myLinks[i] = img_href;
            if(current == img_href)
                curIndex = i;
        });
        var options = {index: curIndex};
        blueimp.Gallery(myLinks, options);
        return false;
    });
    
    $('div.image-gallery-agents a.post-picture-target').bind("click touchstart", function(event)
    {
        var myLinks = new Array();
        var current = $(this).attr('href');
        var curIndex = 0;
        $(this).parent().find('a.post-picture-target').each(function (i) {
            var img_href = $(this).attr('href');
            myLinks[i] = img_href;

            if(current == img_href)
                curIndex = i;
        });
        var options = {index: curIndex};
        blueimp.Gallery(myLinks, options);
        return false;
    });

    $('.panel-heading a[data-toggle="collapse"]').on('click', function () {
        if ($(this).closest('.panel-heading').hasClass('active')) {
            $(this).closest('.panel-heading').removeClass('active');
        } else {
            $('.panel-heading a[data-toggle="collapse"]').closest('.panel-heading').removeClass('active');
            $(this).closest('.panel-heading').addClass('active');
        }
    });
});