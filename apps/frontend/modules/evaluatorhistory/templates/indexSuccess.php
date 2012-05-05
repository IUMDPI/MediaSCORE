

<table>
  <thead>
    <tr>
      <th>Action</th>
      <th>Date</th>
      <th>Person</th>
	<th>In Consultation With</th>
	<th />
    </tr>
  </thead>
  <tbody>
    <?php foreach ($evaluator_historys as $evaluator_history): ?>
    <tr>
      <td><?php echo EvaluatorHistory::$actions[$evaluator_history->getType()] ?></td>
      <td><?php echo $evaluator_history->getCreatedAt() ?></td>
      <td><!--05/05/12: Not yet fully debugged.-->Administrator
<?php
/*if($evaluators[$evaluator_history->getEvaluatorId()]) {
	$evaluator=$evaluators[$evaluator_history->getEvaluatorId()];
	if($evaluator)
		echo $evaluator->getFirstName() . ' ' . $evaluator->getLastName();
}*/
?>
</td>
	<td>
<?php /*foreach($consultedPersons as $consultedPerson):*/ ?>
<?php
	if(isset($consultedPersons[$evaluator_history->getId()])):
		foreach($consultedPersons[$evaluator_history->getId()] as $consultedPerson):
?>
<span><?php echo $consultedPerson->getFirstName() ?>&nbsp;<?php echo $consultedPerson->getLastName() ?></span>
<?php endforeach ?>
<?php endif ?>
<?php /*endforeach*/ ?>
</td>
	<!--<td><a id="evaluator-history-edit" href="evaluatorhistory/edit" target="
">edit</a>&nbsp&nbsp<a href="evaluatorhistory/delete" target="
">delete</a></td>-->
	<!--<td><a id="evaluator-history-edit" href="#" target="
">edit</a>&nbsp&nbsp<a href="#" target="
">delete</a></td>-->
	<td><span><a href="#" class="evaluator-history-edit" id="<?php echo $evaluator_history->getId()?>">edit</a></span>&nbsp;/&nbsp;<span><a href="#" class="evaluator-history-delete" id="<?php echo $evaluator_history->getId()?>">delete</a></span></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div id="evaluator-history-edit-container"></div>

<input id="evaluator-history-new" type="submit" value="+ ADD NEW" />
