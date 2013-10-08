<?php
/*
Plugin Name: Sword Custom Functions
Plugin URI: http://stevenword.com/
Description: Custom plugin that provides access to custom functions
Version: 1.0.0
Author: Steven Word
Author URI: http://www.stevenword.com/
*/

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

/*
 * If is - for why are you how?
 */

/* Usage */
//die( ( is( isnot( isnot() ) ) ) ? 'dog':'cat' );

function is() {
	return true;
}
function isnot() {
	return false;
}
function couldbe() {
	return (bool) mt_rand(0,1);
}
function shouldbe() {
	return true;
}
function shouldnotbe() {
	return false;
}

//die( ( couldbe( isnot( isnot() ) ) ) ? 'dog':'cat' );

/*
 * Oregon Trail Death
 *     *     ,_          *   .-.-------.                 .
           __(_\   .        //^\\       \  *      .       .
         ~( _ )    ___      \\_//_______/      .--------.-.
    jgs^^ // >>^^,/ _ )~ ^^/[_=/]______]^^^^^^/        //^\\^^^
                /_/< \\   /_(=/ (o)  (o)      \________\\=//
                                 ~    ~       [________[\__]\
          ^^^               ^^                (o)    (o)`\=)_\
 * Throughout the course of the game, Oregon Trail, members of the player's party could fall ill and die from various causes. When a member of the player's party dies, a brief funeral is held, during which the player may write a suitable tombstone epitaph before continuing down the trail.
 */
function oregon_death(){
	$ways_to_die = array(
		'measles',
		'snakebite',
		'dysentery',
		'typhoid',
		'cholera',
		'exhaustion',
		'drowning',
		'broken leg'
	);

	$number_of_ways_to_die = count( $ways_to_die );

	if( $number_of_ways_to_die > 0 )
		die( 'cause of death: ' . $ways_to_die[ mt_rand( 0, $number_of_ways_to_die - 1) ] );
	else
		die( 'cause of death: inconclusive' );

	return false;
}



/*
 * Returns the URL for the current page
 * @uses home_url
 * @return string or null
 */
function sword_get_current_page_url() {
	global $wp;

	if( ! empty( $wp->request ) )
		return home_url() . '/' . $wp->request . '/';
}

/* Feed Backgrounds  */
function sword_feed_backgrounds(){

	global $blog_id;

	if ( $blog_id != 1 || is_admin() == true )
		return false;

	add_action( 'wp_head', 'sword_feed_backgrounds_styles', 99);
	add_action( 'after_setup_theme', 'sword_feed_backgrounds_fetch', 99 );
}
add_action( 'setup_theme', 'sword_feed_backgrounds' );

function sword_feed_backgrounds_styles() {
	?>
	<style style type="text/css">
	body {
		background-size: cover;
		/*background-position-y: center !important;*/
	}
	#page{
		/*opacity: 0.9;*/

		/* fallback */
		background: rgba(0, 0, 0);
		background: rgba(0, 0, 0, 0.7);
	}
	.one-column #page {
		/*max-width: 80%;*/
	}
	</style>
	<?php
}

function sword_feed_backgrounds_fetch(){

	$fallback_image_src = plugins_url( "wallpapers/michael_tesch_manowars_curse.jpg", __FILE__ );

/* Start */

$image_link = wp_cache_get( 'test', 'group' );
if ( false == $image_link ) {

	/* Nasa’s Image of the Day */

	$sources['nasa'] = array(
		'url' => 'http://www.nasa.gov/rss/lg_image_of_the_day.rss',
		'num_items' => 1
	);

	//Bing, Bing Aerial, Aqua, Terra

	/* Microsoft Bing Dynamic
	 * http://windows.microsoft.com/en-US/windows/downloads/bing-dynamic-theme
	 */
	$sources['bing-arial'] = array(
		'url' => 'http://themeserver.microsoft.com/default.aspx?p=Bing&c=Desktop&m=en-US',
		'num_items' => 200 //177
	);

	/* Microsoft Bing Maps Aerial Imagery: United States
	 * http://windows.microsoft.com/en-US/windows/downloads/bing-dynamic-theme
	 */
	$sources['bing-usa'] = array(
		'url' => 'http://themeserver.microsoft.com/default.aspx?p=Bing&c=Aerial&m=en-US',
		'num_items' => 200 //184
	);
	/* Bing Maps Aerial Imagery: Europe
	 * http://windows.microsoft.com/en-US/windows/downloads/bing-dynamic-theme
	 */
	 /*
	$sources[] = array(
		'url' => 'http://themeserver.microsoft.com/default.aspx?p=Bing&c=Aerial_Imagery_of_Europe&m=en-gb',
		'num_items' => 200 //163
	);
	*/
	/* Microsoft Fauna Dynamic
	 * http://windows.microsoft.com/en-US/windows/downloads/aqua-dynamic-theme
	 */
	 /*
	$sources[] = array(
		'url' => 'http://themeserver.microsoft.com/default.aspx?p=Windows&c=Fauna&m=en-US',
		'num_items' => 50 //33
	);
	*/
	/* Microsoft Flora Dynamic
	 * http://windows.microsoft.com/en-US/windows/downloads/aqua-dynamic-theme
	 */
	 /*
	$sources[] = array(
		'url' => 'http://themeserver.microsoft.com/default.aspx?p=Windows&c=Flora&m=en-US',
		'num_items' => 200 //159
	);
	*/
	/* Microsoft Insects Dynamic
	 * http://windows.microsoft.com/en-US/windows/downloads/aqua-dynamic-theme
	 */
	 /*
	$sources[] = array(
		'url' => 'http://themeserver.microsoft.com/default.aspx?p=Windows&c=Insects&m=en-US',
		'num_items' => 100 //55
	);
	*/
	/* Microsoft Aqua Dynamic
	 * http://windows.microsoft.com/en-US/windows/downloads/aqua-dynamic-theme
	 */
	$sources['aqua'] = array(
		'url' => 'http://themeserver.microsoft.com/default.aspx?p=Windows&c=Aqua&m=en-US',
		'num_items' => 100 //62
	);
	/* Microsoft Terra Dynamic
	 * http://windows.microsoft.com/en-US/windows/downloads/terra-dynamic-theme
	 */
	$sources['terra'] = array(
		'url' => 'http://themeserver.microsoft.com/default.aspx?p=Windows&c=LandScapes&m=en-US',
		'num_items' => 100 //87
	);
	/* Microsoft Paramount Pictures Movies
	 * http://windows.microsoft.com/en-US/windows/downloads/aqua-dynamic-theme
	 */
	/*
	$sources[] = array(
		'url' => 'http://themeserver.microsoft.com/default.aspx?p=Paramount&c=Dynamic&m=en-US',
		'num_items' => 100 //36
	);
	*/

	$active_sources = array( 'terra', 'aqua' );
	foreach( $active_sources as $active_source) {
		$p[] = $sources[$active_source];
	}

	$source_count = count( $active_sources );
	$source_select = rand( 0, ( $source_count - 1) );

	$source = $p[ $source_select  ];

	$max_quantity = 200;

	$rss = fetch_feed( $source['url'] );

	if ( ! is_wp_error( $rss ) ) {
		$maxitems = $rss->get_item_quantity( $max_quantity );
		$rss_items = $rss->get_items(0, $maxitems);

		$item_select = rand( 0, ( $maxitems - 1 ) );
		$item = $rss_items[ $item_select ];
		$enclosure = $item->get_enclosure();
		$image_link = urldecode($enclosure->link);
	}
	else {
		$image_link = $fallback_image_src;
	}

/* End */
	wp_cache_set( 'test', $image_link, 'group', 30 );
}

	remove_theme_support( 'custom-background' );
	$args = array(
		'default-color' => '000000',
		'default-image' => $image_link,
	);
	add_theme_support( 'custom-background', $args );

}
?>