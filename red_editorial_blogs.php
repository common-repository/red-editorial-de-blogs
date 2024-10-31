<? 
/*
Plugin Name: Red editorial de blogs
Plugin URI: http://nokrosis.com
Description: Genera un widget que muestra los contenidos de la red editorial de blogs.
Version: 0.7
Author: Nokrosis
Author URI: http://www.nokrosis.com
*/

class Nok_rededitorialblogs extends WP_Widget
{
	function Nok_rededitorialblogs()
	{
		parent::WP_Widget('red_editorial',__('Red Editorial de Blogs'),array('description' => __('Últimas entradas de la Red editorial de blogs')));
	}
	
	function widget($args, $instance)
	{
		extract($args);
		echo $before_widget;
		echo $before_title.'Red Editorial de Blogs'.$after_title;
		#define('MAGPIE_CACHE_AGE',1); 
		include_once(ABSPATH.WPINC.'/rss.php');

		#wp_rss('http://nokrosis.com/rededitorial.php');
		$feed = fetch_rss('http://pipes.yahoo.com/pipes/pipe.run?_id=TDzm1ZA73hG0pv5Sbbsjiw&_render=rss');
		shuffle($feed->items);
		echo '<ul>';
		foreach($feed->items as $item)
		{
			echo '<li><a href="'.$item['link'].'">'.$item['title'].'</a></li>';
		}
		echo '</ul>';
		echo $after_widget; 
	}
	
	function update($new_instance, $old_instance)
	{
		return $new_instance;
	}
	
	function form($instance){}
}
add_action('widgets_init', create_function('', 'return register_widget("Nok_rededitorialblogs");'));


?>
