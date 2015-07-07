<html>
<head>
	<title>Ajax Notes</title>
    <meta name="description" content="Portfolio project for Paul Chang, front end engineer. Notes created and modified using AJAX! Add a title and description and click the 'add-note' button to add. To update the description, simply click inside the note textbox, update the text, then click outside the textbox. The note will automatically update! Uses MySQL Database.">
	<meta name="viewport" content="width=device-width,initial-scale=1">
</head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/ajax_notes.css">
	
	<script type="text/javascript">

	$(document).ready(function() {
		$('.modal').modal('show');

		// on page load uses ajax to get all data
		$.get('/notes/index_html', function(res) {
			$('#ajax-notes').html(res);
		})
	})

	//handles the delete and add notes
	$(document).on('submit', 'form', function() {
		$.ajax({
			url: $(this).attr('action'),
			type: 'post',
			data: $(this).serialize()
		}).done(function(res) {
			$('#ajax-notes').empty().html(res);
			$('.add_note, .add_description').val("");
		})
		return false;
	})

	$(document).on('change', '.text_note', function() {
		$(this).parent().submit();
	})
	</script>

<body>
	<div class='container'>
		<div class="row">
			<div class="col-xs-12">
				<div class='margin'>
					<h2>Add Notes</h2>
					<form action='/notes/create' method='post'>
						<h4>Title</h4>
						<input class='add_note' name='title' type='text'>
						<h4>Description</h4>
						<textarea name="description" class="add_description"></textarea>
	<!-- 					<input class='add-note' name='description' type='text'> -->
						<input type='submit' class="btn btn-primary btn-sm add_btn" value='add notes'>
					</form>
				</div>
			</div>
		</div>
		<div class="row">
		<!-- Ajax calls adds html inside div -->			
			<div class="col-xs-12" id="ajax-notes">
			</div>
		</div>

	</div>

		<!-- Modal -->
	<div class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Ajax Notes</h4>
				</div>
				<div class="modal-body">
					<p>Notes created and modified using AJAX! Add a title and description and click the 'add-note' button to add. To update the description, simply click inside the note textbox, update the text, then click outside the textbox. The note will automatically update! Uses MySQL Database.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</body>
</html>