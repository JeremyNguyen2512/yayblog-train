<?php
/**
 * Add star rating and view count to post title.
 */
require_once YAY_BLOG_PLUGIN_PATH.'includes/frontend/view-counter.php';
if (!defined('ABSPATH')) {
    exit();
}

class YAYBLOG_Post_Title_View{
    private $uiSetting;
    private $reviewSetting;

    public function __construct()
    {
        $this->reviewSetting = get_option('yayblog_review');
        $this->uiSetting = get_option('yayblog_ui');
        add_filter('the_title', [$this, 'yayblog_init_post_title']);
    }

    public function yayblog_init_post_title($title){
        $post_id = get_the_ID();
        $custom_ui = $this->yayblog_post_title_template( $post_id);
        if(!is_admin()){
            return $title.$custom_ui ;
        }else{
            return $title;
        }
        
    }

    public function yayblog_add_rating_post_title($post_id){
        $review_rating_post = (int)get_post_meta($post_id, 'yayblog_post_rating_option', true);
        if($review_rating_post){
           if($review_rating_post > (int)$this->reviewSetting){
            $review_rating_post = update_post_meta( $post_id, 'yayblog_post_rating_option', sanitize_text_field( $this->reviewSetting) );
           }
            return $review_rating_post;
        }else{
            return '';
        }
    }

    public function yayblog_get_post_view($post_id){
        $view_counter = new YAYBLOG_View_Counter();
        $view_counter->yayblog_set_post_view();

        $count_key ='yayblog_post_view';
        $count = get_post_meta($post_id, $count_key, true);
        
        return $count;
    }

    public function yayblog_post_title_template($post_id){
        $custom_rating = $this->yayblog_add_rating_post_title($post_id);
        $custom_count_view = $this->yayblog_get_post_view($post_id);
        ob_start();
       include(YAY_BLOG_PLUGIN_PATH.'includes/frontend/review-templates/'.$this->uiSetting.'-template.php');
        return ob_get_clean();
        
    }

}

new YAYBLOG_Post_Title_View();