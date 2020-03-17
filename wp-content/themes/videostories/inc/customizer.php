<?php
/**
 * VideoStories Theme Customizer
 *
 * @package VideoStories
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


function videostories_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';


    //Social Icons
    $wp_customize->add_section( 'social_section' , array(
        'title'      => esc_html__( 'Top Socials', 'videostories' ),
        'priority'   => 30,
    ) );


    $wp_customize->add_setting( 'twitter',array('sanitize_callback'     => 'sanitize_text_field'));
    $wp_customize->add_setting( 'skype',array('sanitize_callback'       => 'sanitize_text_field'));
    $wp_customize->add_setting( 'instagram',array('sanitize_callback'   => 'sanitize_text_field'));
    $wp_customize->add_setting( 'dribble',array('sanitize_callback'     => 'sanitize_text_field'));
    $wp_customize->add_setting( 'vimeo',array('sanitize_callback'       => 'sanitize_text_field'));
    $wp_customize->add_setting( 'facebook',array('sanitize_callback'    => 'sanitize_text_field'));


    $wp_customize->add_control( 'facebook',
        array(
            'label'    => esc_html__( 'Facebook URL', 'videostories' ),
            'section'  => 'social_section',
            'settings' => 'facebook',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'twitter',
        array(
            'label'    => esc_html__( 'Twitter URL', 'videostories' ),
            'section'  => 'social_section',
            'settings' => 'twitter',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'skype',
        array(
            'label'    => esc_html__( 'Skype URL', 'videostories' ),
            'section'  => 'social_section',
            'settings' => 'skype',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'instagram',
        array(
            'label'    => esc_html__( 'Instagram URL', 'videostories' ),
            'section'  => 'social_section',
            'settings' => 'instagram',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'dribble',
        array(
            'label'    => esc_html__( 'Dribble URL', 'videostories' ),
            'section'  => 'social_section',
            'settings' => 'dribble',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'vimeo',
        array(
            'label'    => esc_html__( 'Vimeo URL', 'videostories' ),
            'section'  => 'social_section',
            'settings' => 'vimeo',
            'type'     => 'text'
        )
    );



    //Footer Settings

    $wp_customize->add_section( 'footer_section' , array(
            'title'      => esc_html__( 'Footer Settings', 'videostories' ),
            'priority'   => 30,
        ) );
    $wp_customize->add_setting( 'copyright_text',array('sanitize_callback' => 'sanitize_textarea_field'));


    $wp_customize->add_control( 'copyright_text',
            array(
                'label'    => esc_html__( 'Copyright Text', 'videostories' ),
                'description' => esc_html__( 'Footer Credit', 'videostories' ),
                'section'  => 'footer_section',
                'settings' => 'copyright_text',
                'type'     => 'textarea'
            )
        );

}

add_action( 'customize_register', 'videostories_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function videostories_customize_preview_js() {
    wp_enqueue_script( 'videostories-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );

}

add_action( 'customize_preview_init', 'videostories_customize_preview_js' );




/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

function videstories_custom_customize_enqueue() {
    wp_enqueue_script( 'videostories-custom-customize', get_template_directory_uri() . '/js/customizer.js', array( 'jquery', 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'videstories_custom_customize_enqueue' );