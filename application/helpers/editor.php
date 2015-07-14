<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('editor'))
{
    function editor($id='content',$config=null)
    {
		
		if($config!=null)$config=','.$config;
		$output='<script type="text/javascript">
		tinymce.init({
			selector: "'.$id.'",
			theme: "modern",
			plugins: [
				"advlist autolink lists link image charmap print preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars code fullscreen",
				"insertdatetime media nonbreaking save table contextmenu directionality",
				"emoticons template paste textcolor colorpicker textpattern imagetools"
				'.$config.'
			],
			toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			toolbar2: "print preview media | forecolor backcolor emoticons",
			image_advtab: true,
			templates: [
				{title: "Test template 1", content: "Test 1"},
				{title: "Test template 2", content: "Test 2"}
			]
		});
		</script>';
        return $output;
    }   
}