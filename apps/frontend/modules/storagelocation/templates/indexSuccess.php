

<!-- 05/05/12: include_javascripts() did not produce this in response to AJAX requests
<script type="text/javascript" src="/symfony/mediascore1.0a/js/jquery_evaluator_history_index.js"></script>
-->

<?php echo include_javascripts() ?>

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

<?php echo get_slot('settingsMenu') ?>
    <a class="button" href="<?php echo url_for('storagelocation/new') ?>">Create Storage Location</a>

    <table>
    <?php if (sizeof($storage_locations) > 0) { ?>
            <thead>
                <tr>
                    <th>Storage Location</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($storage_locations as $storage_location): ?>
                    <tr>
                        <td><?php echo $storage_location->getName() ?></td>

                        <td class="invisible">
                            <div class="options">
                                <a href="<?php echo url_for('storagelocation/edit?id=' . $storage_location->getId()) ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
                                <a href="#fancybox1" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" /></a>
                            </div>
                        </td>
                    </tr>
    <?php endforeach; ?>
            </tbody>
<?php
} else {
    echo '<tr><td>No Storage Location.</td></tr>';
}
?>
    </table>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
       
  $(".delete_unit").fancybox({
           'width': '100%',
           'height': '100%',
           'autoScale': false,
           'transitionIn': 'none',
           'transitionOut': 'none',
           'type': 'inline',
           'padding': 0,
           'showCloseButton':false
          
       });
    });
    
</script>
<?php if (sizeof($storage_locations) > 0) { ?>

<div style="display: none;"> 
    <div id="fancybox1" style="background-color: #F4F4F4;width: 600px;" >
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
        <div style="margin: 10px;"><a class="button" href="javascript://" onclick="$.fancybox.close();">NO</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo url_for('storagelocation/delete?id=' . $storage_location->getId()) ?>">YES</a></div>
    </div>
</div>
<?php } ?>