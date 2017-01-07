<?php 
date_default_timezone_set('UTC');

session_start();
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
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
        <link rel="stylesheet" href="css/style.css" type="text/css" />
		<script src="js/jquery-2.2.4.js" ></script>
		  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<?php 
include('helper.php');
$listing_id=(isset($_GET['id']) && $_GET['id'] != ''  ? $_GET['id'] : 1);
$page_id=(isset($_GET['page_id']) && $_GET['page_id'] != ''  ? $_GET['page_id'] : 1);
$url=URl;
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);
$page_content = json_decode($result);

foreach($page_content as $page)
	{
	if($page->room_id==$listing_id)
		{	
			if(!empty($page->languages))
				{	
				foreach($page->languages as $language)
					{
						$default_language=(isset($_GET['lang']) && $_GET['lang'] != ''  ? $_GET['lang'] : $page->default_language);
						$name=(isset($page->name) && $page->name != ''  ? $page->name : '');
						$country=(isset($page->country) && $page->country != ''  ? $page->country : '');
						$background_image=(isset($page->background_image) && $page->background_image != ''  ? $page->background_image : '');
						$background_image_two=(isset($page->background_image_two) && $page->background_image_two != ''  ? $page->background_image_two : $background_image);
						$background_color=(isset($page->background_color) && $page->background_color != ''  ? $page->background_color : '');
						$background_color_two=(isset($page->background_color_two) && $page->background_color_two != ''  ? $page->background_color_two : $background_color);
						$button_background_color=(isset($page->button_background_color) && $page->button_background_color != ''  ? $page->button_background_color : '');
						$text_color=(isset($page->text_color_three) && $page->text_color_three != ''  ? $page->text_color_three : '');
						$allow_request_later_date=(isset($page->allow_request_later_date) && $page->allow_request_later_date != ''  ? $page->allow_request_later_date : '');
						$guest_first_name=(isset($page->guest_first_name) && $page->guest_first_name != ''  ? $page->guest_first_name : '');
						$guest_last_name=(isset($page->guest_last_name) && $page->guest_last_name != ''  ? $page->guest_last_name : '');
						$data['name']=$name;
						$data['country']=$country;
						$data['background_image']=$background_image;
						$data['background_image_two']=$background_image_two;
						$data['background_color']=$background_color;
						$data['background_color_two']=$background_color_two;
						$data['button_background_color']=$button_background_color;
						$data['text_color']=$text_color;
						$data['allow_request_later_date']=$allow_request_later_date;
						$data['guest_first_name']=$guest_first_name;
						$data['guest_last_name']=$guest_last_name;
						$lan['id']=$language->id;
						$lan['language']=$language->language;
						$lang[]=$lan;
		/* GET LANGUAGE AND RENDER DATA */					
				if($language->language==$default_language)
					{ 	
						$page_language=($language->language != '' && isset($language->language) ? $language->language : '');
				/* GET LANGUAGE PAGES AND RENDER DATA */				
						 if(!empty($language->pages))
							{
								foreach($language->pages as $page_data)
									{
										/* fOR LANGUAGE LOOP AND RENDER DATA */	
										if($page_id =='0')
											 {
												Echo "There is no page";
												die(); 
											 }
										else { 
											
											if($_SESSION['page_name'] =='')
												{
												   if($_GET['page_type']=='video')
													{
													 if($_SESSION['video_url']!='')
														{
															 $data_video['video']=$_SESSION['video_url'];
															 $data_video['text']=$_SESSION['text'];
															 $data_video['name']=$_SESSION['name'];
															 $data_video['icon_pic']=$_SESSION['icon_pic'];
														}
													}
										   else
												{
													  if($page_data->id == $page_id)
														{
															$name=(isset($page_data->name) && $page_data->name != ''  ? $page_data->name : '');
															$title_text=(isset($page_data->title_text) && $page_data->title_text != ''  ? $page_data->title_text : '');
															$background_one_image=(isset($page_data->background_one_image) && $page_data->background_one_image != ''  ? $page_data->background_one_image : '');
															$background_two_image=(isset($page_data->background_two_image) && $page_data->background_two_image != ''  ? $page_data->background_two_image : '');
															$section_one_text=(isset($page_data->section_one_text) && $page_data->section_one_text != ''  ? $page_data->section_one_text : '');
															$section_two_text=(isset($page_data->section_two_text) && $page_data->section_two_text != ''  ? $page_data->section_two_text : '');
															$section_three_text=(isset($page_data->section_three_text) && $page_data->section_three_text != ''  ? $page_data->section_three_text : '');
															$data['page_name']=$name;
															$data['page']=1;
															$data['page_type']=$_GET['page_type'];
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
									   else {
										   if($page_data->name == $_SESSION['page_name'])
												{
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
													$data['page_type']=$_GET['page_type'];
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
									/* End FOR LANGUAGE LOOP AND RENDER DATA */	
						  } 
						  /* END LANGUAGE PAGES AND RENDER DATA */	
					}
				/* END LANGUAGE AND RENDER DATA */			
	
	/* GET LANGUAGE ARRAY */						
	if(!empty($lang)){
		$data['lang']=$lang;
	}	 
					}
				}
		}
	}
?>			 		 
  <style>
<?php 
if(strlen($data['button_background_color']) >= 7) 
	{
		$background_color = substr($data['button_background_color'],0,7);
		$background_color1 = substr($data['button_background_color'],1,6);
		$hex= hex2rgb($background_color);
		$code=substr($data['button_background_color'],-2, 2);
		$code_c='#'.$code.$background_color1;
		$rgb_Color=argb2rgba($code_c);
	} 
else 
	{
		$rgb_Color=$data['button_background_color'];
		$background_color = $data['button_background_color'];
		$code='';
		$hex='';
	}
?>
   .fix-container {margin: 0 auto;max-width: 1190px;width: 100%;padding: 0;background: <?php echo $data['background_color'];?>;}  
	  .header{background:<?php echo $data['background_color'];?>;text-align: center;}
				
					
<?php
if($_GET['page_type']=='jpg')
	{
?> 
.section-1 { background:url(<?php echo $data['section1'] ['url']?>) no-repeat top center; }  
.contentBox {min-height: 700px;position: relative;}
<?php  
}
else {
?>
.section-1 {background:url(<?php echo $data['background_image']?>) no-repeat top center; }
.contentBox {min-height: 475px;position: relative;}
<?php
}
?>  

.section-3{background:url(<?php echo $data['background_image_two']?>) no-repeat top center;   align-items: center; display:flex;} 
.section-text {padding: 20px;left: 0;position: absolute;text-align: center;top: 50%;transform: translate(0px, -50%);-o-transform: translate(0px, -50%);-moz-transform: translate(0px, -50%);
  -ms-transform: translate(0px, -50%);
  -webkit-transform: translate(0px, -50%);
  width: 100%;
  color:<?php echo $data['text_color'];?>;
}

.contentBox.section-2 {
  background: #1a1a1a none repeat scroll 0 0;
  box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -o-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -moz-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -ms-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -webkit-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
}

.contentBox.section-2.check_in_area {
 background: <?php echo $data['background_color_two']?> none repeat scroll 0 0;
  box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -o-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -moz-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -ms-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -webkit-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
}
.contentBox.section-2.request_checkout {
 background: <?php echo $data['background_color_two']?> none repeat scroll 0 0;
  box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -o-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -moz-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -ms-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -webkit-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
}
.contentBox.section-2.check_in_area .row{
  background: #1a1a1a none repeat scroll 0 0;
  box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -o-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -moz-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -ms-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
  -webkit-box-shadow: 15px 15px 0 <?php echo $data['background_color']?> inset, -15px -15px 0 0 <?php echo $data['background_color']?> inset;
}
.contentBox.section-2.check_in_area p {
  color: #<?php echo $data['text_color']?>;
}

.contentBox.section-2.check_in_area .col-lg-2:before{
  background: <?php echo $data['background_color']?> none repeat scroll 0 0;
}
.contentBox.section-2.request_checkout {
background: <?php echo $data['background_color']?> none repeat scroll 0 0;
}
.contentBox.section-2.request_checkout input[type="submit"]:hover {
  background-color:#1a1a1a;
}
.contentBox.section-2.request_checkout input {
  background: #1a1a1a none repeat scroll 0 0;
}
.section-text h3, .section-text-on-top h1 {font-size: 40px;}
.section-text-on-top {
  color: <?php echo $data['text_color']?>;
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
.section-text-on-top li {padding: 10px 0;}
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
  font-size: 40px;
  margin: 10px 0 0;
}
h1, h2, h3, h4, h5, h6 {
    font-weight: 600;
}

.img-text{
    float: left;
    padding: 17px;
    width:65%;
}
.img-bord{background:#3F264E; padding:15px; box-shadow:3px 3px 3px <?php echo ($rgb_Color !='' ?  "$rgb_Color;": '');?> ; float:right;width:33%;}
.img-bord img{max-width:100%; height:auto;vertical-align:top}

@media (max-width:767px){
	.contentBox {min-height: 275px;}
	.section-text h3, .section-text-on-top h1 {font-size: 20px;}
	.icon_image{height: 55px;width: 50px;}
	.img-text{padding:0px;}
	.section-text-on-top ul{margin:0px;}
	.section-text-on-top li{padding:10px 0 0 0;}
	.img-bord{padding:7px;}
	.section-text-on-top li::before{width:10px; margin-right:5px; background-position:0 4px;}
	.header h1{font-size:20px;}

}
@media (max-width:479px){
	.contentBox {display:block;}
	.section-text-on-top li{font-size:13px;}
	.img-bord{padding:5px;}
	.header h1{font-size:20px;}
}

.pad{
padding:20px;	
}


  </style>
    <link rel="stylesheet" href="css/calender/jquery-ui.css">
    <link rel="stylesheet" href="css/calender/jquery.timepicker.css">
   <script src="js/calender/jquery.timepicker.js"></script>
   <script src="js/calender/jquery-ui.js"></script>
   <script src="js/language/datepicker-<?php echo (isset($_GET['lang']) && $_GET['lang'] != ''  ? $_GET['lang'] : 'en'); ?>.js"></script>
    </head>
    <?php
if(!empty($data)  && isset($data['page'])){
	$_SESSION['page_name']=$data['page_name'];
	?>
	<body>
        <main class="wrapper">
                  <?php 
                  if(isset($data['section2']) || isset($data['section1'])){
                  ?> 
              <div class="fix-container">
                <header class="header">
					<a href="index.php?id=<?php echo $listing_id; ?>"><img src="images/left-arrow.png" style="float: left;" class="icon_image"></a>
					<i class="<?php echo (isset($_SESSION['page'.$page_id]) ? $_SESSION['page'.$page_id] : '');?> icon_image"></i>
					  <?php
		  if($_GET['page_type']=='jpg'){
			?>
			<h1><?php echo (isset($data['section1']) ? strtoupper($data['section1']['text']) : '');?></h1>         
		
			<?php  
		  }
		  else {
		  ?>
		  
		 <h1><?php echo (isset($data['section1']) ? strtoupper($data['section1']['text']) : '');?></h1>         
			 <?php
		 }
			 ?>           
                </header>
                <!-- header end -->
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
               <!-- <div class="contentBox section-2">
					<div class="section-text">
						 <h3 class='pad'><?php echo (isset($data['section3']) ? strtoupper($data['section3']['text']) : '');?></h3>
						 <h3 class='pad'><?php echo (isset($data['section4']) ? strtoupper($data['section4']['text']) : '');?></h3>
				    </div>
                </div> -->
                <?php
			      }
                ?>
                 <?php 
                 if($_GET['page_type'] !='checkin'){ 
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
								
								 <?php echo (isset($data['section6']) ? '<li>'.$data['section6']['text'].'</li>' : '');?>
								 <?php echo (isset($data['section7']) ? '<li>'.$data['section7']['text'].'</li>' : '');?>
							</ul>
							</div>
							<div class='img-bord'>
							<img src='images/cable-img.jpg'>
							</div>
						 </div>
					 </div>
                </div>
                <?php
			   }
		   }
		   else if($_GET['page_type'] =='checkin' && $data['allow_request_later_date']==1)
		   {
			    ?>
                  <?php 
                  if(isset($data['section3']) || isset($data['section4'])){				
                  ?>  
                <div class="contentBox section-2 test check_in_area">
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><i class="checkin-new"></i></div>
						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							<h3 class='pad'><?php echo (isset($data['section3']) ? strtoupper($data['section3']['text']) : '');?></h3>
							 <p><?php echo date('l, F Y'); ?></p>
							<p><?php echo date('h:i A'); ?></p>
						 </div>
					</div>
					<div class="row">
						 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><i class="checkout-new"></i></div>
						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
						    <h3 class='pad'><?php echo (isset($data['section4']) ? strtoupper($data['section4']['text']) : '');?></h3>
						    <p><?php echo date('l, F Y'); ?></p>
							<p><?php echo date('h:i A'); ?></p>
						</div>
				    </div>
                </div>
                <?php
			      }
                ?>
			   <?php
			  if(isset($data['section5']) || isset($data['section6']) || isset($data['section7'])){			 
                  ?>  
                   <div class="contentBox section-2 request_checkout">
					<!--<div class="overlay-div"> -->
						<div class="section-text-on-top">
							 <form action='#' method='post' class='message_admin'>
					      <h1><?php echo (isset($data['section5']) ? ucfirst($data['section5']['text']) : '');?></h1>
					  		<input type="text" id="datepicker" value='Select Date'/>
					  		<input type="text" class="timepicker" value='Select Time' />
					  		<input type='submit' value='Request'>
							</form>
							
						 </div>
					 <!--</div>-->
                </div>
             
                 <!-- Modal -->
				  <div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
					
					  <!-- Modal content-->
					  <div class="modal-content">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h4 class="modal-title">Message</h4>
						</div>
						<div class="modal-body">
						  <p class='res_message'>Later date requested.</p>
						</div>
						<div class="modal-footer">
						  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					  </div>
					  
					</div>
				  </div>
                <?php
			   } 
			   
		   }
                ?>
                <!-- contentBox end -->
                <footer class="footer ">
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
								$link='?id='.$_GET['id'].'&page_type='.$_GET['page_type'].'&page_id='.$_GET['page_id'].'&lang=';
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
                </script>
            </div><!-- container end here -->
        </main>
    </body>
	<?php	
}
else if(!empty($data_video)){ 
	?>
	<body>
	<main class="wrapper">
		    <div class="fix-container">
                <header class="header">
					<a href="index.php?id=<?php echo $listing_id; ?>"><img src="images/left-arrow.png" style="float: left;" class="icon_image"></a>
					<i class="<?php echo (isset($data_video['icon_pic']) ? $data_video['icon_pic'] : '');?> icon_image"></i>
					<h1><?php echo (isset($data_video['name']) ? strtoupper($data_video['name']) : '');?></h1>
                </header>
                  <div  style="text-align: center;">
					  <video width='60%' height='80%' autoplay>
						<!--<source src="mov_bbb.mp4"> -->
						<source src="<?php echo $data_video['video'];?>"> 
						Your browser does not support HTML5 video.
					  </video>
					
					</div>
			</div>
                
	</main>
	</body>
	<?php
}
else {
	echo "No page found";
}
?>
<script>


 $(function(){
      //  $("#datepicker").datepicker({ dateFormat: 'dd MM'});
        $('#datepicker').datepicker({
    dateFormat: "dd MM",
    beforeShow: function(){ 
        $(".ui-datepicker").css('font-size', 21)
    }
});
        
        $('.timepicker').timepicker();
      
    });

 
/*
 $('#datepicker').datepicker( {
        changeMonth: true,
        changeDay: true,
        showButtonPanel: false,
        dateFormat: 'mm-dd',
        onClose: function(dateText, inst) { 
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
    });
    */
   $(document).ready(function(){
    $(".message_admin").submit(function(event) {
        event.preventDefault();
        var room_id='<?php echo $listing_id;?>';
        var name='<?php echo $data['guest_first_name'].' '.$data['guest_last_name'] ;?>';
        var date = $('#datepicker').datepicker({ dateFormat: 'dd-MM-yy' }).val();
        var time = $('.timepicker').val();
        
        if(date =='Select Date' && time=='Select Time'){
			  $('.res_message').text('Please Select date and time'); 
					  $('#myModal').modal('show');
			return false;
		}
        $.ajax({
            type: "POST",
            url: "message.php",
            data: "room_id=" + room_id + "&date=" + date + "&time=" + time + "&name=" + name,  
            success: function(res){
				var obj = jQuery.parseJSON( res );
				if(obj.error_code=='success'){
					    $('.res_message').text('new date has been requested - your host will be back with you soon'); 
					  $('#myModal').modal('show');
				}
				else {
					$('.res_message').text('There some issue, Please contact admin'); 
					  $('#myModal').modal('show');
				}
				     
				},
				error: function(jq,status,message) {
					$('.res_message').text('There some issue, Please contact admin'); 
					  $('#myModal').modal('show');
			}
          });
     });
}); 
</script>
</html>
