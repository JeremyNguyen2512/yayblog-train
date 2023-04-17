<?php 
    if (!defined('ABSPATH')) {
        exit();
    }
    
    global $uiOption;

    $reviewOption = array(
        '5'   => __('Out of 5', 'yayblog'),
        '10'  => __('Out of 10', 'yayblog'),
    )   ;

    
    $uiOption = array(
        'tooltip'   => __('Tooltip','yayblog'),
        'icon'      => __('Icon','yayblog'),
        'badge'     => __('Badge','yayblog'),
    );

    $reviewSetting = get_option('yayblog_review');
    $uiSetting = get_option('yayblog_ui');
?>

<div class="wrap" id="yaytb_wrap_setting">
    <h1>YayBlog</h1>
    <hr>
    <h3>Review settings</h3>
    
    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Review </th>
                    <td>
                        <select name="yayblog_review" id="yaytb_review">
                            <?php 
                            
                                foreach($reviewOption as $val => $text){
                                    $selected = '';

                                    if($val === (int)$reviewSetting){
                                        $selected = 'selected';
                                    }
                                    echo '<option value="'.esc_attr($val).'" '.esc_attr($selected).'>'.esc_attr($text).'</option>';
                                }
                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row">UI</th>
                    <td>
                        <select name="yayblog_ui" id="yaytb_ui">
                        <?php 
                            
                            foreach($uiOption as $val => $text){
                                $selected = '';
                                if($val === $uiSetting){
                                    $selected = 'selected';
                                }
                                echo '<option value="'.esc_attr($val).'" '.esc_attr($selected).'>'.esc_attr($text).'</option>';
                            }
                        ?>
                            
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php wp_nonce_field( 'yayblog_save_data', 'yayblog_data_nonce' ); ?>
        <?php submit_button('Save Change'); ?>
    </form>
</div>
