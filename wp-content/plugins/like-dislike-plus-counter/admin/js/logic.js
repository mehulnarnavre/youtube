jQuery(document).ready(function( $ ) {
    // =============== Social share -=============//
var dislikeIcon = 0;
    /* ============================= Font awesome picker ==============================*/
    $('.font-awesome-picker').iconpicker(".font-awesome-picker");
    $('.font-awesome-picker-dislike').iconpicker(".font-awesome-picker-dislike");
    $('#btn-update-like').click(function(){
        dislikeIcon = 0;
        //Checking button has properties
        if ($('.button-update-container .button-container-likes-dislike').has('i') || $('.button-update-container .button-container-likes-dislike').has('span') || $('.button-update-container .button-container-likes-dislike').has('b')) {
        $('#like-cont').show();
        $('#dislike-cont').hide();
        
        
        }
    	
    });
    
    $('#btn-update-dislike').click(function(){
        dislikeIcon = 1;
    	$('#dislike-cont').show();
    	$('#like-cont').hide();
    	
    	
    });
    //radio button click
    $('#like-cont .radio-like-cont').on('change', function() {
    	$('#post-like-btn i').removeClass($('#post-like-btn i').attr("class")).addClass($(this).next().attr("class"));

    });
    //text field
    $('#like-cont .update-text-like').keyup(function () {
  $('.btn-update-btnmain button:nth-of-type(1) span').text($(this).val());
});




    ////////////////////////// Dislike update ////////////////
        //radio button click
    $('#dislike-cont .radio-like-cont').on('change', function() {
    	$('#post-dislike-btn i').removeClass($('#post-dislike-btn i').attr("class")).addClass($(this).next().attr("class"));
    });
    //text field
    $('#dislike-cont .update-text-dislike').keyup(function () {
  $('.btn-update-btnmain button:nth-of-type(2) span').text($(this).val());
});

// ========================== Ajax Call ============================//
$('.update-like-btn-send').click(function(){
    //removing tooltip
    $('.tooltip-describe').remove();
  var btnContainer = $('.btn-update-btnmain').html();
$.ajax({
    type: "POST",
    url: ajaxurl,
    data: { action: 'bnt_update' , btnContainer: btnContainer }
  }).done(function( msg ) {
         alert( "Data Saved: " + msg );
});

 });



// ====================== Slider on off ===================== //
var onOffCont = '<label class="switch-on-off"><input type="checkbox" class="input-on-off"><span class="slider-on-off round"></span></label>';
$('.button-container-likes-dislike').append(onOffCont);
        //hiding on off button on top
        $('.button-update-container .switch-on-off').hide();
// On checked 

$('input.input-on-off').click(function() {
    if($(this).is(':checked')) {
        $('input.input-on-off').attr('checked', false); // Unchecks all
        $(this).attr('checked', true); // Uncheck current
        //getting button and send for update
        btnsSendForUpdate = $(this).closest('.button-container-likes-dislike').clone();
        btnsSendForUpdate.find("label").remove(); //removing label
        //appending selected buttons for updates
        $('.button-update-container .btn-update-btnmain').html(btnsSendForUpdate);
        //New button selected -- call an ajax using click on update button
        $('#like-update-ajax').click();
    } 
});

    /* ===================== Update 1 ====================== */
    /* ================= Update button design ================== */
    

    $(document).on( 'click', '.howl-iconpicker-close', function () { 
        if (dislikeIcon == 1) { //dislike icon picker
             $('#icon-font-updateable').removeAttr("class").addClass("fa "+$('.font-awesome-picker-dislike').val()); //dislike icon change
        $('.btn-update-btnmain button:nth-of-type(2) i').removeAttr("class").addClass("fa "+$('.font-awesome-picker-dislike').val());
        }
        else{ //like icon picker
             $('#icon-font-updateable').removeAttr("class").addClass("fa "+$('.font-awesome-picker').val()); //like icon change
        $('.btn-update-btnmain button:nth-of-type(1) i').removeAttr("class").addClass("fa "+$('.font-awesome-picker').val());
        }
       
        
    });

    //Hide using cross
    $('.hide-btn-cont').click(function(){
        $(this).closest('.cont-like-btn1').hide();

    });

    //Adding id's to buttons
    $('.button-container-likes-dislike button:nth-of-type(1)').attr('id','post-like-btn');
    $('.button-container-likes-dislike button:nth-of-type(2)').attr('id','post-dislike-btn');

     /* ===================== End of Update 1 ====================== */
    /* ================= End of Update button design ================== */
    //activate theme
    try {
var activateTheme = $('.btn-update-btnmain button:nth-of-type(1)').attr('class').split(' ')[0];
}
catch(err) {
    console.log(err);
}
//$("#"+activateTheme).closest('input.input-on-off').attr('checked', true); // Uncheck current
$(".all-btns-list-cont ."+activateTheme+":nth-of-type(2)").next().children('.input-on-off').attr('checked', true);


// =================== Setting save button  ================//
    var onHomePageShow = onProductPageShow = onPagesShow = "";
$('.update-setting-btn button').click(function(){
    var funcType;

    if ($('.on-home-page').prop('checked') == true) {
    onHomePageShow ="yes";
    }
    else{
        onHomePageShow ="no";
    }
     if ($('.on-simple-page').prop('checked') == true) {
    onPagesShow ="yes";
    }
    else{
        onPagesShow ="no";
    }
     if ($('.on-woo-page').prop('checked') == true) {
    onProductPageShow ="yes";
    }
    else{
        onProductPageShow ="no";
    }
 if ($('.ldc-show-share').prop('checked') == true) {
    onshowShare ="yes";
    }
    else{
        onshowShare ="no";
    }

if($(".login-check").prop('checked') == true){
    //login checked
    funcType = "login-check";
    likeDislikeType(funcType);    
}
else{
//Cookie checked
    funcType = "cookie-check";
    likeDislikeType(funcType);
}


});

// Setting save button ajax call//
function likeDislikeType(likeDislikeType){
    $.ajax({
    type: "POST",
    url: ajaxurl,
    data: { action: 'bnt_update_setting' , likeDislikeType: likeDislikeType, onHomePageShow: onHomePageShow, onProductPageShow: onProductPageShow, onPagesShow: onPagesShow, onshowShare: onshowShare  }
  }).done(function( msg ) {
         alert( "Data Saved: " + msg );
});
}

// ======================= Statistics Total Likes and dislkies ==================//
var ldcTotalLikes = ldcTotalDislikes = 0;
$('.p-likes-l').each(function(){
    ldcTotalLikes = ldcTotalLikes + parseInt($(this).text());
$('.g-sts-l-1 b').text(ldcTotalLikes);
});

$('.p-dislikes-l').each(function(){
    ldcTotalDislikes = ldcTotalDislikes + parseInt($(this).text());
$('.g-sts-l-2 b').text(ldcTotalDislikes);
});


 setTimeout(function () {
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
var i = parseInt($('.g-sts-l-1 b').text());
var j = parseInt($('.g-sts-l-2 b').text());


  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Likes', i],
  ['Dislikes', j],

]);

  // Optional; add a title and set the width and height of the chart
    var options = {
        chartArea:{'title': 'Post Likes/Dislikes',left:10,top:20,width:"100%",height:"100%"}
    };

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}

 }, 1000);
});



