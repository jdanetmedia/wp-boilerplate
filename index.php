<?php get_header(); ?>

	<div class="welcome" style="background-image: url('<?php header_image(); ?>')">
		<div class="bloginfo">
			<h1 class="blog-title"><?php bloginfo( 'name' ); ?></h1>
			<h2 class="blog-description"><?php bloginfo('description'); ?></h2>
		</div>
		<div class="cta-widgets">
			<?php if ( is_active_sidebar( 'home-cta' ) ) : ?>
			<div id="home-cta">
				<?php dynamic_sidebar( 'home-cta' ); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="content">
		<?php 
	
		/* The Loop gentages så længe der er indhold / Indlæg. Dele af strukturen bruges også på sider osv. */
		if( have_posts() ):
			
			while( have_posts() ): the_post(); ?>
				<div class="postitem">
					<a href="<?php echo get_permalink(); ?>">
						<?php the_post_thumbnail(array(800, 800)); ?>
					</a>
					<div class="postloop-item">
						<a href="<?php echo get_permalink(); ?>"><h3><?php the_title();?></h3></a>
						<small>Posted on: <?php the_time('F j, Y'); ?> on <?php the_time('g:i a'); ?></small>
						<p class="post-excerpt"><?php the_excerpt();?></p>
						<small>Posted in: <?php the_category(); ?></small>
					</div>
				</div>
			<?php endwhile;
			
		endif;
			
		?>
	</div>
	<div class="sidebar">
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="sidebar">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>