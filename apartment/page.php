<?php 
session_start();
//print_r($_SESSION['page'])

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
$page_id=(isset($_GET['page_id']) && $_GET['page_id'] != ''  ? $_GET['page_id'] : 1);
$url='http://159.203.92.158:8181/api/listings/30?key=4daa6722ac1da9c6c425e618c9eb3f3f';
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);
$page_content = json_decode($result);

foreach($page_content as $page){
	if($page->room_id==$listing_id){	
if(!empty($page->languages))
	{	
	foreach($page->languages as $language)
		{
				//$default_language=(isset($_GET['lang']) && $_GET['lang'] != ''  ? $_GET['lang'] : $page->default_language);
				$default_language=(isset($_GET['lang']) && $_GET['lang'] != ''  ? $_GET['lang'] : $page->default_language);
				$name=(isset($page->name) && $page->name != ''  ? $page->name : '');
				$country=(isset($page->country) && $page->country != ''  ? $page->country : '');
				$background_image=(isset($page->background_image) && $page->background_image != ''  ? $page->background_image : '');
				$background_image_two=(isset($page->background_image_two) && $page->background_image_two != ''  ? $page->background_image_two : $background_image);
				$background_color=(isset($page->background_color) && $page->background_color != ''  ? $page->background_color : '');
				$background_color_two=(isset($page->background_color_two) && $page->background_color_two != ''  ? $page->background_color_two : $background_color);
				$button_background_color=(isset($page->button_background_color) && $page->button_background_color != ''  ? $page->button_background_color : '');
				$text_color=(isset($page->text_color_three) && $page->text_color_three != ''  ? $page->text_color_three : '');
				$data['name']=$name;
				$data['country']=$country;
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
			   // echo $default_language;
		if($language->language==$default_language)
			{ 	
				
				 if(!empty($language->buttons))
							{
								foreach($language->buttons as $buttons)
									{
										//print_r($buttons);
									}
							} 
				
				 $page_language=($language->language != '' && isset($language->language) ? $language->language : '');
					 if(!empty($language->pages))
							{
								//echo "<pre>";
								//print_r($language->pages);
								//echo"</pre>";
								//die();
								foreach($language->pages as $page_data)
									{
									if($page_id =='0'){
										Echo "There is no page";
										die();
									}
									else { 
										//echo $_SESSION['page_name'];
							       if($_SESSION['page_name'] ==''){
									  if($page_data->id == $page_id){
									//echo $page_data->name;
									$name=(isset($page_data->name) && $page_data->name != ''  ? $page_data->name : '');
									$title_text=(isset($page_data->title_text) && $page_data->title_text != ''  ? $page_data->title_text : '');
									$background_one_image=(isset($page_data->background_one_image) && $page_data->background_one_image != ''  ? $page_data->background_one_image : '');
									$background_two_image=(isset($page_data->background_two_image) && $page_data->background_two_image != ''  ? $page_data->background_two_image : '');
									$section_one_text=(isset($page_data->section_one_text) && $page_data->section_one_text != ''  ? $page_data->section_one_text : '');
									$section_two_text=(isset($page_data->section_two_text) && $page_data->section_two_text != ''  ? $page_data->section_two_text : '');
									$section_three_text=(isset($page_data->section_three_text) && $page_data->section_three_text != ''  ? $page_data->section_three_text : '');
									$data['page_name']=$name;
									$data['page']=1;
									$data['title_text']=$title_text;
									$data['background_one_image']=$background_one_image;
									$data['background_two_image']=$background_two_image;
									$data['section_one_text']=$section_one_text;
									$data['section_two_text']=$section_two_text;
									$data['section_three_text']=$section_three_text;
									 if(!empty($page_data->sections))
										{
											$section_count=1;
											foreach($page_data->sections as $section_data)
												{
													//echo "<pre>";print_r($section_data);echo"</pre>"; 
													 $section['title']=($section_data->title != '' && isset($section_data->title) ? $section_data->title : '');
													 $section['url']=(isset($section_data->url) &&  $section_data->url != '' ? $section_data->url : '');
													 $section['text']=($section_data->text != '' && isset($section_data->text) ? $section_data->text : '');
												     //$section_array[]=$section;
												     
												      $data['section'.$section_count]=$section;
												     $section_count++;
												}
											
										}	
									} 
								   }
								   else {
									   //echo $page_data->name;
									   if($page_data->name == $_SESSION['page_name']){
									//echo $page_data->name;
									$name=(isset($page_data->name) && $page_data->name != ''  ? $page_data->name : '');
									$title_text=(isset($page_data->title_text) && $page_data->title_text != ''  ? $page_data->title_text : '');
									$background_one_image=(isset($page_data->background_one_image) && $page_data->background_one_image != ''  ? $page_data->background_one_image : '');
									$background_two_image=(isset($page_data->background_two_image) && $page_data->background_two_image != ''  ? $page_data->background_two_image : '');
									$section_one_text=(isset($page_data->section_one_text) && $page_data->section_one_text != ''  ? $page_data->section_one_text : '');
									$section_two_text=(isset($page_data->section_two_text) && $page_data->section_two_text != ''  ? $page_data->section_two_text : '');
									$section_three_text=(isset($page_data->section_three_text) && $page_data->section_three_text != ''  ? $page_data->section_three_text : '');
									$data['page_name']=$name;
									$data['page']=1;
									$data['title_text']=$title_text;
									$data['background_one_image']=$background_one_image;
									$data['background_two_image']=$background_two_image;
									$data['section_one_text']=$section_one_text;
									$data['section_two_text']=$section_two_text;
									$data['section_three_text']=$section_three_text;
									 if(!empty($page_data->sections))
										{
											$section_count=1;
											foreach($page_data->sections as $section_data)
												{
													//echo "<pre>";print_r($section_data);echo"</pre>"; 
													 $section['title']=($section_data->title != '' && isset($section_data->title) ? $section_data->title : '');
													 $section['url']=(isset($section_data->url) &&  $section_data->url != '' ? $section_data->url : '');
													 $section['text']=($section_data->text != '' && isset($section_data->text) ? $section_data->text : '');
												     //$section_array[]=$section;
												     
												      $data['section'.$section_count]=$section;
												     $section_count++;
												}
											
										}	
									}
									   
								   }
								
									
									
								}	
									}
							} 
			}
			/*
			if(!empty($section_array)){
				$data['section']=$section_array;
			}
			*/
			if(!empty($lang)){
				$data['lang']=$lang;
			}	 
	}
}
}
}

;
?>			 
			 
  <style>
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
	  .header{background:#000;text-align: center;}
	 .section-1 {
		  background:url(<?php echo $data['background_one_image']?>) no-repeat top center; 
		  }
		 .section-3{background:url(<?php echo $data['background_two_image']?>) no-repeat top center;} 
		 .contentBox {
  min-height: 475px;
  position: relative;
}
.section-text {
  padding: 20px;
  left: 0;
  position: absolute;
  text-align: center;
  top: 50%;
  transform: translate(0px, -50%);
  -o-transform: translate(0px, -50%);
  -moz-transform: translate(0px, -50%);
  -ms-transform: translate(0px, -50%);
  -webkit-transform: translate(0px, -50%);
  width: 100%;
  color:<?php echo $data['text_color'];?>;
}
.contentBox.section-2 {
  background: #1a1a1a none repeat scroll 0 0;
  border: 15px solid #fff;
  box-shadow: 15px 15px 0 #000 inset, -15px -15px 0 0 #000 inset;
  -o-box-shadow: 15px 15px 0 #000 inset, -15px -15px 0 0 #000 inset;
  -moz-box-shadow: 15px 15px 0 #000 inset, -15px -15px 0 0 #000 inset;
  -ms-box-shadow: 15px 15px 0 #000 inset, -15px -15px 0 0 #000 inset;
  -webkit-box-shadow: 15px 15px 0 #000 inset, -15px -15px 0 0 #000 inset;
}
.section-text h3, .section-text-on-top h1 {font-size: 30px;}
.section-text-on-top {
  color: #fff;
  position: relative;
  z-index: 2;
}
.overlay-div::before {
 <?php echo ($rgb_Color !='' ?  "background:$rgb_Color;": '');?>  none repeat scroll 0 0;
  box-shadow: 0 0 0 5px #fff;
  content: "";
  height: 88%;
  left: 2%;
  position: absolute;
  top: 6%;
  width: 96%;
  z-index: 1;
}
.overlay-div {
  padding: 20px 2%;
  z-index: 2;
}
.section-text-on-top ul {margin: 30px 0 0;}
.section-text-on-top li {padding: 5px 0;}
.icon_image {
    width: 70px;
    height: 75px;
    vertical-align: middle;
    display: table;
    vertical-align: middle;
    background-size: 100% auto !important;
    margin: 0 auto;
}
.header h1 {
  color: <?php echo $data['text_color'];?>;
  font-size: 20px;
  margin: 10px 0 0;
}
h1, h2, h3, h4, h5, h6 {
    font-weight: 600;
}
@media (max-width:767px){
		.contentBox {min-height: 275px;}
		.section-text h3, .section-text-on-top h1 {font-size: 20px;}
		.icon_image{height: 55px;width: 50px;}
}
.pad{
padding:20px;	
}
.img-text{
	display: inline;
    float: left;
    padding: 17px;
}
  </style>
    </head>
    <?php
if(!empty($data)  && isset($data['page'])){
	$_SESSION['page_name']=$data['page_name'];
	//echo"<pre>";
	//print_r($data);
	//echo"</pre>";
	?>
	<body>
        <main class="wrapper">
            <!-- container start here -->
            <?php 
                  if(isset($data['section2']) || isset($data['section1'])){
					  
				  
                  ?> 
              <div class="fix-container">
                <header class="header">
					<i class="<?php echo (isset($_SESSION['page'.$page_id]) ? $_SESSION['page'.$page_id] : '');?> icon_image"></i>
					<h1><?php echo (isset($data['section1']) ? strtoupper($data['section1']['text']) : '');?></h1>
                    
                </header><!-- header end -->
                <div class="contentBox section-1">
						<div class="section-text">
								 <h3><?php echo (isset($data['section2']) ? strtoupper($data['section2']['text']) : '');?></h3>
						 </div>
                    </div>
                    <?php
				}
                    ?>
                  <?php 
                  if(isset($data['section3']) || isset($data['section4'])){
					  
				  
                  ?>  
                <div class="contentBox section-2">
					<div class="section-text">
						 <h3 class='pad'><?php echo (isset($data['section3']) ? strtoupper($data['section3']['text']) : '');?></h3>
						 <h3 class='pad'><?php echo (isset($data['section4']) ? strtoupper($data['section4']['text']) : '');?></h3>
				    </div>
                </div>
                <?php
			}
                ?>
                 <?php 
                  if(isset($data['section5']) || isset($data['section6']) || isset($data['section7'])){
					  
				  
                  ?>  
                   <div class="contentBox section-3">
					<div class="overlay-div">
						<div class="section-text-on-top">
							<div class='img-text'>
					      <h1><?php echo (isset($data['section5']) ? strtoupper($data['section5']['text']) : '');?></h1>
					  		<ul>
								 <li><?php echo (isset($data['section6']) ? $data['section6']['text'] : '');?></li>
								 <li><?php echo (isset($data['section7']) ? $data['section7']['text'] : '');?></li>
							</ul>
							</div>
							<div class='img-borderss'>
							<!--<img src='images/cable-img.jpg'> -->
							</div>
						 </div>
					 </div>
                </div>
                <?php
			}
                ?>
                <!-- contentBox end -->
                <footer class="footer">
                    <div class="change-lang">
                        <ul class='render_list'>
							 <script>
								 function get_width(w) 
									{
										var width=screen.width;
										return width-w;
								    }
								 </script>
							 <?php 
							 if(isset($_GET['id']))
								{
								$link='?id='.$_GET['id'].'&page_id='.$_GET['page_id'].'&lang=';
								}
								else 
									{
									//$link='?id='.$_GET['id'].'&page_type'.$_GET['page_type'].'&lang=';
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
											//console.log(1);
											ht+="<li ><a href='<?php echo $link.$lang_link['language'].'&lang_id='.$lang_link['id'].'';?>'><img src='images/<?php echo $lang_link['language'];?>.png'/></a></li>";
										}
										else {
											//console.log(2);
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
               //   console.log(ht+ht1+ht11+ht1_end);
                </script>
            </div><!-- container end here -->
        </main>
    </body>
	<?php	
}
else {
	echo "No page found";
}
?>

    
</html>
