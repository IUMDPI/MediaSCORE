
<a class="button" href="<?php echo url_for('unit/new') ?>">Create Unit</a>
<div id="search-box">
    <form>
        <div class="search-input">
<!--            <div class="token">Token One<span> <a href="#">X</a></span></div>
          <div class="token">Token One<span> <a href="#">X</a></span></div>-->
            <input type="search" placeholder="Search all records"/>
            <div class="container">
                <a class="search-triangle" href="#"></a>
                <!--              <a class="search-close" href="#"></a>-->
            </div>
            <input class="button" type="submit" value="" />
            <!--            <div class="dropdown-container">
                          <div class="dropdown clearfix Xhidden">  toggle class "hidden" to show/hide 
                            <ul class="left-column">
                              <li><h1>Format</h1></li>
                              <li><a href="#">Format One</a></li>
                              <li><a href="#">Format Two</a></li>
                              <li><a href="#">Format Three</a></li>
                              <li><a href="#">Format Four</a></li>
                            </ul>
                            <ul class="right-column">
                              <li><h1>Type</h1></li>
                              <li><a href="#">Unit</a></li>
                              <li><a href="#">Collection</a></li>
                              <li><a href="#">Asset Group</a></li>
                            </ul>
                          </div>
                        </div>-->
        </div>
    </form>
</div>
<table>
  <thead>
    <tr>
      <th>Unit</th>
      <th>Created</th>
      <th>Created By</th>
      <th>Updated On</th>
      <th>Updated By</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($units as $unit): ?>
    <tr>
      <td><a href="<?php echo url_for('collection/index?u='.$unit->getId()) ?>"><?php echo $unit->getName() ?></a></td>
      <td><?php echo $unit->getCreatedAt() ?></td>
      <td>
<?php

//print_r( Doctrine_Core::getTable('User')->find( $unit->getCreatorId() )->getFirstName() );
echo $unit->getCreator()->getName();

/*$evaluatorName = $creators[$unit->getId()];
if($evaluatorName == ' ')
	echo 'Administrator';
else
	echo $evaluatorName;*/
?>
</td>
      <td><?php echo $unit->getUpdatedAt() ?></td>
      <td>
<?php
echo $unit->getEditor()->getName();
/*$lastEditorName = $editors[$unit->getId()];
if($lastEditorName == ' ')
	echo 'Administrator';
else
	echo $lastEditorName;*/
?>
</td>

<td class="invisible">
	<div class="options">
	<a href="<?php echo url_for('unit/edit?id='.$unit->getId()) ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
	<a href="<?php echo url_for('unit/delete?id='.$unit->getId()) ?>"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" /></a>
	</div>
</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
