<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="content" class="grid8col right">
	<?php global $wp_query;
	$cat = $wp_query->query_vars['category_name'];
	$query = query_posts('category_name='.$cat.'&post_type=video&orderby=menu_order&order=ASC');?>
	<h2><?php single_cat_title(); ?></h2>
	<?php if(have_posts()) : ?>
	<ul id="filmIndex">
		<?php $count = 0;
			while (have_posts()) : the_post();
			$content = get_the_content($post->ID);
			$title = get_the_title($post->ID);
			$post_url = get_url_from_content($content);
			if(isset($post_url)) {
				$thumbnail_url = get_thumbnail_url_from_video_url($post_url);
				
			}
		?>
		<li>
			<a href="<?php the_permalink(); ?>">
				<img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $title; ?>" />
				<?php echo $title; ?>
				<span class="details"><?php echo(types_render_field("video-details")); ?></span>
			</a>
		</li>
		<?php 
			$count++;
			if ($count % 3 == 0) {
			echo "<br class='clearboth' />";
			}
		?>
		<?php endwhile; ?>
	</ul>
	<?php endif; ?>
</div>

<?php get_footer(); ?>