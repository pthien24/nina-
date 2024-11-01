<?php get_header(); ?>

<main class="main-content">
	<div class="wrapper error-page">
		<section class="error-404 not-found">
            <header class="page-header">
                <div class="error-banner">
					<img id="error-404" class="error" alt="<?php __('404-banner', 'homemarket'); ?>"  width="202" height="220"  src="<?php echo get_template_directory_uri() . '/images/error_404.png'; ?>" />
                </div>
                <h1 class="page-title"><?php _e( "Oops 404 again! That page can't be found.", 'homemarket' ); ?></h1>
            </header><!-- .page-header -->
        </section><!-- .error-404 -->
	</div>
</main>

<?php get_footer(); ?>