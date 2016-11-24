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

        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <?php
$listing_id=(isset($_GET['id']) && $_GET['id'] != ''  ? $_GET['id'] : 1);
$url='http://159.203.92.158:8181/api/listings/'.$listing_id.'?key=4daa6722ac1da9c6c425e618c9eb3f3f';
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);
$page_content = json_decode($result);
foreach($page_content as $page){
	echo "<pre>";print_r($page);echo"</pre>";
	$default_language=(isset($_GET['lang']) && $_GET['lang'] != ''  ? $_GET['lang'] : $page->default_language);
	if($page->id==$listing_id){
	$name=(isset($page->name) && $page->name != ''  ? $page->name : '');
	$owner_image=(isset($page->owner_image) && $page->owner_image != ''  ? $page->owner_image : '');
	$background_image=(isset($page->background_image) && $page->background_image != ''  ? $page->background_image : '');
	$background_image_two=(isset($page->background_image_two) && $page->background_image_two != ''  ? $page->background_image_two : $background_image);
	$background_color=(isset($page->background_color) && $page->background_color != ''  ? $page->background_color : '');
	$background_color_two=(isset($page->background_color_two) && $page->background_color_two != ''  ? $page->background_color_two : $background_color);
	$button_background_color=(isset($page->button_background_color) && $page->button_background_color != ''  ? $page->button_background_color : '');
    $data['name']=$name;
    $data['owner_image']=$owner_image;
    $data['background_image']=$background_image;
    $data['background_image_two']=$background_image_two;
    $data['background_color']=$background_color;
    $data['background_color_two']=$background_color;
    $data['button_background_color']=$button_background_color;
		
if(!empty($page->languages))
	{
	foreach($page->languages as $language)
		{
			$lang[]=$language->language;
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
										 $button['type']=($buttons->type != '' && isset($buttons->text) ? $buttons->type : '');
										 $button['language']=($buttons->language != '' && isset($buttons->language) ? $buttons->language : '');
										 $button['page_id']=($buttons->page_id != '' && isset($buttons->page_id) ? $buttons->page_id : '');
										 $data_button[]=$button;
									}
							} 
			}
		}
		 $data['btn']=$data_button;
		 $data['lang']=$lang;
	} 
}
}

if(!empty($data)){
	echo "<pre>";print_r($data);echo"</pre>";
	?>
	
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


</html>

