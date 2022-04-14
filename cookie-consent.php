<?php

/**
 * Plugin Name:       Cookie Consent
 * Plugin URI:        https://webplant.media
 * Description:       Cookie Consent
 * Requires at least: 4.9
 * Requires PHP:      5.6
 * Author:            Web Plant Media
 * Author URI:        https://webplant.media
 * Version:           1.0.1
 * Text Domain:       cookie-consent
 * Domain Path:       languages
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

define('COOKIE_CONSENT_DIR', plugin_dir_path(__FILE__));
define('COOKIE_CONSENT_URL', plugin_dir_url(__FILE__));

add_action('customize_register', 'cookie_consent_customizer_register');
/**
 * Registers settings and controls with the Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function cookie_consent_customizer_register($wp_customize)
{

	// Menu settings section.
	$section_id = 'cookie_consent_section';
	$wp_customize->add_section(
		'cookie_consent_section',
		array(
			'title'       => __('Cookie Consent Settings', 'creative-pro'),
		)
	);

	// Cookie Consent
	$id = "enable";
	$id_ = str_replace("-", "_", $id);
	$wp_customize->add_setting(
		'cookie_consent_' . $id_,
		array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
			'type' => 'option',
		)
	);

	$wp_customize->add_control(
		'cookie_consent_' . $id_,
		array(
			'label'       => __('Enable', 'cookie-consent'),
			'section'     => $section_id,
			'type'        => 'checkbox',
			'settings'    => 'cookie_consent_' . $id_,
		)
	);

	$id = "title";
	$id_ = str_replace("-", "_", $id);
	$wp_customize->add_setting(
		'cookie_consent_' . $id_,
		array(
			'default'           => "We use cookies!",
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option',
		)
	);

	$wp_customize->add_control(
		'cookie_consent_' . $id_,
		array(
			'label'       => __('Title', 'cookie-consent'),
			'section'     => $section_id,
			'type'        => 'text',
			'settings'    => 'cookie_consent_' . $id_,
		)
	);

	$id = "message";
	$id_ = str_replace("-", "_", $id);
	$wp_customize->add_setting(
		'cookie_consent_' . $id_,
		array(
			'default'           => "We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.",
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option',
		)
	);

	$wp_customize->add_control(
		'cookie_consent_' . $id_,
		array(
			'label'       => __('Message', 'cookie-consent'),
			'section'     => $section_id,
			'type'        => 'textarea',
			'settings'    => 'cookie_consent_' . $id_,
		)
	);

	$id = "agree_button";
	$id_ = str_replace("-", "_", $id);
	$wp_customize->add_setting(
		'cookie_consent_' . $id_,
		array(
			'default'           => "Ok",
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option',
		)
	);

	$wp_customize->add_control(
		'cookie_consent_' . $id_,
		array(
			'label'       => __('Agree Button', 'cookie-consent'),
			'section'     => $section_id,
			'type'        => 'text',
			'settings'    => 'cookie_consent_' . $id_,
		)
	);

	$id = "position";
	$id_ = str_replace("-", "_", $id);
	$wp_customize->add_setting(
		'cookie_consent_' . $id_,
		array(
			'default'           => "bottom left",
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option',
		)
	);

	$wp_customize->add_control(
		'cookie_consent_' . $id_,
		array(
			'label'       => __('Position', 'cookie-consent'),
			'section'     => $section_id,
			'type'        => 'select',
			'choices' => array(
				'bottom left' => 'bottom left',
				'bottom center' => 'bottom center',
				'bottom right' => 'bottom right',
			),
			'settings'    => 'cookie_consent_' . $id_,
		)
	);

	$id = "layout";
	$id_ = str_replace("-", "_", $id);
	$wp_customize->add_setting(
		'cookie_consent_' . $id_,
		array(
			'default'           => "box",
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option',
		)
	);

	$wp_customize->add_control(
		'cookie_consent_' . $id_,
		array(
			'label'       => __('Layout', 'cookie-consent'),
			'section'     => $section_id,
			'type'        => 'select',
			'choices' => array(
				'box' => 'Box',
				'bar' => 'Bar',
				'cloud' => 'Cloud',
			),
			'settings'    => 'cookie_consent_' . $id_,
		)
	);


	$id = "force_consent";
	$id_ = str_replace("-", "_", $id);
	$wp_customize->add_setting(
		'cookie_consent_' . $id_,
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
			'type' => 'option',
		)
	);

	$wp_customize->add_control(
		'cookie_consent_' . $id_,
		array(
			'label'       => __('Force Consent', 'cookie-consent'),
			'section'     => $section_id,
			'type'        => 'checkbox',
			'settings'    => 'cookie_consent_' . $id_,
		)
	);
}

add_action('wp_enqueue_scripts', 'cookie_consent_enqueue_scripts_styles', 9);
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function cookie_consent_enqueue_scripts_styles()
{

	$enable = get_option('cookie_consent_enable', 1);
	$message = get_option('cookie_consent_message', "We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.");
	$title = get_option('cookie_consent_title', "We use cookies!");
	$agree_button = get_option('cookie_consent_agree_button', "Ok");
	$position = get_option('cookie_consent_position', "bottom left");
	$layout = get_option('cookie_consent_layout', "box");
	$force_consent = get_option('cookie_consent_force_consent', 0);

	if ($enable) {
		wp_enqueue_style('cookieconsent', 'https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.8.0/dist/cookieconsent.css', array(), '2.8.0');
		wp_enqueue_script('cookieconsent', 'https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.8.0/dist/cookieconsent.js', array(), '2.8.0', true);
		wp_enqueue_script('cookieconsent-init', COOKIE_CONSENT_URL . 'js/cookieconsent-init.js', array('cookieconsent'), '1.0.1', true);
		wp_localize_script(
			'cookieconsent-init',
			'cookieconsent',
			array(
				'message' => $message,
				'title' => $title,
				'agree_button' => $agree_button,
				'position' => $position,
				'layout' => $layout,
				'force_consent' => $force_consent,
			)
		);
	}
}
