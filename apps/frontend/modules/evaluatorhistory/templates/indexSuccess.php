

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Person</th>
            <th>In Consultation With</th>
            <th />
        </tr>
    </thead>
    <tbody>
        <?php foreach ($evaluator_historys as $evaluator_history): ?>
            <tr>
                <td><?php echo $evaluator_history->getUpdatedAt() ?></td>
                <td><!--05/05/12: Not yet fully debugged.--><?php $evaluator_history->getEvaluator()->getName() ?>
                    <?php
                    if ($evaluators[$evaluator_history->getEvaluatorId()]) {
                        $evaluator = $evaluators[$evaluator_history->getEvaluatorId()];
                        if ($evaluator)
                            echo $evaluator->getFirstName() . ' ' . $evaluator->getLastName();
                    }
                    ?>
                </td>
                <td>
                    <?php /* foreach($consultedPersons as $consultedPerson): */ ?>
                    <?php
                    if (isset($consultedPersons[$evaluator_history->getId()])):
                        foreach ($consultedPersons[$evaluator_history->getId()] as $consultedPerson):
                            ?>
                            <span><?php echo $consultedPerson->getFirstName() ?>&nbsp;<?php echo $consultedPerson->getLastName() ?></span>
                        <?php endforeach ?>
                    <?php endif ?>
                    <?php /* endforeach */ ?>
                </td>
                
                <td class="invisible">
                        <div class="options">
                            <a href="javascript:void(0);" class="evaluator-history-edit" id="<?php echo $evaluator_history->getId() ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
                            <a href="javascript:void(0);" class="evaluator-history-delete" id="<?php echo $evaluator_history->getId() ?>"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" /></a>
                        </div>
                    </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div id="evaluator-history-edit-container"></div>

<input id="evaluator-history-new" type="submit" value="+ ADD NEW" />
