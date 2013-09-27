<a class="button" href="<?php echo url_for('user/new') ?>">Create User</a>
<?php
if ( ! (isset($popup)))
	$popup = 0;
?>
<?php if ($popup == 1)
{ ?>
	<div style="display: none;"> 
		<a id="newUserPopup" href="#newUser"></a>
		<div id="newUser" style="background-color: #F4F4F4;width: 600px;" >
			<header>
				<h5  class="fancybox-heading">User Created</h5>
			</header>

			<div style="margin: 10px;font-size: 0.8em;">
				An email has been sent to this user with a link to activate their account.
			</div>
			<div style="margin: 10px;"><a href="javascript://" onclick="hideNewUserBox();">Close window</a></div>
		</div>
	</div>
<?php }
?>
<table id="userTable" class="tablesorter">
    <thead>
        <tr>
            <td></td>
            <th>First Name</th>
            <th>Last name</th>
            <th>Role</th>
			<th>Email</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($users as $user): ?>
			<tr>
				<td class="invisible" width="50">
					<div class="options">
						<a href="<?php echo url_for('user/edit?id=' . $user->getId()) ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
						<a href="#fancyboxUser" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getUserID(<?php echo $user->getId(); ?>)"/></a>
					</div>
				</td>
				<td><?php echo $user->getFirstName(); ?></td>
				<td><?php echo $user->getLastName(); ?></td>
				<td><?php echo sfGuardUserForm::$role[$user->getRole()]; ?></td>
				<td><?php echo $user->getEmailAddress(); ?></td>
			</tr>

<?php endforeach; ?>
    </tbody>
</table>


<?php if (sizeof($users) > 0)
{ ?>
	<div style="display: none;"> 
		<div id="fancyboxUser" style="background-color: #F4F4F4;width: 600px;" >
			<header>
				<h5  class="fancybox-heading">Warning!</h5>
			</header>
			<div style="margin: 10px;">
				<h3>Careful!</h3>
			</div>
			<div style="margin: 10px;font-size: 0.8em;">
				You are about to delete a User which will permanently erase all information associated with it.<br/>
				Are you sure you want to proceed?
			</div>
			<div style="margin: 10px;"><a class="button" href="javascript://" onclick="$.fancybox.close();">NO</a>&nbsp;&nbsp;&nbsp;<a  href="javascript:void(0);" onclick="deleteUser();">YES</a></div>
		</div>
	</div>
<?php } ?>
<script type="text/javascript">
				$(document).ready(function() {
					$("#userTable").tablesorter();

					$(".delete_unit").fancybox({
						'width': '100%',
						'height': '100%',
						'autoScale': false,
						'transitionIn': 'none',
						'transitionOut': 'none',
						'type': 'inline',
						'padding': 0,
						'showCloseButton': false

					});
					$("#newUserPopup").fancybox({
						'width': '100%',
						'height': '100%',
						'autoScale': false,
						'transitionIn': 'none',
						'transitionOut': 'none',
						'type': 'inline',
						'padding': 0,
						'showCloseButton': false

					});
					popup = '<?php echo $popup; ?>';
					if (popup == 1) {
						$('#newUserPopup').trigger('click');
					}

				});
				var userId = null;
				function getUserID(id) {
					userId = id;

				}
				function deleteUser() {
					window.location.href = '/user/delete?id=' + userId;
				}
				function hideNewUserBox() {
					if (location.href.match(/\?.*/)) {
						location.href = location.href.replace(/\?.*/, '');
					}
					$.fancybox.close();

				}

</script>