<script type='text/javascript'>
	
	// Return a helper with preserved width of cells
	var fixHelper = function(e, ui) {
	    ui.children().each(function() {
	        $(this).width($(this).width());
	    });
	    return ui;
	};
	
	$(document).ready(function() {
		
		var $container = $(".roland_table tbody").roland();
		var opts = $.extend({}, $.fn.roland.defaults);
		
		$(".roland_table tbody").sortable({
			helper: fixHelper, // fix widths
			handle: '.roland_drag_handle',
			cursor: 'move',
			update: function(event, ui) { 
				$.fn.roland.updateIndexes($container, opts); 
			}
		});

	});
</script>

<?php
	
	echo form_open($_form_base_url);
	
	$this->table->set_template($roland_template);
	
	$this->table->set_heading(
			array('data' => '', 'style' => 'width: 10px;'),
			array('data' => 'Hat on dildo?', 'style' => 'width: 100px;'),
			'Templates',
			'Users',
			array('data' => '', 'style' => 'width: 47px;')
		);
	
	if($templates)
	{
		$i = 0;
		foreach($templates as $template)
		{
			$this->table->add_row(
				array('data' => $drag_handle, 'class' => 'roland_drag_handle'),
				form_checkbox("hat_on[$i]", 1, (isset($hat_on[$i])) ? $hat_on[$i] : 0) . ' Yes sir',
				form_input("templates[$i]", $templates[$i]),
				form_input("users[$i]", $users[$i]),
				array('data' => $nav, 'class' => 'roland_nav')
			);
			$i++;		
		}
	}
	else
	{
		$this->table->add_row(
			array('data' => $drag_handle, 'class' => 'roland_drag_handle'),
			form_checkbox('hat_on[0]', 1, 0).' Yes sir',
			form_input('templates[0]', ''),
			form_input('users[0]', ''),
			array('data' => $nav, 'class' => 'roland_nav')
		);
	}
	
	echo $this->table->generate();
	
	echo form_submit('submit', 'Submit', 'class="submit"');
	
	echo form_close();
	
	// output raw post data
	if($_POST){echo "<pre>"; print_r($_POST); echo "</pre>";};
	
?>