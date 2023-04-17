<?php
/**
 * Update post view counter when post is viewed.
 */

 if (!defined('ABSPATH')) {
    exit();
}

class YAYBLOG_View_Counter{

    public function yayblog_set_post_view(){
        if(is_single()){
            global $post;
            $count_key ='yayblog_post_view';
            $count = get_post_meta($post->ID, $count_key, true);
            if($count == ''){
                $count = 0;
                delete_post_meta($post->ID, $count_key);
                add_post_meta($post->ID, $count_key, $count);
               
            } else {
                $session_view_count = isset($_SESSION['post_view_count'][$post->ID]) ? $_SESSION['post_view_count'][$post->ID] : 0;
                if($session_view_count == 0){
                    $count++;
                    $_SESSION['post_view_count'][$post->ID] = 1;
                }
                update_post_meta($post->ID, $count_key, $count);
                
            }
            return $count;
        }
        
    }
}
// new YAYBLOG_View_Counter();