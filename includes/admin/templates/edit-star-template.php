<?php 
    if (!defined('ABSPATH')) {
        exit();
    }

    $reviewSetting = get_option('yayblog_review');

    $reviewRatingPost = (int)get_post_meta($post->ID, 'yayblog_post_rating_option', true);

    if($reviewRatingPost !== null && $reviewRatingPost !== 0){
        if($reviewRatingPost > $reviewSetting){
            $reviewRatingPost = $reviewSetting;
            update_post_meta($post->ID, 'yayblog_post_rating_option', $reviewSetting);
        }
    }
?>
<select name="yayblog_post_rating_option" id="yayblog_post_rating_option">
            <?php 
                if($reviewSetting > 0){
                    for($i = 1; $i <= $reviewSetting; $i++){
                        $selected = '';
                        if($i === $reviewRatingPost){
                            $selected = 'selected';
                        }
                        
                        echo '<option value="'.$i.'" '.esc_attr($selected).'>'.$i.'</option>';
                    }
                }
            ?>
            </select>
            <?php wp_nonce_field( 'update_yayblog_star_rating', 'yayblog_star_rating_nonce' ); ?>