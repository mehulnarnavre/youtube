(function( $ ) {
    // Add Color Picker to all inputs that have 'color-field' class
    $(function() {
        $('.wp-color-picker').wpColorPicker();
        $(".wp-color-picker").wpColorPicker(
  'option',
  'change',
  function(event, ui) {
    //button background change
     $(".btn-update-btnmain button:nth-of-type(1)").css( 'background', ui.color.toString());
     

  });
   }); 

})( jQuery );



(function( $ ) {
    // Add Color Picker to all inputs that have 'color-field' class
    $(function() {
        $('.wp-color-picker2').wpColorPicker();
        $(".wp-color-picker2").wpColorPicker(
  'option',
  'change',
  function(event, ui) {
    //do something on color change here
     $(".btn-update-btnmain button:nth-of-type(2)").css( 'background', ui.color.toString());

  });
   }); 

})( jQuery );