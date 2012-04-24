<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $evaluator_history->getId() ?></td>
    </tr>
    <tr>
      <th>Type:</th>
      <td><?php echo $evaluator_history->getType() ?></td>
    </tr>
    <tr>
      <th>Evaluator:</th>
      <td><?php echo $evaluator_history->getEvaluatorId() ?></td>
    </tr>
    <tr>
      <th>Asset group:</th>
      <td><?php echo $evaluator_history->getAssetGroupId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $evaluator_history->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $evaluator_history->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('evaluatorhistory/edit?id='.$evaluator_history->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('evaluatorhistory/index') ?>">List</a>
