jQuery(document).ready(function($){

function mediaQueryClass(width) {
 if (width > 1200) { //PC

  // lang button
   $("#header_lang_button").css("display","none");
   $("#header_lang_button").toggleClass("active",false);

   $("#header_lang > ul").show();
   $("#header_lang > ul ul").hide();

   $("#header_lang.type2 li").hover(function(){
     $(">ul:not(:animated)",this).slideDown("fast");
     $(this).addClass("active");
   }, function(){
     $(">ul",this).slideUp("fast");
     $(this).removeClass("active");
   });

 } else { //smart phone

   // Language link
   var header_lang_button = $('#header_lang_button');
   header_lang_button.css("display","block");

   $("#header_lang li").off('hover');

   if( header_lang_button.hasClass("active") ){
     $("#header_lang > ul").css("display","block");
     $("#header_lang ul ul").css("display","block");
   } else {
     $("#header_lang > ul").css("display","none");
     $("#header_lang ul ul").css("display","block");
   }

   header_lang_button.on('click', function(e) {
      if($(this).hasClass("active")) {
        $(this).removeClass("active");
        $(this).next().find('>ul:not(:animated)').slideUp("fast");
        return false;
      } else {
        $(this).addClass("active");
        $(this).next().find('>ul:not(:animated)').slideDown("fast");
        return false;
      };
   });

 };
};

function viewport() {
    var e = window, a = 'inner';
    if (!('innerWidth' in window )) {
        a = 'client';
        e = document.documentElement || document.body;
    }
    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
}

var ww = viewport().width;

mediaQueryClass(ww);

$(window).bind("resize orientationchange", function() {
  var ww = viewport().width;
  var parentHeight = $("#page_header").height();
  mediaQueryClass(ww, parentHeight);
})

});