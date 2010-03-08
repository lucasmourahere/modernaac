<?php echo error(validation_errors()); ?>
<?php echo form_open('account/login'); ?>
	<label for="name">Account Name</label><input type="password" value="<?php echo set_value('name'); ?>" name="name"/><br>
	<label for="name">Password</label><input  type="password"" value="<?php echo set_value('pass'); ?>" name="pass"/><br>
	<input class='sub' type="submit" value="Login"/>
</form>