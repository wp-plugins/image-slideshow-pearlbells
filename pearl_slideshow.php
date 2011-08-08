<?php
/*
Plugin Name: Photo Slideshow Pearlbells
Plugin URI: http://pearlbells.co.uk/
Description: Photo Slideshow Pearlbells
Version:  1.0
Author:Pearlbells
Author URI: http://pearlbells.co.uk/contact.html
License: GPL2
*/
/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version. 

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details. 

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.

*/
$pearl_slideshow_class = new pearl_slideshow_class();
class pearl_slideshow_class
{
	function pearl_slideshow_css()
	{
		$myStyleUrl = WP_PLUGIN_URL . '/image-slideshow-pearlbells/css/pearl_slideshow_css.css';
        $myStyleFile = WP_PLUGIN_DIR . '/image-slideshow-pearlbells/css/pearl_slideshow_css.css';
        if ( file_exists($myStyleFile) ) 
		{
            wp_register_style('myStyleSheets', $myStyleUrl);
            wp_enqueue_style( 'myStyleSheets');
        }
	}
	
	function pearl_slideshow_script()
	{
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js');
		wp_enqueue_script( 'jquery' );?>
		<script type="text/javascript">
		var $jquery = jQuery.noConflict(); 
		$jquery(document).ready(function(){
		
		setStyleSlideshow();		
			
		$jquery('#playbtn').click(function(){
		var btntext = $jquery(this).attr('value');
		if(btntext =='Play')
		{
		$jquery(this).val('Stop');
		 var btntext = $jquery(this).attr('value');
		}
		else
		{
			$jquery(this).val('Play');
			var btntext = $jquery(this).attr('value');
			
		}
		if(btntext =='Stop')
		{
			refreshInterval = setInterval("animate()",2000);
		}
		else
		{
			
			clearInterval(refreshInterval);
		}
		});
		
		$jquery('#prev').click(function(){
		prevButton();
		});
	
		$jquery('#next').click(function(){
		nextButton();
		});
		
		});
		function setStyleSlideshow()
		{
			var pearl_slideshow_height ='<?php echo get_option('pearl_slideshow_height');?>';
	        var pearl_slideshow_width ='<?php echo get_option('pearl_slideshow_width');?>';
			var pearl_slideshow_bg_color ='<?php echo get_option('pearl_slideshow_bg_color');?>';
			var pearl_slideshow_border_color ='<?php echo get_option('pearl_slideshow_border_color');?>';
			var pearl_slideshow_border_width ='<?php echo get_option('pearl_slideshow_border_width');?>';
			var pearl_slideshow_padding ='<?php echo get_option('pearl_slideshow_padding');?>';
			
		   $jquery('#pearl_slideshow').css({
           "background-color":pearl_slideshow_bg_color,
		   "width":pearl_slideshow_width,
		   "height":pearl_slideshow_height,
		   "border-width":pearl_slideshow_border_width,
		   "border-style":"solid",
		   "border-color": pearl_slideshow_border_color,
		   "padding": pearl_slideshow_padding});
			
		}
		function animate()
	    {
		 var curPic =$jquery('#pearl_slideshow div.pearl_active');
		 var nexPic = curPic.next();
		 
		 if(nexPic.length==0)
		 {
			 nexPic =$jquery('#pearl_slideshow div:first');
		 }
		 
		 curPic.removeClass('pearl_active').addClass('prev').fadeOut(1000);
		 nexPic.removeClass('prev').addClass('pearl_active').fadeIn(1000);
			 
	    }
		function nextButton()
		{
		
		 var curPic =$jquery('#pearl_slideshow div.pearl_active');
	     var nexPic = curPic.next();
		 if(nexPic.length==0)
		 {
			  nexPic =$jquery('#pearl_slideshow div:first');
		 }
		 
		  curPic.removeClass('pearl_active').addClass('prev').fadeOut(1000);;
		  nexPic.removeClass('prev').addClass('pearl_active').fadeIn(1000);
		 
		
		}
	
		function prevButton()
		{
		 var curPic =$jquery('#pearl_slideshow div.pearl_active');
	     var nexPic = curPic.prev();
		 if(nexPic.length==0)
		 {
			  nexPic =$jquery('#pearl_slideshow div:last');
		 }
		  curPic.removeClass('pearl_active').addClass('prev').fadeOut(1000);;
		  nexPic.removeClass('prev').addClass('pearl_active').fadeIn(1000);
		
		}
	 
		</script>
		<?php
		
	}
	
	function pearl_slideshow_getImage($atts, $content = null)
	{
		$images =& get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . get_the_id() );
		$i=1;
		$display_image = '<div id="pearl_slideshow">';
	    foreach( $images as $imageID => $imagePost )
			{   
			if($i==1)
			{
				$i=0;
				$display_image .= '<div class="pearl_active">';
			}
			else
			{
				$display_image .= '<div>';
			}
				$display_image .= wp_get_attachment_image($imageID, $size, false);		
				$display_image .= '<span>'.get_the_title($imageID);
			//	$display_image .= ' . . .<a href="'.get_attachment_link($imageID).'" title="'.get_the_title($imageID).'">Read More</a>';
				$display_image .= '</span>';
				$display_image .= '</div>';
				
			}
		$display_image .= '</div>';
		$display_image .= '<div id="btnstyle"><input type="button" value="<<" class="btnclass" id="prev"/><input type="button" value="Play" class="btnclass" id="playbtn"/><input type="button" value=">>" class="btnclass" id="next"/></div>';
		
		return $display_image;		
	}
	
	function pearl_slideshow_install()
	{
		add_option('pearl_slideshow_width','400px','','yes');
		add_option('pearl_slideshow_height','340px','','yes');
		add_option('pearl_slideshow_bg_color','#eeeeee','','yes');
		add_option('pearl_slideshow_border_color','#000000','','yes');
		add_option('pearl_slideshow_border_width','1px','','yes');
		add_option('pearl_slideshow_padding','5px','','yes');
	}
	function pearl_slideshow_uninstall()
	{
		delete_option('pearl_slideshow_width');
		delete_option('pearl_slideshow_height');
		delete_option('pearl_slideshow_bg_color');
		delete_option('pearl_slideshow_border_color');
		delete_option('pearl_slideshow_border_width');
		delete_option('pearl_slideshow_padding');
	}
	
	function pearl_slideshow_menu()
	{
		add_options_page('Slideshow','Slideshow','manage_options',__FILE__,array('pearl_slideshow_class','pearl_slideshow_menu_page'));  
	}
	function pearl_slideshow_menu_page()
	{
		?>
        <div class="wrap">
           <h2>Slideshow Settings</h2>
           <?php
		       if($_REQUEST['submit'])
			   {
				   pearl_slideshow_class::pearl_slideshow_update_option();
			   }
			       pearl_slideshow_class::pearl_slideshow_print_option();
		   ?>
        </div>
        <?php
	}
	
	function pearl_slideshow_update_option()
	{
		$ok = false;
		
		if($_REQUEST['pearl_slideshow_height'])
		{
			update_option('pearl_slideshow_height',$_REQUEST['pearl_slideshow_height']);
			$ok = true;
			
		}
		if($_REQUEST['pearl_slideshow_width'])
		{
			update_option('pearl_slideshow_width',$_REQUEST['pearl_slideshow_width']);
			$ok = true;
			
		}
		if($_REQUEST['pearl_slideshow_border_color'])
		{
			update_option('pearl_slideshow_border_color',$_REQUEST['pearl_slideshow_border_color']);
			$ok = true;
			
		}
		if($_REQUEST['pearl_slideshow_border_width'])
		{
			update_option('pearl_slideshow_border_width',$_REQUEST['pearl_slideshow_border_width']);
			$ok = true;
			
		}
		if($_REQUEST['pearl_slideshow_bg_color'])
		{
			update_option('pearl_slideshow_bg_color',$_REQUEST['pearl_slideshow_bg_color']);
			$ok = true;
			
		}
		if($_REQUEST['pearl_slideshow_padding'])
		{
			update_option('pearl_slideshow_padding',$_REQUEST['pearl_slideshow_padding']);
			$ok = true;
			
		}
		
		
		if($ok)
		{?>
           <div id="message" class="updated fade">
           <p>Options Saved</p>
           </div>
        <?php
		}
		else
		{
			?>
           <div id="message" class="error fade">
           <p>Failed to save options</p>
           </div>
        <?php
		}
	}
	
	function pearl_slideshow_print_option()
	{
		include 'pearl_slideshow_admin.php';
	}
	
}
add_action('admin_menu',array($pearl_slideshow_class,'pearl_slideshow_menu'));
add_action('wp_print_styles', array($pearl_slideshow_class,'pearl_slideshow_css'));
add_action('wp_head', array($pearl_slideshow_class,'pearl_slideshow_script'));
add_shortcode('pearl_slideshow_display', array($pearl_slideshow_class,'pearl_slideshow_getImage'));
register_activation_hook(__FILE__,array($pearl_slideshow_class,'pearl_slideshow_install'));
register_deactivation_hook(__FILE__,array($pearl_slideshow_class,'pearl_slideshow_uninstall'));
?>