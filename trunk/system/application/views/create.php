<?php echo error(validation_errors()); ?>
<?php echo form_open('account/create'); ?>
	<label for="name">Account Name</label><input type="text" value="<?php echo set_value('name'); ?>" name="name"/><br>
	<label for="name">E-mail</label><input  type="text" value="<?php echo set_value('email'); ?>" name="email"/><br>
	<label for="name">Password</label><input type="password" name="password"/><br>
	<label for="name">Repeat</label><input type="password" name="repeat"/><br>
	<input class='sub' type="submit" value="Register"/>
</form>