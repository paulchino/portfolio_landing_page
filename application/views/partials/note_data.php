<?php 
		foreach ($all_notes as $notes) {
?>	
		<div class='notes'>
			<h4 class='inline'> <?= $notes['title'] ?></h4>
			<form class='delete-note' action='/main/delete' method='post'>
				<input type='hidden' name='id' value='<?=$notes['id'] ?>'>
				<input type='submit' value='delete' />
			</form>
			<hr>
			<div class='notes-container'>
				<form action='main/update' method='post'>
					<input type='hidden' name='id' value='<?=$notes['id'] ?>'>
					<textarea class='note-box' name='description'> <?= $notes['description'] ?></textarea>
				</form>
			</div>
		</div>
<?php 
		}
 ?>