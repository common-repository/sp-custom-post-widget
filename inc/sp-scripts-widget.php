<?php
/**
 * @author Sulav Parajuli
 * Adds SPSPSP_Widget_Custom widget.
 */
class SPSPSP_Widget_Custom extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'spspsp_widget_custom', // Base ID
			esc_html__( 'SP Custom Widget', 'spspspwidgetcustom_domain' ), // Name
			array( 'description' => esc_html__( 'Show posts from custom post types', 'spspspwidgetcustom_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
        //actually below line parses the title of widget and show it
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		elseif ( empty( $instance['title'] )) {
			echo $args['before_title'] . 'SP Custom Widget' . $args['after_title'];
		}
        //actual output on frontend
        
        $ptype = $instance['posttype'];
        $nitms = $instance['noofitems'];
        $showexercpt = $instance['dispexerpt'];
        ?>
        <?php
        function change_excerpt( $more ) {
                return '...';
        }
        add_filter('excerpt_more', 'change_excerpt');
        ?>
        <?php 
            $query = array('post_type' => $ptype);
            $loop = new WP_Query($query);
            if (have_posts()) {
            	for ($i=0; $i < $nitms; $i++) { 
            	$loop->the_post();
                              $resultspsp .= '<a href="'.get_the_permalink().'">'. get_the_title() .'</a>';
                              if ($showexercpt) {
                              	$resultspsp .= '<br>'.get_the_excerpt();
                              }
                               $resultspsp .= '<hr>';
              }
            }
            
        ?>
        <?php
		//echo esc_html__( 'Hello, World!', 'spspspwidgetcustom_domain' );
		echo __( $resultspsp, 'spspspwidgetcustom_domain' );
        
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'spspspwidgetcustom_domain' );
		$posttype = ! empty( $instance['posttype'] ) ? $instance['posttype'] : esc_html__( 'Post Type', 'spspspwidgetcustom_domain' );
		$noofitems = ! empty( $instance['noofitems'] ) ? $instance['noofitems'] : esc_html__( 'No of items to show', 'spspspwidgetcustom_domain' );
		$dispexerpt = ! empty( $instance['dispexerpt'] ) ? $instance['dispexerpt'] : esc_html__( 'Show Excerpt', 'spspspwidgetcustom_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'spspspwidgetcustom_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'posttypee' ) ); ?>"><?php esc_attr_e( 'Post Type:', 'spspspwidgetcustom_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'posttype' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posttype' ) ); ?>" type="text" value="<?php echo esc_attr( $posttype ); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'noofitems' ) ); ?>"><?php esc_attr_e( 'No of items to show:', 'spspspwidgetcustom_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'noofitems' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'noofitems' ) ); ?>" type="number" value="<?php echo esc_attr( $noofitems ); ?>">
		</p>
		<p>
		<p>
        <label for="<?php echo $this->get_field_id( 'dispexerpt' ); ?>"><?php _e('Show Excerpt:', 'spspspwidgetcustom_domain'); ?></label><br />
        <input type="radio" id="<?php echo $this->get_field_id( 'dispexerpt' ); ?>" name="<?php echo $this->get_field_name( 'dispexerpt' ); ?>" value="1" checked="checked"/> Yes<br />
        <input type="radio" id="<?php echo $this->get_field_id( 'dispexerpt' ); ?>" name="<?php echo $this->get_field_name( 'dispexerpt' ); ?>" value="0" checked/> No<br />            
    </p>


		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['posttype'] = ( ! empty( $new_instance['posttype'] ) ) ? sanitize_text_field( $new_instance['posttype'] ) : '';
		$instance['noofitems'] = ( ! empty( $new_instance['noofitems'] ) ) ? sanitize_text_field( $new_instance['noofitems'] ) : '';
		$instance['dispexerpt'] = ( ! empty( $new_instance['dispexerpt'] ) ) ? sanitize_text_field( $new_instance['dispexerpt'] ) : '';


		return $instance;
	}

} // class SPSPSP_Widget_Custom
?>