<?php 
		foreach ($all_notes as $notes) {
?>	
			<div class="color_box">
				<div class="title_div">
					<h4 class="title"><?= $notes['title'] ?></h4>
					<form class='delete-note' action='/notes/delete' method='post'>
						<input type='hidden' name='id' value='<?=$notes['id'] ?>'>
						<input type='submit' class="btn btn-danger btn-sm pull-right del_btn" value='Delete' />
					</form>
				</div>
				<div class="notes">
					<form action="/notes/update" method="post">
						<input type='hidden' name='id' value='<?=$notes['id'] ?>'>
						<textarea class="text_note" name="description"> <?= $notes['description'] ?> </textarea>
					</form>
				</div>
			</div>
<?php 
		}
 ?>