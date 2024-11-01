<?php
/*
	Plugin Name: What I'm Currently Reading
	Plugin URI: http://www.littlepenguinstudio.com/2011/10/03/what-im-currently-reading/
	Description: Simple plugin that gives you a widget to display which book you're currently reading.
	Author: Nathan Shubert-Harbison
	Version: 1.0
	Author URI: http://www.littlepenguinstudio.com
*/



/*  Copyright 2011 Nathan Shubert-Harbison  (email : nathan@littlepenguinstudio.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class CurrentlyReading extends WP_Widget
{
	function CurrentlyReading()
	{
		$widget_options = array(
			'classname' => 'currently-reading',
			'description' => 'A simple widget to display what you\'re currently reading'
			);
		
		parent::WP_Widget('currently-reading','What I\'m Currently Reading', $widget_options);
	}
	
	function widget($args, $instance) // User interface
	{
		extract($args, EXTR_SKIP);
			
		$title = ( $instance['title'] ) ? $instance['title'] : 'Currently Reading';
		$default = ( $instance['default'] ) ? $instance['default'] : 'I\'m between books at the moment.';
		$book = ( $instance['book'] ) ? $instance['book'] : $default;
		$author = ( $instance['author'] ) ? $instance['author'] : '';
		$url = ( $instance['url'] ) ? $instance['url'] : '';
		
		?>
		
			<?php echo $before_widget;
				echo $before_title; 
				echo $title;
				echo $after_title;
			?>
		
			<p><?php
					if ($url !== '' & $book !== $default) {
						echo "<a href=\"{$url}\" target=\"_blank\">";
							echo $book;
						echo "</a>";
					} else {
						echo $book;
					}
				?>
				<?php if ($author !=='' & $book !==$default) echo "<span class=\"cr_author\">by {$author}</span>";?>
			</p>
		<?php
		
	}

		
	function form ( $instance )
	{
		?>
		<label for="<?php echo $this->get_field_id('title'); ?>">
		<strong>Widget Title:</strong></label><br />
		<em><small>Default: Currently Reading</small></em>
		<input id="<?php echo $this->get_field_id('title'); ?>" 
			name="<?php echo $this->get_field_name('title'); ?>" 
			value="<?php echo esc_attr($instance['title']); ?>" /><br /><br />
		
	
		<label for="<?php echo $this->get_field_id('book'); ?>">
		<strong>Book Info</strong><br />
		Book: <br />
		<input id="<?php echo $this->get_field_id('book'); ?>" 
			name="<?php echo $this->get_field_name('book'); ?>" 
			value="<?php echo esc_attr($instance['book']); ?>" />
		</label><br />
		
		<label for="<?php echo $this->get_field_id('author'); ?>">	
		Author: <br />
		<input id="<?php echo $this->get_field_id('author'); ?>" 
			name="<?php echo $this->get_field_name('author'); ?>" 
			value="<?php echo esc_attr($instance['author']); ?>" />
		</label><br />
			
		<label for="<?php echo $this->get_field_id('url'); ?>">
		Website for more info: <br />
		<input id="<?php echo $this->get_field_id('url'); ?>" 
			name="<?php echo $this->get_field_name('url'); ?>" 
			value="<?php echo esc_attr($instance['url']); ?>" />
		</label><br /><br />
			
		<label for="<?php echo $this->get_field_id('default'); ?>">
		<strong>Default Text:</strong></label><br />
		<em><small>Default: I'm between books at the moment.</small></em>
		<input id="<?php echo $this->get_field_id('default'); ?>" 
			name="<?php echo $this->get_field_name('default'); ?>" 
			value="<?php echo esc_attr($instance['default']); ?>" /><br /><br />	
		
		<?php
		
	}
}

function currently_reading()
{
	register_widget("CurrentlyReading");
}

add_action('widgets_init','currently_reading');

?>