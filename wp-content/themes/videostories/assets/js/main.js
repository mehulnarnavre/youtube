(function($){

	"use strict";

	var VideoStories = {

      loadMoreVideos: function(){

	      	/* Start of Load More Videos*/

			var ppp = 3; // Post per page
			var pageNumber = 1;

			function load_more_videos_ajax(){
				pageNumber++;
				var str = '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=load_more_videos_ajax';
				$.ajax({
					type: "POST",
					dataType: "html",
					url: videostories_ajax_url,
					data: str,
					success: function(data){
						var $data = $(data);
						if($data.length){
							$(".video-contents.category-sorting .col-sm-8 .row").append($data).fadeIn( "slow" );
							$(".video-contents.category-sorting #more_more_videos").attr("disabled",false);
						} else{
							$(".video-contents.category-sorting #more_more_videos").attr("disabled",true);
						}
					},
					error : function(jqXHR, textStatus, errorThrown) {
						$loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
					}

				});
				return false;
			}

			$(".video-contents.category-sorting #more_more_videos").on("click",function(){ // When btn is pressed.
			    $("#more_posts").attr("disabled",true); // Disable the button, temp.
			    load_more_videos_ajax();
			});
			/* End of Load More Videos*/

      },

      tweetShares: function(){

      		$('.twitter').click( function(){ // after clicking Tweet button
      				var tweetbutton = $(this),
				    post_id = tweetbutton.attr( 'data-id' ); // get Post ID

				$.ajax({ // send the info to your server that the Tweet button has been clicked and where
					type:'POST',
					url: AJAX_URL,
					data:{'post_id' : post_id, 'action' : 'videostories_post_tweet'},
					success:function( data ){
						tweetbutton.find('span').text( data ); // return and display the result count
					}
				});
			});
      },


    carousel: function() {
      	$('.carousel.slide').carousel({
      		cycle: true
      	});
      },

    responsiveVideo: function(){
      	 $("#videos").fitVids();
      },

    matchHeight: function() {
      	$('article.post.type-post, .widget_instagram_feed img').matchHeight({
      		property: 'min-height'
      	});

      },

    magnific: function() {
    	try {
    		(function($) {
		      	$('.iframe').magnificPopup({
		      		type: 'iframe',
		      		// gallery: {
		      		// 	enabled: true
		      		// },
		      	});

		      	$('.image-popup').magnificPopup({
		      		type: 'image',
		      		gallery: {
		      			enabled: true
		      		},
		      	});
	      	});
	      } catch(e) {
	      	//e.preventDefault();
	      }

      },

	// Owl Carousels

	owlcarousel: function() {
			try {
				(function($) {

					$(".video-slider").owlCarousel({
						items:3,
						margin:30,
						nav: false,
						autoplay: true,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:2,
								margin: 0,
							},
							640:{
								items:2,
								margin: 15,
							},
							768:{
								items:3,
								margin: 15,
							}
						}
					});

					$(".trending-slider, .category-slider-01, .related-videos-slider").owlCarousel({
						items:3,
						margin:25,
						nav: false,
						autoplay: true,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:1,
								margin: 0,
							},
							640:{
								items:2,
								margin: 0,
							},
							768:{
								items:3,
								margin: 15,
							}
						}
					});

					$(".music-video-slider").owlCarousel({
						items:2,
						margin:25,
						nav: false,
						autoplay: true,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:1,
								margin: 0,
							},
							640:{
								items:2,
								margin: 15,
							}
						}
					});

					$(".weekly-top, .play-list-3 .list-slider").owlCarousel({
						items:1,
						margin:0,
						nav: false,
						autoplay: true
					});

					$(".tweet-slider").owlCarousel({
						items:1,
						margin:0,
						nav: false,
						autoplay: true,
						startPosition: 0,
						animateOut: 'slideOutUp',
						animateIn: 'slideInUp'
					});

					$(".title-slider").owlCarousel({
						items:2,
						margin:0,
						nav: false,
						autoplay: true,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							640:{
								items:1,
								margin: 0,
							},
							768:{
								items:2,
								margin: 15,
							}
						}
					});

					$(".list-slider").owlCarousel({
						items:4,
						loop:false,
						margin:30,
						nav: false,
						autoplay: true,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:2,
								margin: 15,
							},
							636:{
								items:2,
								margin: 15,
							},
							768:{
								items:3,
								margin: 15,
							},
							1024:{
								items:4,
								margin: 20,
							}
						}
					});

					$(".latest-videos-slider, .viral-videos-slider").owlCarousel({
						items:2,
						margin:30,
						nav: false,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:2,
								margin: 15,
							},
							640:{
								items:2,
								margin: 15,
							},
							768:{
								items:2,
								margin: 30,
							}
						}
					});

					$(".latest-videos-slider-2, .viral-videos-slider-2, .exclusive-videos-slider, .upload-videos-slider").owlCarousel({
						items:3,
						margin:25,
						nav: false,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:2,
								margin: 15,
							},
							636:{
								items:2,
								margin: 15,
							},
							768:{
								items:3,
								margin: 20,
							}
						}
					});

					$(".most-liked").owlCarousel({
						items:3,
						loop:true,
						margin:25,
						nav: false,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:2,
								margin: 15,
							},
							768:{
								items:2,
								margin: 20,
							},
							1024:{
								items:3,
								margin: 20,
							}
						}
					});

					$('.banner-slider-01').owlCarousel({
						center: true,
						items:2,
						autoplay: true,
						loop:true,
						margin:90,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:1,
								margin: 0,
							},
							636:{
								items:1,
								margin: 0,
							},
							768:{
								items:2,
								margin: 15,
							},
							1024:{
								items:2,
								margin: 30,
							},
							1200:{
								items:2,
								margin: 90,
							}
						}
					});

					$('.bottom-slider').owlCarousel({
						items:3,
						autoplay: true,
						loop:true,
						margin:40,
						responsive:{
							767:{
								items:1,
								margin: 0,
							},
							768:{
								items:2,
								margin: 20,
							},
							1024:{
								items:3,
								margin: 30,
							},
							1200:{
								items:3,
								margin: 40,
							}
						}
					});

					$('.banner-slider-02 .banner-slider').owlCarousel({
						items:1,
						autoplay: true,
						loop:true
					});

					$('.most-viewed').owlCarousel({
						items:2,
						autoplay: true,
						loop:true,
						margin:30,
						responsive:{
							320:{
								items:1,
								margin: 0,
							},
							480:{
								items:2,
								margin: 10,
							},
							640:{
								items:2,
								margin: 15,
							},
							768:{
								items:2,
								margin: 20,
							},
							1024:{
								items:2,
								margin: 30,
							}
						}
					});

					$('.recent-movie-slider').owlCarousel({
						items:5,
						autoplay: true,
						loop:true,
						margin:10,
						responsive:{
							320:{
								items:2
							},
							480:{
								items:2
							},
							640:{
								items:3
							},
							768:{
								items:4
							},
							1024:{
								items:5
							}
						}
					});


				})(jQuery);
			} catch(e) {

			}
		},

		// Facebook Profile Badge Script
		facebook_feed: function() {
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));

		},

		likes: function() {
				$('a.likes').click(function(){
					var act = $(this).attr('action');
					var id = $(this).attr('id');
					var me = $(this);
					jQuery.ajax({
						type:'POST',
						data:'id='+id+'&action=actionlikedislikes&act='+act,
						url: videostories_ajax_url,
						beforeSend:function(){
							$('div.alert').remove();
							$('a.likes i').removeClass('fa-thumbs-o-up');
							$('a.likes i').addClass('fa-spinner');
						},
						success:function(data){
							var data = $.parseJSON(data);
							if( data.resp =='error' ){
								$('div.like-message').after('<div class="alert alert-success alert-info">'+data.message+'</div>');
							}
							if( data.resp =='success' ){
								if (typeof(data.like) != "undefined"){
									$('.like-count'+id).text(data.like);
								}
							}
							$('a.likes i').removeClass('fa-spinner');
							$('a.likes i').addClass('fa-thumbs-o-up');
						}
					});
					return false;
				});

		},

		dislikes: function() {
				jQuery( document ).on( 'click', '.dislike-button', function() {
					var post_id = jQuery(this).data('id');
					jQuery.ajax({
						url : videostories_ajax_url,
						type : 'POST',
						data : {
							action : 'videostories_video_dislikes',
							post_id : post_id
						},
						success : function( response ) {
							jQuery('.dislikes-count').html( response );
						}
					});

					return false;
				});

		},



	};


	$(document).ready(function() {
		"use strict";

		// Background Img
		$(".background-bg").css('background-image', function () {
			var bg = ('url(' + $(this).data("image-src") + ')');
			return bg;
		});


		$('.style-grid').on("click", function() {
			$(".style-grid").addClass("active");
			$(".style-list").removeClass("active");
			$(".play-list-4").addClass("grid-layout");
			$(".play-list-4 article").addClass("col-sm-6");
			$(".author-videos article").addClass("col-sm-4");
			$(".author-videos").removeClass("list-style");
		});

		$('.style-list').on("click", function() {
			$(".style-list").addClass("active");
			$(".style-grid").removeClass("active");
			$(".play-list-4").removeClass("grid-layout");
			$(".play-list-4 article").removeClass("col-sm-6");
			$(".author-videos article").removeClass("col-sm-4");
			$(".author-videos").addClass("list-style");
		});


		VideoStories.loadMoreVideos();
		VideoStories.tweetShares();
		VideoStories.likes();
		VideoStories.dislikes();
		VideoStories.carousel();
		VideoStories.responsiveVideo();
		VideoStories.matchHeight();
		VideoStories.magnific();
		VideoStories.owlcarousel();
		VideoStories.facebook_feed();
	});

	if ($(window).width() < 767) {
		"use strict";

		$('.bottom-slider').owlCarousel({
			items:1,
			autoplay: true,
			loop:true,
			margin:0
		});

		// Responsive Menu Open and Close in Mobile
		$('.menu-item-has-children>a').on('click', function(event) {
			event.preventDefault();
			event.stopPropagation();
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});

	};


	jQuery(window).on('scroll', function () {
		'use strict';

		if (jQuery(this).scrollTop() > 100) {
			jQuery('#scroll-to-top').fadeIn('slow');
		} else {
			jQuery('#scroll-to-top').fadeOut('slow');
		}
	});


	jQuery('#scroll-to-top').on("click", function() {
		'use strict';
		jQuery("html,body").animate({ scrollTop: 0 }, 1500);
		return false;
	});

})(jQuery);

