<?php $default_pearl_slideshow_height = get_option('pearl_slideshow_height');
      $default_pearl_slideshow_width = get_option('pearl_slideshow_width');
	  $default_pearl_slideshow_bg_color = get_option('pearl_slideshow_bg_color');
      $default_pearl_slideshow_border_color = get_option('pearl_slideshow_border_color');
	  $default_pearl_slideshow_border_width = get_option('pearl_slideshow_border_width');
	  $default_pearl_slideshow_padding = get_option('pearl_slideshow_padding');
		?>
      <form method="post">
           <label for="pearl_slideshow_width">Width :</label>
           <input type="text" name="pearl_slideshow_width" value="<?php echo $default_pearl_slideshow_width;?>"/>
           <label for="pearl_slideshow_height">Height :</label>
           <input type="text" name="pearl_slideshow_height" value="<?php echo $default_pearl_slideshow_height;?>"/><br/>
           <label for="pearl_slideshow_border_width">Border Width :</label>
           <input type="text" name="pearl_slideshow_border_width" value="<?php echo $default_pearl_slideshow_border_width;?>"/>
           <label for="pearl_slideshow_border_color">Border Color :</label>
           <input type="text" name="pearl_slideshow_border_color" value="<?php echo $default_pearl_slideshow_border_color;?>"/><br/>
           <label for="pearl_slideshow_bg_color">Background Color :</label>
           <input type="text" name="pearl_slideshow_bg_color" value="<?php echo $default_pearl_slideshow_bg_color;?>"/>
           <label for="pearl_slideshow_padding">Padding :</label>
           <input type="text" name="pearl_slideshow_padding" value="<?php echo $default_pearl_slideshow_padding;?>"/>
           
           <input type="submit" name="submit" value="Submit"/>
        </form>