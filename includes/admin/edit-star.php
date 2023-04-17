<?php
/**
 * Add a star rating to the post edit screen.
 */
class YAYTB_Star_Rating_Metabox {

	public function __construct() {
		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_star_rating_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_star_rating_metabox' ) );
		}

	}

	public function init_star_rating_metabox() {
		add_action( 'add_meta_boxes', array( $this, 'add_star_rating_metabox'  )        );
		add_action( 'save_post',      array( $this, 'save_star_rating_metabox' ), 10, 2 );
	}

	public function add_star_rating_metabox() {
		add_meta_box(
			'yayblog_star_rating_metabox',
			__( 'Review', 'yayblog' ),
			array( $this, 'render_star_rating_metabox' ),
			'post',
			'advanced',
			'default'
		);

	}

	public function render_star_rating_metabox( $post ) { ?>
        
        <?php wp_nonce_field( 'update_yayblog_star_rating', 'yayblog_star_rating_nonce' ); ?>
        <?php include YAY_BLOG_PLUGIN_PATH.'includes/admin/templates/edit-star-template.php'; ?>
       
	<?php }

	public function save_star_rating_metabox( $post_id ) {

		// Check if nonce is valid.
		if(isset($_POST['yayblog_star_rating_nonce'])){
			if ( !wp_verify_nonce( $_POST['yayblog_star_rating_nonce'], 'update_yayblog_star_rating' ) ) {
				return;
			}
		}
		// Check if user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

        if( isset( $_POST['yayblog_post_rating_option'] ) ) {
            update_post_meta( $post_id, 'yayblog_post_rating_option', sanitize_text_field( $_POST['yayblog_post_rating_option'] ) );
        }
	}
}

new YAYTB_Star_Rating_Metabox();