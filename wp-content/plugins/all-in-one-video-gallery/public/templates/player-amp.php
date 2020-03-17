<?php

/**
 * Video Player: AMP Pages.
 *
 * @link     https://plugins360.com
 * @since    2.0.0
 *
 * @package All_In_One_Video_Gallery
 */

$player_settings = get_option( 'aiovg_player_settings' );

$post_meta = array();
$type = '';

if ( $post_id > 0 ) {
	$post_type = get_post_type( $post_id );
		
	if ( 'aiovg_videos' == $post_type ) {
		$post_meta = get_post_meta( $post_id );
        $type = $post_meta['type'][0];
	}
}

$autoplay = isset( $atts[ 'autoplay' ] ) ? (int) $atts['autoplay'] : (int) $player_settings['autoplay'];
$loop = isset( $atts[ 'loop' ] ) ? (int) $atts['loop'] : (int) $player_settings['loop'];
$muted = isset( $atts[ 'muted' ] ) ? (int) $atts['muted'] : (int) $player_settings['muted'];

$poster = '';

if ( isset( $_GET['poster'] ) ) {
    $poster = $_GET['poster'];
} elseif ( ! empty( $post_meta ) ) {
    $poster = aiovg_get_image_url( $post_meta['image_id'][0], 'large', $post_meta['image'][0], 'player' );
}

if ( ! empty( $poster ) ) {
	$poster = esc_url_raw( $poster );
}

$features = array( 'playpause', 'current', 'progress', 'duration', 'volume', 'fullscreen' );
$controls = array();   

foreach ( $features as $feature ) {	
    if ( isset( $atts[ $feature ] ) ) {	
        if ( 1 == (int) $atts[ $feature ] ) {
            $controls[] = $feature;
        }		
    } else {	
        if ( isset( $player_settings['controls'][ $feature ] ) ) {
            $controls[] = $feature;
        }		
    }	
}

$width  = ! empty( $player_settings['width'] ) ? (int) $player_settings['width'] : 640;
$ratio  = ! empty( $player_settings['ratio'] ) ? (float) $player_settings['ratio'] : 56.25;
$height = ( $width * $ratio ) / 100;

$attributes = array(
    'width'  => $width,
    'height' => $height,
    'layout' => 'responsive'
);

$sources = array( 'youtube', 'vimeo', 'dailymotion', 'facebook', 'mp4', 'embedcode' );

foreach ( $sources as $source ) {
    // mp4
    if ( 'mp4' == $source ) {
        $formats = array( 'mp4', 'webm', 'ogv' );            
        $children = array();

        foreach ( $formats as $format ) {
            if ( isset( $atts[ $format ] ) ) {
                $src = esc_url_raw( $atts[ $format ] );
                $src = str_replace( 'http://', '//', $src );

                $children[] = sprintf(
                    '<source type="%s" src="%s" />',
                    "video/{$format}",
                    $src
                );
            } elseif ( 'default' == $type && ! empty( $post_meta[ $format ][0] ) ) {
                $src = esc_url_raw( $post_meta[ $format ][0] );
                $src = str_replace( 'http://', '//', $src );

                $children[] = sprintf(
                    '<source type="%s" src="%s" />',
                    "video/{$format}",
                    $src
                );

                // tracks
                $tracks_enabled = isset( $atts['tracks'] ) ? (int) $atts['tracks'] : isset( $player_settings['controls']['tracks'] );

                if ( $tracks_enabled && ! empty( $post_meta['track'] ) ) {
                    $tracks = array();

                    foreach ( $post_meta['track'] as $track ) {
                        $tracks[] = unserialize( $track );
                    }
                    
                    foreach ( $tracks as $track ) {
                        $src = esc_url_raw( $track['src'] );
                        $src = str_replace( 'http://', '//', $src );

                        $children[] = sprintf( 
                            '<track src="%s" kind="subtitles" srclang="%s" label="%s">', 
                            $src, 
                            esc_attr( $track['srclang'] ), 
                            esc_attr( $track['label'] ) 
                        );
                    }
                }
            }                
        }

        if ( count( $children ) > 0 ) {
            if ( count( $controls ) > 0 ) {
                $attributes['controls'] = '';
            }

            if ( $autoplay ) {
                $attributes['autoplay'] = '';
            }

            if ( $loop ) {
                $attributes['loop'] = '';
            }            

            if ( ! empty( $poster ) ) {
                $attributes['poster'] = $poster;
            }

            printf(
                '<amp-video %s>%s</amp-video>',
                aiovg_combine_video_attributes( $attributes ),
                implode( '', $children )
            );

            break;
        }        
    }

    // embedcode
    if ( 'embedcode' == $source && 'embedcode' == $type ) {        
        $document = new DOMDocument();
        $document->loadHTML( $post_meta['embedcode'][0] );
        
        $iframes = $document->getElementsByTagName( 'iframe' ); 
        $src = $iframes->item(0)->getAttribute( 'src' );

        $placeholder = '';
        if ( ! empty( $poster ) ) {
            $placeholder = sprintf(
                '<amp-img layout="fill" src="%s" placeholder></amp-img>',
                $poster
            );
        }

        if ( $src ) {
            $attributes['src'] = $src;

            $attributes['sandbox'] = 'allow-scripts allow-same-origin allow-popups';
            $attributes['allowfullscreen'] = '';
            $attributes['frameborder'] = '0';

            printf(
                '<amp-iframe %s>%s</amp-iframe>',
                aiovg_combine_video_attributes( $attributes ),
                $placeholder
            );

            break;
        }        
    }

    // youtube, vimeo, dailymotion & facebook
    $src = '';

    if ( isset( $atts[ $source ] ) ) {
        $src = $atts[ $source ];
    } elseif ( $source == $type && ! empty( $post_meta[ $source ][0] ) ) {
        $src = $post_meta[ $source ][0];
    }

    if ( $src ) {
        switch ( $source ) {
            case 'youtube':
                $attributes['data-videoid'] = aiovg_get_youtube_id_from_url( $src );

                $attributes['data-param-showinfo'] = 0;
                $attributes['data-param-rel'] = 0;
                $attributes['data-param-iv_load_policy'] = 3;

                if ( empty( $controls ) ) {
                    $attributes['data-param-controls'] = 0;
                }

                if ( ! in_array( 'fullscreen', $controls ) ) {
                    $attributes['data-param-fs'] = 0;
                }

                if ( $autoplay ) {
                    $attributes['autoplay'] = '';
                }

                if ( $loop ) {
                    $attributes['loop'] = '';
                }                
                break;
            case 'vimeo':
                $vimeo = aiovg_get_vimeo_oembed_data( $src );
                $attributes['data-videoid'] = $vimeo['video_id'];

                if ( $autoplay ) {
                    $attributes['autoplay'] = '';
                }
                break;
            case 'dailymotion':
                $attributes['data-videoid'] = aiovg_get_dailymotion_id_from_url( $src );

                if ( empty( $controls ) ) {
                    $attributes['data-param-controls'] = 'false';
                }

                if ( $autoplay ) {
                    $attributes['autoplay'] = '';
                }

                if ( $muted ) {
                    $attributes['mute'] = 'true';
                }

                $attributes['data-endscreen-enable'] = 'false';
                $attributes['data-sharing-enable'] = 'false';
                $attributes['data-ui-logo'] = 'false';

                $attributes['data-param-queue-autoplay-next'] = 0;
                $attributes['data-param-queue-enable'] = 0;
                break;
            case 'facebook':
                $attributes['data-embed-as'] = 'video';
                $attributes['data-href'] = $src;
                break;
        }                

        printf(
            '<amp-%1$s %2$s></amp-%1$s>',
            $source,
            aiovg_combine_video_attributes( $attributes )
        );

        break;
    }
}