<?php 
echo error(validation_errors());
echo form_open('character/create_character'); 
?>
<label>Character name</label><input type='text' value="<?php echo set_value('name'); ?>" name='name'><br><br>
<label>City</label><select name='city'>
<?php 
	foreach($cities as $key=>$value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
?>
</select><br><br>
<label>Sex</label><select name='sex'>
	<option value="1">Male</option>';
	<option value="0">Female</option>';
</select><br><br>
<label>Vocation</label><select name='vocation'>
<?php 
	foreach($vocations as $key=>$value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
?>
</select><br><br>
<label>World</label><select name='world'>
<?php 
	foreach($worlds as $key=>$value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
?>
</select><br>
<input type='submit' value='Create' name='submit' class='sub'/>
</form>