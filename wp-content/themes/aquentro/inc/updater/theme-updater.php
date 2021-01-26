<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package WordPress
 * @subpackage Aquentro
 * @since Aquentro 1.0.0
 */
// Includes the files needed for the theme updater
if ( ! class_exists( 'Aquentro_EDD_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}
$aquentro_info           = wp_get_theme( get_template() );
$aquentro_name           = $aquentro_info->get( 'Name' );
$aquentro_slug           = get_template();
$aquentro_version        = $aquentro_info->get( 'Version' );
$aquentro_author         = $aquentro_info->get( 'Author' );
$aquentro_remote_api_url = $aquentro_info->get( 'AuthorURI' );
// Loads the updater classes
$aquentro_updater = new Aquentro_EDD_Updater_Admin(

// Config settings
	$aquentro_config = array(
		'remote_api_url' => $aquentro_remote_api_url, // Site where EDD is hosted
		'item_name'      => $aquentro_name, // Name of theme
		'theme_slug'     => $aquentro_slug, // Theme slug
		'version'        => $aquentro_version, // The current version of this theme
		'author'         => $aquentro_author, // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
	),

	// Strings
	$aquentro_strings = array(
		'theme-license'             => esc_html__( 'Theme License', 'aquentro' ),
		'enter-key'                 => esc_html__( 'Enter your theme license key.', 'aquentro' ),
		'license-key'               => esc_html__( 'License Key', 'aquentro' ),
		'license-action'            => esc_html__( 'License Action', 'aquentro' ),
		'deactivate-license'        => esc_html__( 'Deactivate License', 'aquentro' ),
		'activate-license'          => esc_html__( 'Activate License', 'aquentro' ),
		'status-unknown'            => esc_html__( 'License status is unknown.', 'aquentro' ),
		'renew'                     => esc_html__( 'Renew?', 'aquentro' ),
		'unlimited'                 => esc_html__( 'unlimited', 'aquentro' ),
		'license-key-is-active'     => esc_html__( 'License key is active.', 'aquentro' ),
		'expires%s'                 => esc_html__( 'Expires %s.', 'aquentro' ),
		'expires-never'             => esc_html__( 'Lifetime License.', 'aquentro' ),
		'%1$s/%2$-sites'            => esc_html__( 'You have %1$s / %2$s sites activated.', 'aquentro' ),
		'license-key-expired-%s'    => esc_html__( 'License key expired %s.', 'aquentro' ),
		'license-key-expired'       => esc_html__( 'License key has expired.', 'aquentro' ),
		'license-keys-do-not-match' => esc_html__( 'License keys do not match.', 'aquentro' ),
		'license-is-inactive'       => esc_html__( 'License is inactive.', 'aquentro' ),
		'license-key-is-disabled'   => esc_html__( 'License key is disabled.', 'aquentro' ),
		'site-is-inactive'          => esc_html__( 'Site is inactive.', 'aquentro' ),
		'license-status-unknown'    => esc_html__( 'License status is unknown.', 'aquentro' ),
		'update-notice'             => esc_html__( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'aquentro' ),
		'update-available'          => wp_kses(__( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'aquentro' ), array( 'strong' => array(), 'a' => array( 'class' => array(),'href' => array(),'title' => array() ) )),
	)

);
