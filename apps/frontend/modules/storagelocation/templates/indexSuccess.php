

<?php
/*
  For the following modules:
  storagelocation
  sfGuardUser
  person
 */
slot('settingsMenu', sprintf('<ul id="settings-navigation">
			<li class=""><a class="menu-link" href="%s">Users</a></li>
			<li class=""><a class="menu-link" href="%s">Unit Personnel</a></li>
			<li class=""><a class="menu-link" href="%s">Storage Locations</a></li>
			<li class="">%s</li></ul>', url_for('sfGuardUser/index'), url_for('person/index'), url_for('storagelocation/index'), link_to2('Edit Profile', 'sf_guard_user_edit', $sf_user->getGuardUser(), array('class' => 'menu-link'))))
?>

<div id="settings-container">

	<?php
	if ($sf_user->getGuardUser()->getType() != 3)
	{
		?>
		<a class="button" href="<?php echo url_for('storagelocation/new') ?>">Create Storage Location</a>
	<?php } ?>
    <table>
		<?php
		if (sizeof($storage_locations) > 0)
		{
			?>
			<thead>
				<tr>
					<?php
					if ($sf_user->getGuardUser()->getType() != 3)
					{
						?>
						<th width="50"></th>
					<?php } ?>
					<th>Storage Location</th>
					<th>Building/Room Number</th>
					<th>Environmental Rating</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($storage_locations as $storage_location): ?>
					<tr>

						<?php
						if ($sf_user->getGuardUser()->getType() != 3)
						{
							?>
							<td class="invisible">
								<div class="options">
									<a href="<?php echo url_for('storagelocation/edit?id=' . $storage_location->getId()) ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
									<a href="#fancyboxStorage" class="delete_storage"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getStorageId(<?php echo $storage_location->getId(); ?>);" /></a>
								</div>
							</td>
						<?php } ?>
						<td><?php echo $storage_location->getName(); ?></td>
						<td><?php echo $storage_location->getResidentStructureDescription(); ?></td>
						<td><?php
							if ($storage_location->getEnvRating() != 0)
								echo StorageLocation::$constants[$storage_location->getEnvRating()];
							?>
						</td>
					</tr>
			<?php endforeach; ?>
			</tbody>
			<?php
		}
		else
		{
			echo '<tr><td>No Storage Location.</td></tr>';
		}
		?>
    </table>
</div>
</div>
<script type="text/javascript">
							$(document).ready(function() {


								$(".delete_storage").fancybox({
									'width': '100%',
									'height': '100%',
									'autoScale': false,
									'transitionIn': 'none',
									'transitionOut': 'none',
									'type': 'inline',
									'padding': 0,
									'showCloseButton': false

								});
							});
							var storageID = null;
							function getStorageId(id) {
								storageID = id;
							}
							function deleteStorage() {
								window.location.href = '/storagelocation/delete?id=' + storageID;
							}
</script>
<?php
if (sizeof($storage_locations) > 0)
{
	?>

	<div style="display: none;"> 
		<div id="fancyboxStorage" style="background-color: #F4F4F4;width: 600px;" >
			<header>
				<h5  class="fancybox-heading">Warning!</h5>
			</header>
			<div style="margin: 10px;">
				<h3>Careful!</h3>
			</div>
			<div style="margin: 10px;font-size: 0.8em;">
				You are about to delete a Storage Location which will permanently erase all information associated with it.<br/>
				Are you sure you want to proceed?
			</div>
			<div style="margin: 10px;"><a class="button" href="javascript://" onclick="$.fancybox.close();">NO</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="deleteStorage();">YES</a></div>
		</div>
	</div>
<?php } ?>