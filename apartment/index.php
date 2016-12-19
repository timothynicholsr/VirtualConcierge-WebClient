<?php 
session_start();
$_SESSION['page_name']='';
?>
<!doctype html> 
<html lang="en">	
    <head>
        <!-- Basic Page Needs ======================== -->
        <meta charset="utf-8">
        <title></title>
        <!-- Mobile Specific Metas ===================== -->
        <meta content="width=device-width, initial-scale=1, user-scalable=no" name="viewport">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <!-- favicon ================================================== -->
        <link rel="shortcut icon" type="" />
        <link rel="apple-touch-icon" href="">
        <link rel="apple-touch-icon" sizes="72x72" href="">
        <link rel="apple-touch-icon" sizes="114x114" href="">
        <link rel="stylesheet" href="css/style.css" type="text/css" />
		<script src="js/jquery-2.2.4.js" ></script>
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<?php 
include('helper.php');
$listing_id=(isset($_GET['id']) && $_GET['id'] != ''  ? $_GET['id'] : 1);
$url=URl;
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);
$page_content = json_decode($result);
if(!empty($page_content)){
foreach($page_content as $page){
	if($page->room_id==$listing_id){	
if(!empty($page->languages))
	{
		
	foreach($page->languages as $language)
		{
				$default_language=(isset($_GET['lang']) && $_GET['lang'] != ''  ? $_GET['lang'] : $page->default_language);
				$name=(isset($page->name) && $page->name != ''  ? $page->name : '');
				$country=(isset($page->country) && $page->country != ''  ? $page->country : '');
				$owner_image=(isset($page->owner_image) && $page->owner_image != ''  ? $page->owner_image : '');
				$background_image=(isset($page->background_image) && $page->background_image != ''  ? $page->background_image : '');
				$background_image_two=(isset($page->background_image_two) && $page->background_image_two != ''  ? $page->background_image_two : $background_image);
				$background_color=(isset($page->background_color) && $page->background_color != ''  ? $page->background_color : '');
				$background_color_two=(isset($page->background_color_two) && $page->background_color_two != ''  ? $page->background_color_two : $background_color);
				$button_background_color=(isset($page->button_background_color) && $page->button_background_color != ''  ? $page->button_background_color : '');
				$text_color=(isset($page->text_color_three) && $page->text_color_three != ''  ? $page->text_color_three : '');
				$data['name']=$name;
				$data['country']=$country;
				$data['owner_image']=$owner_image;
				$data['background_image']=$background_image;
				$data['background_image_two']=$background_image_two;
				$data['background_color']=$background_color;
				$data['background_color_two']=$background_color_two;
				$data['button_background_color']=$button_background_color;
				$data['text_color']=$text_color;
				$lan['id']=$language->id;
				$lan['language']=$language->language;
			   // $lang[]=$language->language;
			    $lang[]=$lan;
		if($language->language==$default_language)
			{ 	
				 $page_language=($language->language != '' && isset($language->language) ? $language->language : '');
				 $main_header_text=($language->main_header_text != '' && isset($language->main_header_text) ? $language->main_header_text : '');
				 $welcome_text=($language->welcome_text != '' && isset($language->welcome_text) ? $language->welcome_text : '');
				 $data['welcome_text']=$welcome_text;
				 $data['main_header_text']=$main_header_text;
					 if(!empty($language->buttons))
							{
								foreach($language->buttons as $buttons)
									{
										 $button['name']=($buttons->name != '' && isset($buttons->name) ? $buttons->name : '');
										 $button['icon']=($buttons->icon != '' && isset($buttons->icon) ? $buttons->icon : '');
										 $button['text']=($buttons->text != '' && isset($buttons->text) ? $buttons->text : '');
										 $button['type']=($buttons->page_type != '' && isset($buttons->page_type) ? $buttons->page_type : '');
										 $button['video_url']=($buttons->video_url != '' && isset($buttons->video_url) ? $buttons->video_url : '');
										 $button['language']=($buttons->language != '' && isset($buttons->language) ? $buttons->language : '');
										 $button['page_id']=($buttons->page_id != '' && isset($buttons->page_id) ? $buttons->page_id : '');
										 $data_button[]=$button;
									}
							} 
			}
			
			if(!empty($data_button)){
				$data['btn']=$data_button;
			}
			if(!empty($lang)){
				$data['lang']=$lang;
			}	
			
	}
}
}
}

}

?>			 
			 
  <style>
	  .header .topBar {
		  background:url(<?php echo $data['background_image']?>) no-repeat top center; 
		  }
		 .contentBox{background:url(<?php echo $data['background_image_two']?>) no-repeat top center;} 
	<?php 
	  if(strlen($data['button_background_color']) >= 7) {
		//  echo $data['button_background_color'];
     $background_color = substr($data['button_background_color'],0,7);
      $background_color1 = substr($data['button_background_color'],1,6);
	  $hex= hex2rgb($background_color);
      //$code = substr($data['button_background_color'],-1);
      $code=substr($data['button_background_color'],-2, 2);
      $code_c='#'.$code.$background_color1;
      $rgb_Color=argb2rgba($code_c);
      
   } else {
    $rgb_Color=$data['button_background_color'];
    $code='';
     $hex='';
   }
   ?>
.fix-container {
				margin: 0 auto;
				max-width: 1190px;
				width: 100%;
				padding: 0;
				background: <?php echo $data['background_color'];?>;
}  
.contentBox .navBox li a:hover { background: <?php echo $background_color;?>;}
.contentBox .navBox:before{content:""; position:absolute;left:0px;top:0px;width:100%;  height:100%;<?php echo ($rgb_Color !='' ?  "background:$rgb_Color;": '');?> 
	!important;z-index:-1;
	 }
.footer .change-lang .dropdown .submenu li a:hover{color: #fff;  background:<?php echo $background_color;?> ;}
.footer .change-lang .dropdown .submenu li a {color: <?php echo $data['text_color'];?>;}  
  </style>
    </head>
    <?php
if(!empty($data)){
	?>
	<body>
        <main class="wrapper">
            <!-- container start here -->
            <div class="fix-container">
                <header class="header">
                    <div class="topBar">
                        <h1><?php echo $data['main_header_text']?></h1>
                    </div>
                    <div class="bottomBar">
                        <div class="leftBar"> <?php echo  str_replace('[INSERT NAME HERE]',$data['name'],$data['welcome_text']);?></div>
                        <div class="rightBar">
                            <img src="<?php echo $data['owner_image']?>"/>
                        </div>
                    </div>
                </header><!-- header end -->
                <div class="contentBox">                 		
				 <?php 
				  if(!empty($data['btn'])){
					  ?>
					   <ul class="navBox">
					  <?php
					   if(isset($_GET['lang'])){
								$link_page='?id='.$_GET['id'].'&lang='.$_GET['lang'].'&page_id=';
							}
							else {
								$link_page='?id='.$_GET['id'].'&page_id=';
							}
				 foreach($data['btn'] as $button_link){
            	  //echo "<pre>";print_r($button_link);echo"</pre>";
					 ?>
						 <li>
                            <a href="page.php<?php echo $link_page.$button_link['page_id'].'&page_type='.$button_link['type'];
                            $_SESSION['page'.$button_link['page_id']] = $button_link['icon'];
                            if($button_link['type']=='video'){
                            ($button_link['video_url'] != '' ? $_SESSION['video_url'] = $button_link['video_url'] : '');
                            $_SESSION['text'] = $button_link['text'];
                            $_SESSION['name'] = $button_link['name'];
                            $_SESSION['icon_pic'] = $button_link['icon'];
						    }   
                            ?>">
                                <i class="<?php echo $button_link['icon']?>"></i><span><?php echo $button_link['text']?></span>
                            </a>
                        </li>
					 <?php	 
					 }} ?>		
				 
                    </ul>
                </div><!-- contentBox end -->
                <footer class="footer">
                    <div class="change-lang">
                        <ul class='render_list'>
							 <script>
								 function get_width(w) {
										var width=screen.width;
										    return width-w;
												}
								 </script>
							 <?php 
								 if(isset($_GET['id'])){
								
								$link='?id='.$_GET['id'].'&lang=';
							}
							else {
								$link='?lang=';
							}
							 $html='';
							 $count=1;
							 $flag=array('de','tr','ru');
							 	 $width=90;
							 	 ?>
							 	 <script>
									    var ht="";
									    var ht11="";
							 	 </script>
							 	 <?php
							 	
							  if(!empty($data['lang']))
							  {
								  $count=1;
								  
							 foreach($data['lang'] as $lang_link){	
								// print_r($lang_link);							 
								 ?>							 
							    <script>
									$(window).resize(function(){										
										//location.reload();
										});
									 var select_width=get_width(<?php echo $count*$width;?>);	
										var total_width=screen.width;	
							 	        	if(select_width >= 70){
												var ht1='';
										       var ht1_end='';
											}
											else {
												var ht1='<li class="dropdown"><a href="#"></a><ul class="submenu">';
												var ht1_end='</ul></li>';
											}
									
										if(select_width >= 50){
											
											ht+="<li ><a href='<?php echo $link.$lang_link['language'].'&lang_id='.$lang_link['id'].'';?>'><img src='images/<?php echo $lang_link['language'];?>.png'/></a></li>";
										}
										else {
											console.log(2);
											ht11+="<li><a href='<?php echo $link.$lang_link['language'].'&lang_id='.$lang_link['id'].'';?>'><?php echo $lang_link['language'];?></a></li>";
										}		
								 </script>
								<li class='list_weight'><a href="<?php echo $link.$lang_link['language'].'&lang_id='.$lang_link['id'].'';?>"><img src="images/<?php echo $lang_link['language'];?>.png"/></a></li>
								 <?php
					 					$count++;
					 }   
				  }
					 ?>	
                        </ul>       
                    </div>
                </footer>
                <script>
               $('.render_list').html(ht+ht1+ht11+ht1_end);
                </script>
            </div><!-- container end here -->
        </main>
    </body>
	<?php	
}
else 
{
?>
<h2>NO Page found</h2>
<?php
}
?>
    
</html>
