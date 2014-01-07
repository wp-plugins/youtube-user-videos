<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   youtube-user-videos
 * @author    Guillaume Kanoufi <g.kanoufi@gmail.com>
 * @license   GPL-2.0+
 * @link      http://lostwebdesigns.com
 * @copyright 12-28-2013 Company Name
 */
?>


	<!-- This file is used to markup the admin-facing widget. -->

<div class="-widget youtube-user-videos-admin">

       <?php
        if ( isset( $instance[ 'username' ] ) ) {
            $username = $instance[ 'username' ];
        }
        else {
            $username = '';
        }?>
        <p>
            <label for="<?php echo $this->get_field_id( 'widgettitle' ); ?>">
            <?php
                _e('Title:', 'youtube-user-videos-locale');
                ?><input class="widefat" id="<?php echo $this->get_field_id( 'widgettitle' ); ?>" name="<?php echo $this->get_field_name('widgettitle');
                    ?>" type="text" value="<?php echo esc_attr($instance['widgettitle']); ?>" />
            </label>
        </p>
        <hr/>
        <p>
        <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Youtube Username: ', 'youtube-user-videos-locale'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" />
        </p>

        <?php
        if ( isset( $instance[ 'limit' ] ) ) {
            $limit = $instance[ 'limit' ];
        }
        else {
            $limit = __( 'Number of videos to display', 'youtube-user-videos-locale' );
        }
        ?>

        <p>
        <label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Number of videos to display: ', 'youtube-user-videos-locale'); ?></label>

    	<select class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>">
            <?php
                    $options = array(
                            'all' => 'All',
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                            '7' => '7',
                            '8' => '8',
                            '9' => '9',
                            '10' => '10',
                            '20' => '20',
                            '30' => '30',
                            '40' => '40',
                            '50' => '50',
                            '60' => '60',
                            '70' => '70',
                            '80' => '80',
                            '90' => '90',
                            '100' => '100'
                        );

                    foreach($options as $k =>$v):
                            $selected = ($limit == $v) ? 'selected="selected"' : '';
                        ?>
    		<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v;?></option>
                    <?php endforeach;?>
    	</select>

        <?php
        if ( isset( $instance[ 'modal' ] ) ) {
            $modal = $instance[ 'modal' ];
        }
        else {
            $modal = __( '1', 'youtube-user-videos-locale' );
        }
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'modal' ); ?>"><?php _e( 'Play video in a modal window', 'youtube-user-videos-locale' ); ?></label><br/>
            <input type="radio" name="<?php echo $this->get_field_name( 'modal' ); ?>" value="1" <?php checked('1' , $modal);?>><?php _e( ' Yes', 'youtube-user-videos-locale' );?><br />
            <input type="radio" name="<?php echo $this->get_field_name( 'modal' ); ?>" value="0" <?php checked('0', $modal);?>> <?php _e( ' No', 'youtube-user-videos-locale' );?><br />
        </p>

</div>
