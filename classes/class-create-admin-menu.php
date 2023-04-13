<?php
/**
 * This file will create admin menu page
 */

 class YAYTB_Create_Amin_Menu { 

    public function __construct(){
        add_action('admin_menu', [$this,'yaytb_init_menu']);
    }

    public function yaytb_init_menu(){
        add_submenu_page(
            'options-general.php',
            _('YayTrain Blog', 'yayproductsale'),
            _('YayTrain Blog', 'yayproductsale'),
            'manage_options',
            'yaytb',
            [$this, 'yaytb_admin_page']
        );
    }

    public function yaytb_admin_page(){
        include YAY_BLOG_PLUGIN_PATH . 'includes/admin/settings.php';
    }


 }
 new YAYTB_Create_Amin_Menu();