<?php

/*
Plugin Name: SEO For Images
Plugin URI: http://www.sdssssa.com/
Description: Auto amend images two necessary attributes ALT and TITLE base on user preference to <strong>improve the SEO, simple and practical! Imporve your images ranking, generate solid traffic from search enigine.</strong>
Version: 1.0.0
Author: Kason
Author URI: http://www.sdssas.com/


*/

$sfi_plugin_url = trailingslashit(get_bloginfo('wpurl')) . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__));
//  img 1 for demo - bridge in siwss
//$demo_img_bridge = $sfi_plugin_url . '/imgs/Chapel-Bridge.JPG';
function seo_for_images_add_pages()
{
    add_options_page('SEO for images options', 'SEO for images', 'manage_options', __FILE__, 'seo_for_images_options_page');
}


// Options Page
function seo_for_images_options_page()
{
    $demo_img_bridge = trailingslashit(get_bloginfo('wpurl')) . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)) . '/imgs/Chapel-Bridge.JPG';
    $setting_icon    = trailingslashit(get_bloginfo('wpurl')) . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)) . '/imgs/settings.png';
    
    
    // If form was submitted
    if (isset($_POST['submitted'])) {
        $alt_text       = (!isset($_POST['alttext']) ? '' : $_POST['alttext']);
        $title_text     = (!isset($_POST['titletext']) ? '' : $_POST['titletext']);
        $override       = (!isset($_POST['override']) ? 'off' : 'on');
        $override_title = (!isset($_POST['override_title']) ? 'off' : 'on');
        update_option('seo_for_images_alt', $alt_text);
        update_option('seo_for_images_title', $title_text);
        update_option('seo_for_images_override', $override);
        update_option('seo_for_images_override_title', $override_title);
        
        $msg_status = 'SEO for images options saved.';
        
        // Show message
        _e('<div id="message" class="updated fade"><p>' . $msg_status . '</p></div>');
    }
    
    if (isset($_GET['notice'])) {
        if ($_GET['notice'] == 1) {
            update_option('seo_for_images_notice', 1);
        }
    }
    
    // Fetch code from DB
    $alt_text       = get_option('seo_for_images_alt');
    $title_text     = get_option('seo_for_images_title');
    $override       = (get_option('seo_for_images_override') == 'on') ? "checked" : "";
    $override_title = (get_option('seo_for_images_override_title') == 'on') ? "checked" : "";
    
    global $sfi_plugin_url;
    $imgpath    = $sfi_plugin_url . '/i';
    $action_url = $_SERVER['REQUEST_URI'];
    
    // Configuration Page
    echo <<<END
				<div class="wrap">
				
				<style>
				
				h2{
				font-size:18px!important;
				}
				
				</style>
				<script>
				function loadtDemo(){
//ALT
	var demo_Title =  document.getElementById("demo_Title").value;
    var demo_Category = document.getElementById("demo_Category").value;
	var demo_Tags = document.getElementById("demo_Tags").value;
	var demo_name = document.getElementById("demo_name").value;
	var demo_alt = document.getElementById("demo_alt").value;

if(document.getElementById("check1").checked){
var check1_value = document.getElementById("alt_text").value;
check1_value = check1_value.replace(/#TITLE/g,demo_Title);
check1_value = check1_value.replace(/#CATEGORY/g,demo_Category);
check1_value = check1_value.replace(/#TAGS/g,demo_Tags);
check1_value = check1_value.replace(/#NAME/g,demo_name);
check1_value = check1_value.replace(/#ALT/g,demo_alt);
check1_value = check1_value.replace(/-/g,"");
check1_value = check1_value.replace("'","");
document.getElementById("demo_alt_return").value = check1_value;
}
else{
document.getElementById("demo_alt_return").value = demo_alt;
}
//TITLE
if(document.getElementById("check2").checked){
var check2_value = document.getElementById("title_text").value;
check2_value = check2_value.replace(/#TITLE/g,demo_Title);
check2_value = check2_value.replace(/#CATEGORY/g,demo_Category);
check2_value = check2_value.replace(/#TAGS/g,demo_Tags);
check2_value = check2_value.replace(/#NAME/g,demo_name);
check2_value = check2_value.replace(/#ALT/g,demo_alt);
check2_value = check2_value.replace(/-/g,"");
check2_value = check2_value.replace("'","");
document.getElementById("demo_title_return").value = check2_value;
}
else{
document.getElementById("demo_title_return").value = demo_Title;
}
}
</script>
				
					<h1>SEO for images</h1>
		
				 	<div id="mainblock" style="min-width:510px;width:550px;float:left;">
						<form name="sfiform" action="$action_url" method="post">
							<div class="dbx-content">
								<input type="hidden" name="submitted" value="1" />
								<h2><img  style="vertical-align:middle;" width="40px" src="$setting_icon"></img>General Options</h2>
								<p>Auto amend images two necessary attributes ALT and TITLE base on user preference to <strong>improve the SEO, simple and practical! Imporve your images ranking, generate solid traffic from search enigine.</strong></p>
	<p>Following links can help you:</p>
   
   <ul style="margin-left:40px;"> 
   <li><a href="http://www.lookingimage.com/wordpress-plugin/wordpress-seo-for-images/" target="_blank">Plugin details (FAQ .etc)</a></li>
   <li><a href="http://www.lookingimage.com/forums/discussion/" target="_blank">Support forum</a></li>
   <li><a href="http://lookingimage.com/" target="_blank">Author home page</a></li>
   <li><a href="http://www.lookingimage.com/wordpress-themes/" target="_blank">Free WordPress themes</a></li>
   <li><a href="http://www.lookingimage.com/wordpress-plugin/" target="_blank">Other pulgins from lookingimage.com</a></li>
   </ul>
								
								<ul>
									<li><strong>#TITLE </strong>   -> post/page title</li>
									<li><strong>#NAME    </strong>  -> image file name (without extension)</li>
									<li><strong>#CATEGORY </strong> -> post category</li>
									<li><strong>#TAGS    </strong>  -> post tags</li>
									<li><strong>#ALT     </strong> ->  the original alt of image (if exists)</li>
								</ul>
								<h4>Images options</h4>
								<div>
									<label for="alt_text"><b>ALT</b> attribute (e.g: #ALT and #TITLE)</label><br>
									<input style="border:1px solid #D1D1D1;width:235px;" onblur="loadtDemo()"  onchange="loadtDemo()" onkeyup="loadtDemo()" onkeypress="loadtDemo()" id="alt_text" name="alttext" value="$alt_text"/>
								</div>
								<br>
								<div>
									<label for="title_text"><b>TITLE</b> attribute (e.g: #CATEGORY #NAME xxxx.com)</label><br>
									<input style="border:1px solid #D1D1D1;width:235px;"  onblur="loadtDemo()" onchange="loadtDemo()" onkeyup="loadtDemo()" onkeypress="loadtDemo()" id="title_text" name="titletext" value="$title_text"/>
								</div>
								<br/>
								<div>
									<input id="check1" type="checkbox" name="override" $override onclick="loadtDemo()"  />
									<label for="check1">Replace default image alt (recommended)</label>
								</div>
								<br/>
								<div>
									<input id="check2" type="checkbox" name="override_title" $override_title onclick="loadtDemo()" />
									<label for="check2">Replace default image title</label>
								</div>
								<br/>

										<div style="border-top:1px solid #eee;clear:both;width:90%" > </div>
								<div class="submit"><input type="submit" class="button-primary" name="Submit" value="Update options" /></div>
								
							</div>
						</form>
						<br />
						
					</div>
					
					
					<div id="sfi_sidebar" class="sfi_sidebar" style="float:left;min-width:400px; width:500px;margin-top: -20px;">
					<div style="border:5px solid #ECECFF;padding:8px;">
					<h2>Quick demo - post</h2>
					<p><ul>
					<li><b>Post title:</b> Stay in Luzern</li>
					 <li><b>Category:</b> Photograph  </li>
					 <li><b>Tags:</b> Travel, Luzern, Switzerland</li>
					 <li><b>Image file name:</b> Chapel-Bridge.jpg</li>
					 <li><b>Image alt:</b> Chapel Bridge</li>
					</ul>
					
					<input id="demo_Title" type="hidden" value="Stay in Luzern" />
					<input id="demo_Category" type="hidden" value="Photograph" />
					<input id="demo_Tags" type="hidden" value="Travel, Luzern, Switzerland" />
					<input id="demo_name" type="hidden" value="Chapel Bridge" />
					<input id="demo_alt" type="hidden" value="Chapel Bridge" />
					
					<img style="border:3px solid #eee;" src= $demo_img_bridge ></img>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. In interdum purus vel libero rhoncus porta. In vel velit nibh. 
					</p>
					</div>
					<br/>
					<ul>
					<li>Image Alt: &nbsp;&nbsp;&nbsp;&nbsp;<input id="demo_alt_return" type="text" readonly="readonly" style="width:300px;" value="Chapel Bridge" /></li>
					
					<li>Image Title: &nbsp;<input id="demo_title_return" type="text" readonly="readonly" style="width:300px;" value="Stay in Luzern"  /></li>
					</ul>
					</div>
			<script>
			loadtDemo();
			</script>
				</div>
<br/>



		
END;
}

// Add Options Page
add_action('admin_menu', 'seo_for_images_add_pages');

function remove_extension($name)
{
    return preg_replace('/(.+)\..*$/', '$1', $name);
}
function seo_for_images_process($matches)
{
    global $post;
    $title          = $post->post_title;
    $alt_derc       = get_option('seo_for_images_alt');
    $title_derc     = get_option('seo_for_images_title');
    $override       = get_option('seo_for_images_override');
    $override_title = get_option('seo_for_images_override_title');
    
    
    $matches[0] = preg_replace('|([\'"])[/ ]*$|', '\1 /', $matches[0]);
    
    
    $matches[0] = preg_replace('/\s*=\s*/', '=', substr($matches[0], 0, strlen($matches[0]) - 2));
    
    
    preg_match('/src\s*=\s*([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/', $matches[0], $source);
    
    $saved = $source[2];
    
    // file's base name.
    preg_match('%[^/]+(?=\.[a-z]{3}\z)%', $source[2], $source);
    // Separate attributes
    $arr_img = preg_split('/(\w+=)/', $matches[0], -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    
    
    $postcats = get_the_category();
    $cats     = "";
    if ($postcats) {
        foreach ($postcats as $cat) {
            $cats = $cat->slug . ' ' . $cats;
        }
    }
    
    $posttags = get_the_tags();
    
    $tags = "";
    if ($posttags) {
        foreach ($posttags as $tag) {
            $tags = $tag->name . ' ' . $tags;
        }
    }
    
    if (!in_array('title=', $arr_img) || $override_title == "on") {
        $title_derc = str_replace("#TITLE", $post->post_title, $title_derc);
        $title_derc = str_replace("#NAME", $source[0], $title_derc);
        $title_derc = str_replace("#CATEGORY", $cats, $title_derc);
        $title_derc = str_replace("#TAGS", $tags, $title_derc);
        
        $title_derc = str_replace('"', '', $title_derc);
        $title_derc = str_replace("'", "", $title_derc);
        
        $title_derc = str_replace("_", " ", $title_derc);
        $title_derc = str_replace("-", " ", $title_derc);
        //$title_derc=ucwords(strtolower($title_derc));
        if (!in_array('title=', $arr_img)) {
            array_push($arr_img, ' title="' . $title_derc . '"');
        } else {
            $num_key               = array_search('title=', $arr_img);
            $arr_img[$num_key + 1] = '"' . $title_derc . '" ';
        }
    }
    
    if (!in_array('alt=', $arr_img) || $override == "on") {
        $alt_derc = str_replace("#TITLE", $post->post_title, $alt_derc);
        $alt_derc = str_replace("#NAME", $source[0], $alt_derc);
        $alt_derc = str_replace("#CATEGORY", $cats, $alt_derc);
        $alt_derc = str_replace("#TAGS", $tags, $alt_derc);
        $alt_derc = str_replace("\"", "", $alt_derc);
        $alt_derc = str_replace("'", "", $alt_derc);
        $alt_derc = (str_replace("-", " ", $alt_derc));
        $alt_derc = (str_replace("_", " ", $alt_derc));
        
        if (!in_array('alt=', $arr_img)) {
            array_push($arr_img, ' alt="' . $alt_derc . '"');
        } else {
            $num_key = array_search('alt=', $arr_img);
            //echo $arr_img[$num_key] . '|';
            //echo  $arr_img[$num_key+1];
            $org_alt = $arr_img[$num_key + 1];
            
            
            unset($arr_img[$num_key]);
            unset($arr_img[$num_key + 1]);
            // array_splice($arr_img,$num_key,1);  
            //   array_splice($arr_img,$num_key+1,1);  
            
            $alt_derc = str_replace("#ALT", $org_alt, $alt_derc);
            $alt_derc = str_replace("\"", "", $alt_derc);
            $alt_derc = str_replace("'", "", $alt_derc);
            $alt_derc = (str_replace("-", " ", $alt_derc));
            $alt_derc = (str_replace("_", " ", $alt_derc));
            
            //echo $alt_derc . '<br/>';
            
            array_push($arr_img, ' alt="' . $alt_derc . '"');
            
            //	$arr_img[$num_key+1]='"'.$alt_derc. '" ';
            
            
            
        }
    }
    return implode('', $arr_img) . ' /';
}
function seo_for_images($content)
{
    return preg_replace_callback('/<img[^>]+/', 'seo_for_images_process', $content);
}
add_filter('the_content', 'seo_for_images', 100);
//add_action( 'after_plugin_row', 'seo_for_images_check_plugin_version' );


function seo_for_images_install()
{
    if (!get_option('seo_for_images_alt')) {
        add_option('seo_for_images_alt', '#NAME #TITLE');
    }
    if (!get_option('seo_for_images_title')) {
        add_option('seo_for_images_title', '#TITLE');
    }
    if (get_option('seo_for_images_override' == '') || !get_option('seo_for_images_override')) {
        add_option('seo_for_images_override', 'on');
    }
    if (get_option('seo_for_images_override_title' == '') || !get_option('seo_for_images_override_title')) {
        add_option('seo_for_images_override_title', 'off');
    }
    
}

add_action('plugins_loaded', 'seo_for_images_install');