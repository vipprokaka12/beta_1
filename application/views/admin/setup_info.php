<script type="text/javascript" src="<?php echo base_url() ?>public/include/tinymce/tinymce.min.js"></script>
 <script type="text/javascript">
        tinymce.init({
            selector: "#mytextarea",
            plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste imagetools responsivefilemanager"
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | responsivefilemanager ",
			external_filemanager_path:"<?php echo  base_url() ?>filemanager/",
            filemanager_title:"Responsive Filemanager" ,
            external_plugins: { "filemanager" : "<?php echo  base_url() ?>filemanager/plugin.min.js"}

        });
    </script>
 <form method="post">
        <textarea id="mytextarea"></textarea>
    </form>