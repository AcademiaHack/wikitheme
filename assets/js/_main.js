/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

function get_category_image(cat_id)
{
    if(cat_id === '94'){
        // Buenas Prácticas
        return "<i class='icon-wizardalt'></i>";
    }else if(cat_id === '89'){
        // Tecnologia
        return "<i class='icon-laptop'></i>";
    }else if (cat_id === '99') {
        // Cultura
        return "<i class='icon-world'></i>";
    }else if (cat_id === '101') {
        // Formacion
        return "<i class='icon-student-school'></i>";
    }else if (cat_id === '106') {
        // Proyectos
        return "<i class='icon-htmlfile'></i>";
    }else if (cat_id === '107') {
        // Finanzas
        return "<i class='icon-stocks'></i>";
    }else if (cat_id === '42') {
        // Mercadeo
        return "<i class='icon-thumbs-up'></i>";
    }else if (cat_id === '112') {
        // Negocios
        return "<i class='icon-moneybag'></i>";
    }else if (cat_id === '21') {
        // Directiva
        return "<i class='icon-tie-business'></i>";
    }else if (cat_id === '114') {
        // Miscelaneos
        return "<i class='icon-emojigrin'></i>";
    }else{
      return "";
    }
}

function fill_category_names(){
  $('#main-menu>ul>li').each(function() {
    var cat = $(this).attr('class');
    var catIdIndex = cat.indexOf("cat-item-") + 'cat-item-'.length;
    var catID = cat.substring(catIdIndex, cat.length);
    var catSpaceIndex = catID.indexOf(" ");
    
    if(catSpaceIndex !== -1){
      catID = catID.substring(0,catSpaceIndex);
    }
    
    $(this).attr('data-catid', catID);
    //console.log(catID);
    //////Insert Main menu logos
    $("a",this).prepend("<span class='sidebar-logo'>"+get_category_image(catID)+"</span>");
  });
}

function menuHovers(){
  var catID;

  $("#main-menu a").on( "mouseenter", function() {

    catID = $(this).parent().attr('data-catid');
    //console.log(catID);
    
    if(!$('#sub-menu #category-'+catID+' ul').hasClass('no-subcat')){
      $('#sub-menu #category-'+catID).toggleClass('hidden');
      
      $('.cat-item-over').toggleClass('cat-item-over');
      $(this).parent().toggleClass('cat-item-over');
      
      abrir_sidebar();
    } else {
      $('.cat-item-over').toggleClass('cat-item-over');
      cerrar_sidebar();
    }

  });

  $("#main-menu a").on( "mouseleave", function(e) {
    if(!$('#sub-menu #category-'+catID+' ul').hasClass('no-subcat')){
      $('#sub-menu #category-'+catID).toggleClass('hidden');
    }
  });

  $("#sub-menu").on("mouseenter", function() {
    if(!$('#sub-menu #category-'+catID+' ul').hasClass('no-subcat')){
      $('#sub-menu #category-'+catID).toggleClass('hidden');
    }
    abrir_sidebar();
  });

  $("#sub-menu").on("mouseleave", function() {
    if(!$('#sub-menu #category-'+catID+' ul').hasClass('no-subcat')){
      $('#sub-menu #category-'+catID).toggleClass('hidden');
    }
  });

  $("#menus").on("mouseleave", function(e) {
    $('.cat-item-over').toggleClass('cat-item-over');
    cerrar_sidebar();
  });


  /////Función para el menu toggle en el responsive
  $(".banner .navbar-toggle").on("click", function() {
    $("#sub-menu").toggleClass("menuToggled");
  });
}

function abrir_sidebar(){
  var sidebarWidth = parseInt($('#main-menu').css('width'),10);
  var subsidebarWidth = parseInt($('#sub-menu').css('width'),10);

  if(!$('#sub-menu').hasClass('menu-open')){
    $('#sub-menu').toggleClass('menu-open');

    $('#sub-menu').css("left",$("#main-menu").css("width"));

    if ($(window).width() > 767) {
      $('.banner').css("padding-left", (sidebarWidth+subsidebarWidth)+"px");
      $('#breadcrumbs-bar').css("padding-left",(sidebarWidth+subsidebarWidth)+"px");
      $('#widget-bar').css("right","-"+$("#sub-menu").css("width"));
      $('.content').css("margin-left",(sidebarWidth+subsidebarWidth)+"px");
      $('.content').css("margin-right","0px");
      // $('.content-info').css("padding-left",(sidebarWidth+subsidebarWidth)+"px");
      $('.content-info').css("right","-"+$("#sub-menu").css("width"));
    }
  }
}

function cerrar_sidebar(){
  var sidebarWidth = parseInt($('#main-menu').css('width'),10);
  var subsidebarWidth = parseInt($('#sub-menu').css('width'),10);

  if($('#sub-menu').hasClass('menu-open')){
    $('#sub-menu').toggleClass('menu-open');

    $('#sub-menu').css("left",(sidebarWidth-subsidebarWidth));

    if ($(window).width() > 767) {
      $('.banner').css("padding-left", sidebarWidth+"px");
      $('#breadcrumbs-bar').css("padding-left", sidebarWidth+"px");
      $('#widget-bar').css("right","0px");
      $('.content').css("margin-left", sidebarWidth+"px");
      $('.content').css("margin-right", subsidebarWidth+"px");
      // $('.content-info').css("padding-left", sidebarWidth+"px");
      $('.content-info').css("right","0px");
    }
    
  }
}

function scrollAndFixBars(){
  $(window).scroll(function(){
    var bannerHeight=parseInt($('.banner').css('height'),10);
    var breadcrumbsHeight=parseInt($('#breadcrumbs-bar').css('height'),10);
    var adminBarHeight=$("#wpadminbar").height();
    var topPos=0;

    if($("#breadcrumbs-bar").hasClass("adminShown")) {
      topPos += adminBarHeight;
    }

    var scrolltop=$(window).scrollTop();

    if(scrolltop>bannerHeight){
      $('#breadcrumbs-bar').css({'position': 'fixed', 'top': topPos+'px'});
      $('#widget-bar').css({'position': 'fixed', 'padding-top': (topPos+breadcrumbsHeight)+'px'});
    }else{
      $('#breadcrumbs-bar').css({'position': 'absolute', 'top': bannerHeight+'px'});
      $('#widget-bar').css({'position': 'absolute', 'padding-top': (bannerHeight+breadcrumbsHeight)+'px'});
    }
  });
}

$(document).ready(function(){
  UTIL.loadEvents();

  // Custom JS.
  //Repositioning due to wpAcminbar    
  if($("#breadcrumbs-bar").hasClass("adminShown")) {
    $("body").css('min-height', ($(window).height()-32) +"px");
    $('#main-menu').css('height',($(window).height()-32) +"px");
    $('#sub-menu').css('height',($(window).height()-32) +"px");
    $('#widget-bar').css('height',($(window).height()) +"px");
  }else{
    $("body").css('min-height', $(window).height() +"px");
  }

  $( window ).resize(function() {
    if($("#breadcrumbs-bar").hasClass("adminShown")) {
      $("body").css('min-height', ($(window).height()-32) +"px");
      $('#main-menu').css('height',($(window).height()-32) +"px");
      $('#sub-menu').css('height',($(window).height()-32) +"px");
      $('#widget-bar').css('height',($(window).height()) +"px");
    }else{
      $("body").css('min-height', $(window).height() +"px");
    }
  });

  //Tooltips
  $("#main-menu a[title]").tooltip({placement : 'bottom', delay: { show: 1000, hide: 100 }});
  $("[title]").tooltip({delay: { show: 1000, hide: 100 }});

  ///////////

  fill_category_names();
  menuHovers();
  scrollAndFixBars();
});

})(jQuery); // Fully reference jQuery after this point.
