<table>
  <thead>
    <tr>
      <th>Action</th>
      <th>Date</th>
      <th>Person</th>
	<th />
    </tr>
  </thead>
  <tbody>
    <?php foreach ($evaluator_historys as $evaluator_history): ?>
    <tr>
      <td><?php echo $evaluator_history->getType() ?></td>
      <td><?php echo $evaluator_history->getCreatedAt() ?></td>
      <td><?php echo $evaluator_history->getEvaluatorId() ?></td>
	<!--<td><a id="evaluator-history-edit" href="evaluatorhistory/edit" target="
">edit</a>&nbsp&nbsp<a href="evaluatorhistory/delete" target="
">delete</a></td>-->
	<!--<td><a id="evaluator-history-edit" href="#" target="
">edit</a>&nbsp&nbsp<a href="#" target="
">delete</a></td>-->
	<td><span class="evaluator-history-edit" id="<?php echo $evaluator_history->getId()?>">edit</span>&nbsp;/&nbsp;<span class="evaluator-history-delete" id="<?php echo $evaluator_history->getId()?>">delete</span></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div id="evaluator-history-edit-container"></div>

<input id="evaluator-history-new" type="submit" value="+ ADD NEW" />
