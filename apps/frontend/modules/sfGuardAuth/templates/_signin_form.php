
<div id="log-in" class="clearfix">
	<h3>Log In</h3>
	<form class="clearfix" action="<?php echo url_for('sfGuardAuth/signin') ?>" method="post">
	<table>
	<tbody>
		<?php echo $form ?>
	</tbody>
	<tfoot>
		<tr class="row">
			<td class="right-column small"><a href="#">Forgot password?</a></td>
		</tr>
	<tr class="row">
		<td class="right-column"><input type="submit" value="Log In" class="button" /></td>
	</tr>
	</tfoot>
	</table>
	</form>
</div>

