// Style Builder - Open Button event
$("#cmdShowStyleSwitcher").click(function(){
	if($("#divStyleSwitcher").hasClass("opened")){
		$("body").removeClass("style-switcher-in");
		$("#divStyleSwitcher").removeClass("opened");
	}
	else{
		$("body").addClass("style-switcher-in");
		$("#divStyleSwitcher").addClass("opened");
	}
	return false;
});



//// BODY BACKGROUNDS
var bodyBg = $.cookie('body-bg');

if ($('body').hasClass('body-bg-1')) {
	$("#cmdBodyBg1").addClass("active");
}
else if ($('body').hasClass('body-bg-2')) {
	$("#cmdBodyBg2").addClass("active");
}
else if ($('body').hasClass('body-bg-3')) {
	$("#cmdBodyBg3").addClass("active");
}
else if ($('body').hasClass('body-bg-4')) {
	$("#cmdBodyBg4").addClass("active");
}
else if ($('body').hasClass('body-bg-5')) {
	$("#cmdBodyBg5").addClass("active");
}
else if ($('body').hasClass('body-bg-6')) {
	$("#cmdBodyBg6").addClass("active");
}
else if ($('body').hasClass('body-bg-7')) {
	$("#cmdBodyBg7").addClass("active");
}
else if ($('body').hasClass('body-bg-8')) {
	$("#cmdBodyBg8").addClass("active");
}
else if ($('body').hasClass('body-bg-9')) {
	$("#cmdBodyBg9").addClass("active");
}

//// LAYOUT
var layoutStyle = $.cookie('layout');
// Select option

if($('body').hasClass('body-boxed')){
    $("#cmbLayoutStyle").find('option[value="2"]').attr("selected",true)
} else if (!$('body').hasClass('body-boxed')) {
    $("#cmbLayoutStyle").find('option[value="1"]').attr("selected",true)
}

if($('body').hasClass('dark-style')){
    $("#cmbLayoutColor").find('option[value="2"]').attr("selected",true)
} else if (!$('body').hasClass('body-boxed')) {
    $("#cmbLayoutColor").find('option[value="1"]').attr("selected",true)
}
/*
// Set option
if(layoutStyle == 2){
	$(".body-wrap").addClass("body-boxed");	
}
else{
	$(".body-wrap").removeClass("body-boxed");
}*/

//// LAYOUT COLOR
var layoutColor = $.cookie('scheme');
// Select option
$("#cmbLayoutColor").find('option[value="'+ layoutColor +'"]').attr("selected",true)

//// HEADER
var headerStyle = $.cookie('header-style');
// Select option
$("#cmbHeaderStyle").find('option[value="'+ headerStyle +'"]').attr("selected",true)

// Set option
if(headerStyle == 2){
	$("#cmbTopHeaderColor").prop("disabled", true);
	$("#divHeaderWrapper").empty();
	$("#divHeaderWrapper").load("headers/header-standard-2.html", function(){
		alert("Success");
		$('.dropdown-toggle').dropdownHover();
	});
	$('.dropdown-toggle').dropdownHover();
}
else if(headerStyle == 3){
	$("#cmbTopHeaderColor").prop("disabled", false);
	$("#divHeaderWrapper").empty();
	$("#divHeaderWrapper").load("headers/header-standard-3.html", function(){
		$('.dropdown-toggle').dropdownHover();
		if(topHeaderColor == "dark"){
			$(".top-header").addClass("top-header-dark");	
		}
	});
}
else if(headerStyle == 4){
	$("#cmbTopHeaderColor").prop("disabled", true);
	$("#divHeaderWrapper").empty();
	$("#divHeaderWrapper").load("headers/header-cover-1.html", function(){
		$('.dropdown-toggle').dropdownHover();
	});
	$.removeCookie('header-style');
}
else if(headerStyle == 1){
	$("#cmbTopHeaderColor").prop("disabled", true);
	$("#divHeaderWrapper").empty();
	$("#divHeaderWrapper").load("headers/header-standard-1.html", function(){
		$('.dropdown-toggle').dropdownHover();
	});
}

//// NAVBAR SHADOW
if($('body').hasClass('navbar-noshadow')){
	$("#cmbNavShadow").find('option[value="1"]').attr("selected", true);
}

// NAVBAR - DROPDOWN ARROW
// Set option
if($('body').hasClass('navbar-noarrow')){
	$("#cmbNavDropdownArrow").find('option[value="1"]').attr("selected", true);
}

//// TOP HEADER - COLOR
var topHeaderColor = $.cookie('top-header-color');
// Select option
$("#cmbTopHeaderColor").find('option[value="'+ topHeaderColor +'"]').attr("selected", true)

// Set option
if(topHeaderColor == "dark"){
	$(".top-header").addClass("top-header-dark");	
}

//// SECTION TITLE - STYLE

var sectionTitleStyle = $.cookie('section-title-style');
// Select option

// Set option
if($('body').hasClass('title-style-2')){
	$("#cmbSectionTitleColor").prop("disabled", false);
	$("#cmbSectionTitleStyle").find('option[value="2"]').attr("selected", true);	
}
else if($('body').hasClass('title-style-3')){
	$("#cmbSectionTitleColor").prop("disabled", true);
	$("#cmbSectionTitleStyle").find('option[value="3"]').attr("selected", true);	
}
else if($('body').hasClass('title-style-1')){
	$("#cmbSectionTitleColor").prop("disabled", true);
	$("#cmbSectionTitleStyle").find('option[value="1"]').attr("selected", true);	
}

// SECTION TITLE - COLOR
var sectionTitleColor = $.cookie('section-title-color');
// Select option
$("#cmbSectionTitleColor").find('option[value="'+ sectionTitleColor +'"]').attr("selected", true);

// Set option
if($('body').hasClass('title-base-alt')){
	$("#cmbSectionTitleColor").find('option[value="2"]').attr("selected", true);
}
else if($('body').hasClass('title-base-alt')){
	$("#cmbSectionTitleColor").find('option[value="3"]').attr("selected", true);	
}
else if($('body').hasClass('title-dark')){
	$("#cmbSectionTitleColor").find('option[value="4"]').attr("selected", true);	
}
else if($('body').hasClass('title-base') == 1){
	$("#cmbSectionTitleColor").find('option[value="1"]').attr("selected", true);
}


// BODY BACKGROUNDS
var background = $.cookie('background');
if (background == 'body-bg-1') {
	$("body").addClass("body-bg-1");
}
else if (background == 'body-bg-base') {
	$("body").addClass("body-bg-base");
}
else if (background == 'body-bg-3') {
	$("body").addClass("body-bg-3");
}
else if (background == 'body-bg-4') {
	$("body").addClass("body-bg-4");
}
else if (background == 'body-bg-5') {
	$("body").addClass("body-bg-5");
}
else if (background == 'body-bg-6') {
	$("body").addClass("body-bg-6");
}


// Cookie expire date
var date = new Date();
date.setTime(date.getTime() + (5 * 60 * 1000));


//// -- Click Events

// LAYOUT STYLE
$("#cmbLayoutStyle").change(function(){
	if($("#cmbLayoutStyle").val() == 2){
		$(".body-wrap").addClass("body-boxed");	
		$.cookie('layout', 2, { expires:date});
	}
	else{
		$(".body-wrap").removeClass("body-boxed");
		$.cookie('layout', 1, { expires:date});
	}
});




// HEADER
$("#cmbHeaderStyle").change(function(){
	if($(this).val() == 2){
		$("#cmbTopHeaderColor").prop("disabled", true);
		$("#divHeaderWrapper").empty();
		$("#divHeaderWrapper").load("headers/header-standard-2.html", function(){
			$('.dropdown-toggle').dropdownHover();
		});
		$.cookie('header-style', 2, { expires:date});	
	}
	else if($(this).val() == 3){
		$("#cmbTopHeaderColor").prop("disabled", false);
		$("#divHeaderWrapper").empty();
		$("#divHeaderWrapper").load("headers/header-standard-3.html", function(){
			$('.dropdown-toggle').dropdownHover();
		});
		$.cookie('header-style', 3, { expires:date});	
	}
	else if($(this).val() == 4){
		$("#cmbTopHeaderColor").prop("disabled", true);
		$("#divHeaderWrapper").empty();
		$("#divHeaderWrapper").load("headers/header-cover-1.html");
		$.cookie('header-style', 4, { expires:date});
		document.location.href = "homepage-cover.html";	
	}
	else if($(this).val() == 1){
		$("#cmbTopHeaderColor").prop("disabled", true);
		$("#divHeaderWrapper").empty();
		$("#divHeaderWrapper").load("headers/header-standard-1.html", function(){
			$('.dropdown-toggle').dropdownHover();
		});
		$.cookie('header-style', 1, { expires:date});	
	}
});

// NAVBAR SHADOW
$("#cmbNavShadow").change(function(){
	if($("#cmbNavShadow").val() == 2){
		$("body").removeClass("navbar-noshadow");
	}
	else{
		$("body").addClass("navbar-noshadow");
	}
});

// NAVBAR - DROPDOWN ARROW
$("#cmbNavDropdownArrow").change(function(){
	if($("#cmbNavDropdownArrow").val() == 2){
            $("body").removeClass("navbar-noarrow");
	}
	else{
            $("body").addClass("navbar-noarrow");
	}
});

// TOP HEADER - COLOR
$("#cmbTopHeaderColor").change(function(){
	if($(this).val() == 2){
		$(".top-header").addClass("top-header-dark");
		$.cookie('top-header-color', 'dark', {expires:date});	
	}
	else{
		$(".top-header").removeClass("top-header-dark");
		$.cookie('top-header-color', 'light', {expires:date});	
	}
});

// SECTION TITLE - STYLE
$("#cmbSectionTitleStyle").change(function(){
	if($(this).val() == 2){
		$("#cmbSectionTitleColor").prop("disabled", false);
		$("body").removeClass("title-style-3");
		$("body").addClass("title-style-2 title-base title-base-alt title-light title-dark");
	}
	else if($(this).val() == 3){
		$("#cmbSectionTitleColor").prop("disabled", true);
		$("body").removeClass("title-style-2 title-base title-base-alt title-light title-dark");
		$("body").addClass("title-style-3");
	}
	else if($(this).val() == 1){
		$("#cmbSectionTitleColor").prop("disabled", true);
		$("body").removeClass("title-style-2 title-base title-base-alt title-light title-dark");
		$("body").removeClass("title-style-3");
	}
});

// SECTION TITLE - COLOR
$("#cmbSectionTitleColor").change(function(){
	if($(this).val() == 2){
		$("body").removeClass("title-base title-light title-dark");
		$("body").addClass("title-base-alt");
		//$.cookie('section-title-color', 2, { expires:date});	
	}
	else if($(this).val() == 3){
		$("body").removeClass("title-base title-base-alt title-dark");
		$("body").addClass("title-light");
	}
	else if($(this).val() == 4){
		$("body").removeClass("title-base title-base-alt title-light");
		$("body").addClass("title-dark");
	}
	else if($(this).val() == 1){
		$("body").removeClass("title-base-alt title-light title-dark");
		$$("body").addClass("title-base");
	}
});

// BODY BACKGROUNDS
$("#cmdBodyBg1").click(function(){
	// Select option
	$("#cmdBodyBg1, #cmdBodyBg2, #cmdBodyBg3, #cmdBodyBg4, #cmdBodyBg5, #cmdBodyBg6, #cmdBodyBg7, #cmdBodyBg8, #cmdBodyBg9").removeClass("active");
	$(this).addClass("active");

	// Set option
	$("body").removeClass("body-bg-1 body-bg-2 body-bg-3 body-bg-4 body-bg-5 body-bg-6 body-bg-7  body-bg-8  body-bg-9");
	$("body").addClass("body-bg-1");
	//$.cookie('body-bg', 'body-bg-1', { expires:date});
	return false;
});
$("#cmdBodyBg2").click(function(){
	// Select option
	$("#cmdBodyBg1, #cmdBodyBg2, #cmdBodyBg3, #cmdBodyBg4, #cmdBodyBg5, #cmdBodyBg6, #cmdBodyBg7, #cmdBodyBg8, #cmdBodyBg9").removeClass("active");
	$(this).addClass("active");

	// Set option
	$("body").removeClass("body-bg-1 body-bg-2 body-bg-3 body-bg-4 body-bg-5 body-bg-6 body-bg-7 body-bg-8  body-bg-9");
	$("body").addClass("body-bg-2");
	//$.cookie('body-bg', 'body-bg-2', { expires:date});
	return false;
});
$("#cmdBodyBg3").click(function(){
	// Select option
	$("#cmdBodyBg1, #cmdBodyBg2, #cmdBodyBg3, #cmdBodyBg4, #cmdBodyBg5, #cmdBodyBg6, #cmdBodyBg7, #cmdBodyBg8, #cmdBodyBg9").removeClass("active");
	$(this).addClass("active");

	// Set option
	$("body").removeClass("body-bg-1 body-bg-2 body-bg-3 body-bg-4 body-bg-5 body-bg-6 body-bg-7 body-bg-8  body-bg-9");
	$("body").addClass("body-bg-3");
	//$.cookie('body-bg', 'body-bg-1', { expires:date});
	return false;
});
$("#cmdBodyBg4").click(function(){
	// Select option
	$("#cmdBodyBg1, #cmdBodyBg2, #cmdBodyBg3, #cmdBodyBg4, #cmdBodyBg5, #cmdBodyBg6, #cmdBodyBg7, #cmdBodyBg8, #cmdBodyBg9").removeClass("active");
	$(this).addClass("active");

	// Set option
	$("body").removeClass("body-bg-1 body-bg-2 body-bg-3 body-bg-4 body-bg-5 body-bg-6 body-bg-7 body-bg-8  body-bg-9");
	$("body").addClass("body-bg-4");
	//$.cookie('body-bg', 'body-bg-4', { expires:date});
	return false;
});
$("#cmdBodyBg5").click(function(){
	// Select option
	$("#cmdBodyBg1, #cmdBodyBg2, #cmdBodyBg3, #cmdBodyBg4, #cmdBodyBg5, #cmdBodyBg6, #cmdBodyBg7, #cmdBodyBg8, #cmdBodyBg9").removeClass("active");
	$(this).addClass("active");

	// Set option
	$("body").removeClass("body-bg-1 body-bg-2 body-bg-3 body-bg-4 body-bg-5 body-bg-6 body-bg-7 body-bg-8  body-bg-9");
	$("body").addClass("body-bg-5");
	//$.cookie('body-bg', 'body-bg-5', { expires:date});
	return false;
});
$("#cmdBodyBg6").click(function(){
	// Select option
	$("#cmdBodyBg1, #cmdBodyBg2, #cmdBodyBg3, #cmdBodyBg4, #cmdBodyBg5, #cmdBodyBg6, #cmdBodyBg7, #cmdBodyBg8, #cmdBodyBg9").removeClass("active");
	$(this).addClass("active");

	// Set option
	$("body").removeClass("body-bg-1 body-bg-2 body-bg-3 body-bg-4 body-bg-5 body-bg-6 body-bg-7 body-bg-8  body-bg-9");
	$("body").addClass("body-bg-6");
	//$.cookie('body-bg', 'body-bg-6', { expires:date});
	return false;
});
$("#cmdBodyBg7").click(function(){
	// Select option
	$("#cmdBodyBg1, #cmdBodyBg2, #cmdBodyBg3, #cmdBodyBg4, #cmdBodyBg5, #cmdBodyBg6, #cmdBodyBg7, #cmdBodyBg8, #cmdBodyBg9").removeClass("active");
	$(this).addClass("active");

	// Set option
	$("body").removeClass("body-bg-1 body-bg-2 body-bg-3 body-bg-4 body-bg-5 body-bg-6 body-bg-7 body-bg-8  body-bg-9");
	$("body").addClass("body-bg-7");
	//$.cookie('body-bg', 'body-bg-7', { expires:date});
	return false;
});
$("#cmdBodyBg8").click(function(){
	// Select option
	$("#cmdBodyBg1, #cmdBodyBg2, #cmdBodyBg3, #cmdBodyBg4, #cmdBodyBg5, #cmdBodyBg6, #cmdBodyBg7, #cmdBodyBg8, #cmdBodyBg9").removeClass("active");
	$(this).addClass("active");

	// Set option
	$("body").removeClass("body-bg-1 body-bg-2 body-bg-3 body-bg-4 body-bg-5 body-bg-6 body-bg-7 body-bg-8  body-bg-9");
	$("body").addClass("body-bg-8");
	//$.cookie('body-bg', 'body-bg-7', { expires:date});
	return false;
});
$("#cmdBodyBg9").click(function(){
	// Select option
	$("#cmdBodyBg1, #cmdBodyBg2, #cmdBodyBg3, #cmdBodyBg4, #cmdBodyBg5, #cmdBodyBg6, #cmdBodyBg7, #cmdBodyBg8, #cmdBodyBg9").removeClass("active");
	$(this).addClass("active");

	// Set option
	$("body").removeClass("body-bg-1 body-bg-2 body-bg-3 body-bg-4 body-bg-5 body-bg-6 body-bg-7 body-bg-8  body-bg-9");
	$("body").addClass("body-bg-9");
	//$.cookie('body-bg', 'body-bg-7', { expires:date});
	return false;
});

