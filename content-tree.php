<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
$postid = get_the_ID();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>

		<?php if ( is_single() ) : ?>
		
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php endif; // is_single() ?>
<?php /*
		<div class="entry-meta">
			<?php twentythirteen_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
*/ ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
    <?php if ( is_single() ) : ?>
	<div class="entry-content">
</div><!-- .entry-content -->

        <?php view_meta_post($postid); ?>

<?php /*the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) );*/ ?>
    <style type="text/css">
        #map {
            width: 100%;
            height: 500px;
            border: 1px solid #00BFFF;
            background-color: #fff;
    }
    </style>

<?php

$location = get_field('map'); // MANCA l'ID !!!
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng']; 
endif; // lat lng

$mappa=get_field('mappa');
if ($mappa=='prova'){
	$mapjs='mappa_tree.js';
	$viewmap='Guarda la mappa dei Natural Trees #BOOTLEAF !!!';
	$urlmap='http://www.cityplanner.it/natural-trees-bl-map-articolo/';
	$logourl='http://openclipart.org/image/300px/svg_to_png/188330/tree-mappin-by-pjhooker.png';
}
else {}
?>
<script src='http://www.cityplanner.it/experiment_host/supply/js/<?php echo $mapjs; ?>'></script>

<script type="text/javascript">
            
            var lon = <?php echo $lng; ?>,
            lat = <?php echo $lat; ?>,
            zoom = 14,
            epsg4326 = new OpenLayers.Projection('EPSG:4326'),
            epsg900913 = new OpenLayers.Projection('EPSG:900913');

            function onFeatureSelect(evt) {
                feature = evt.feature;
                popup = new OpenLayers.Popup.FramedCloud("featurePopup",
                                         feature.geometry.getBounds().getCenterLonLat(),
                                         new OpenLayers.Size(100,100),
                                         "<a href='"+feature.attributes.url_post+"'><b>"+feature.attributes.titolo + "</b></a>" +
                                         "<br><img src='" + feature.attributes.picture + "' style='width:150px;height:auto;'>",
                                         null, true, onPopupClose);
                feature.popup = popup;
                popup.feature = feature;
                map.addPopup(popup, true);
            }
</script>
<?php
crea_geojson_tree ();
$progetto = get_field('progetto');
if ($progetto==NULL){}
else{
crea_geojson_tree_progetto ($progetto);
}
//mappa_tree();
articolo_template($postid);
echo"<ol id='comment-list' class='comment-list block-comments' itemprop='comment'>";
echo"
	<li class='group comment' id='comment-id-1'>		
	<div class='block-comment-avatar'>
			<img src='$logourl' alt=''>
	</div>
	<div class='block-comment-content module'>
					<div class='comment-text'>";
echo "<a href='$urlmap'>$viewmap</a>";
echo"<div id='map'></div></div></div></li>
";
echo"</ol>
";
?>
<?php else : ?>

<?php endif; // is_single() ?>
<div class="entry-summary">
</div><!-- .entry-content -->
	<?php endif; ?>
<?php /*
	<footer class="entry-meta">
		<?php if ( comments_open() && ! is_single() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
*/ ?>
</article><!-- #post -->
