<?php
/**
 * This file will create admin menu page
 */
 class YAYBLOG_Create_Amin_Menu { 

    public function __construct(){
        add_action('admin_menu', [$this,'yayblog_init_menu']);
        add_action( 'admin_init', [$this,'yayblog_data_saving'] );
    }

    public function yayblog_init_menu(){
        add_submenu_page(
            'options-general.php',
            __('YayTrain Blog', 'yayblog'),
            __('YayTrain Blog', 'yayblog'),
            'manage_options',
            'yayblog',
            [$this, 'yayblog_admin_page']
        );
    }

    public function yayblog_admin_page(){
        include YAY_BLOG_PLUGIN_PATH . 'includes/admin/templates/yayblog-admin-template.php';
    }

    public function yayblog_data_saving() {
        if ( !isset( $_POST['yayblog_review'] ) || !isset( $_POST['yayblog_ui'] ) ) {
            return;
        }
        if ( !wp_verify_nonce( $_POST['yayblog_data_nonce'], 'yayblog_save_data' ) ) {
            return;
        }else{
            $yayblog_review = sanitize_text_field( $_POST['yayblog_review'] );
            $yayblog_ui = sanitize_text_field( $_POST['yayblog_ui'] );

        // Save data to database
        update_option('yayblog_ui', $yayblog_ui);
        update_option('yayblog_review', $yayblog_review);
        
        add_settings_error('yayblog_settings', 'yayblog_data_saving', __('Settings saved.', 'yayblog'), 'updated');
        }
        
    }

    public function yayblog_show_settings_error_notice() {
         settings_errors('yayblog_settings');
    }


 }
 new YAYBLOG_Create_Amin_Menu();

