<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<style>
    textarea{
        min-height: 50px !important;
    }
    #collection_collection_score{
        width:27px !important;
    }
    #collection_parent_node_id{
        /*        height: 130px;
                overflow-x: hidden;
                overflow-y: scroll;
                width: auto;*/
    }
</style>
<div style="background-color: #F4F4F4;padding-left: 10px;padding-right: 5px;" id="collectionMain">
    <div id="main" class="clearfix" style="height: auto;">
        <form id="collection_form" action="<?php echo url_for('collection/' . ($form->getObject()->isNew() ? 'create' : 'update') . ( ! $form->getObject()->isNew() ? '/id/' . $form->getObject()->getId() . '/u/' . $unit . '/form/river' : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
			<?php if ( ! $form->getObject()->isNew()): ?>
				<input type="hidden" name="sf_method" value="put" />
			<?php endif; ?>
            <table class="custom_normal_form" cellpadding='0' cellspacing="0" width="100%">
                <tfoot>
                    <tr>
                        <td colspan="2"> 
                            <br/>
                            <input type="submit" value="Save" />
                            &nbsp;or&nbsp;<a href="<?php echo ($cancelUrl) ? $cancelUrl : '/'; ?>" onclick="$.fancybox.close();" >cancel</a>
                        </td>
                    </tr> 
                </tfoot>
                <tbody>
					<?php
					if (isset($actionType) && $actionType == 'edit')
					{
						?>
						<tr>
							<th style="width: 13%;">
								<?php echo $form['parent_node_id']->renderLabel(); ?>
							</th>
							<td>
								<?php echo $form['parent_node_id']->render(array('title' => 'Collection\'s parent Unit ')); ?> 
								<?php echo $form['parent_node_id']->renderError(); ?>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<br/>
							</td>
						</tr>
					<?php } ?>
                    <tr>


                        <td colspan="2">
							<div class="left-column-container">
								<div class="row clearfix">
									<div class="left-column" style="width: 125px;"><b>  <?php echo $form['inst_id']->renderLabel(); ?></b></div>
									<div class="right-column">
										<div><?php echo $form['inst_id']->render(array('title' => 'The main ID used by the organization.')); ?> 
											<?php echo $form['inst_id']->renderError(); ?></div>
									</div>
								</div>
							</div>
							<div class="right-column-container">
								<div class="row">
									<div class="left-column" style="width: 55px;"><b><?php echo $form['name']->renderLabel(); ?></b></div>
									<?php echo $form['name']->render(array('collection_name' => 'Name of the Collection.')); ?> 
									<?php echo $form['name']->renderError(); ?>
								</div>
							</div>




                        </td>
                    </tr>

                    <tr>
                        <th>
							<?php echo $form['characteristics']->renderLabel(); ?>
                        </th>
                        <td >
							<?php echo $form['characteristics']->render(array('characteristics' => 'Characteristics.')); ?> 
							<?php echo $form['characteristics']->renderError(); ?>
                        </td>
                    </tr>

                    <tr >
                        <th>  <div style="font-weight: bold;">
					<?php echo $form['project_title']->renderLabel(); ?></div>
                </th>
                <td colspan="2">
                    <div style="float: left;padding-right:30px;">

                        <div style="float: left;">
							<?php echo $form['project_title']->render(array('project_title' => 'Project Title.')); ?> 
							<?php echo $form['project_title']->renderError(); ?>
                        </div>
                    </div>
                    <div style="float: left;padding-right:30px;">
                        <div style="font-weight: bold;">
							<?php echo $form['iub_work']->renderLabel(); ?>

                            <input type="text" value="<?php echo $collection->getCreator()->getName(); ?>" readonly="readonly" style="background-color: #F0F0F0;cursor: not-allowed"/>
                        </div>
                    </div>
                </td>

                </tr>

                <tr>
                    <th>
						<?php echo $form['date_completed']->renderLabel(); ?>
                    </th>
                    <td>
						<?php echo $form['date_completed']->render(array('date_completed' => 'Date Completed.')); ?> 
						<?php echo $form['date_completed']->renderError(); ?>
                    </td>
                </tr>
                <!-- -->



                <!-- -->
                <tr>
                    <th style="padding-top: 18px;"><span style="float: left;font-weight: bold;">Subject Interest:&nbsp;&nbsp;&nbsp; </span></th>
                    <td>

                        <div style="float: left;padding-right:30px;;">
                            <div style="font-weight: bold;">
								<?php echo $form['score_subject_interest']->renderLabel(); ?>
                            </div>
                            <div style="float: left;">
								<?php echo $form['score_subject_interest']->render(array('score_subject_interest' => 'Score Subject Interest.')); ?> 

                            </div>
                        </div>

                        <div style="float: left;">
                            <div style="float: left;
                                 font-weight: bold;">
								 <?php echo $form['notes_subject_interest']->renderLabel(); ?>
                            </div>

                            <div>
								<?php echo $form['notes_subject_interest']->render(array('notes_subject_interest' => 'Notes Subject Interest.')); ?> 
								<?php echo $form['notes_subject_interest']->renderError(); ?>
                            </div>
                        </div>
                    </td>
                </tr>
				<tr>
                    <td colspan="2">
						<?php echo $form['score_subject_interest']->renderError(); ?>
                        <span style="color:#7D110C;font-size: 9px;font-weight:bold;display:none" id="collection_score_subject_interest_errorn"><br>Score must be integer , greater then 0 and  less then 5 </span>
                    </td>
                </tr>
                <!-- -->




                <!-- -->
                <tr>
                    <th><span style="float: left;font-weight: bold;">Content Quality:&nbsp;&nbsp;&nbsp; </span></th>
                    <td>
                        <div style="float: left;padding-right:40px;">

                            <div style="float: left;">
								<?php echo $form['score_content_quality']->render(array('score_content_quality' => 'Score Content Quality.')); ?> 

                            </div>
                        </div>

                        <div style="float: left;">
                            <!--                            <div style="float: left;font-weight: bold;">
							<?php echo $form['notes_content_quality']->renderLabel(); ?>
                                                        </div>-->

                            <div>
								<?php echo $form['notes_content_quality']->render(array('notes_content_quality' => 'Notes Content Quality.')); ?> 
								<?php echo $form['notes_content_quality']->renderError(); ?>
                            </div>
                        </div>
                    </td>
                </tr>
				<tr>
                    <td colspan="2">

						<?php echo $form['score_content_quality']->renderError(); ?>
                        <span style="color:#7D110C;font-size: 9px;font-weight:bold;display:none" id="collection_score_content_quality_errorn"><br>Score must be integer , greater then 0 and  less then 5 </span>
                    </td>
                </tr>
                <!-- -->


                <!-- -->
                <tr>
                    <th> <span style="float: left;font-weight: bold;">Rareness:&nbsp;&nbsp;&nbsp; </span></th>
                    <td>

                        <div style="float: left;padding-right:40px;">
                            <!--                            <div style="font-weight: bold;">
							<?php echo $form['score_rareness']->renderLabel(); ?>
                                                        </div>-->
                            <div style="float: left;">
								<?php echo $form['score_rareness']->render(array('score_rareness' => 'Score Rareness.')); ?> 

                            </div>
                        </div>

                        <div style="float: left;">
                            <!--                            <div style="float: left;font-weight: bold;">
							<?php echo $form['notes_rareness']->renderLabel(); ?>
                                                        </div>-->

                            <div>
								<?php echo $form['notes_rareness']->render(array('notes_rareness' => 'Notes Rareness.')); ?> 
								<?php echo $form['notes_rareness']->renderError(); ?>
                            </div>
                        </div>
                    </td>
                </tr>
				<tr>
                    <td colspan="2">

						<?php echo $form['score_rareness']->renderError(); ?>
                        <span style="color:#7D110C;font-size: 9px;font-weight:bold;display:none" id="collection_score_rareness_errorn"><br>Score must be integer , greater then 0 and  less then 5 </span>
                    </td>
                </tr>
                <!-- -->


                <!-- -->
                <tr>
                    <th> <span style="float: left;font-weight: bold;">Documentation:&nbsp;&nbsp;&nbsp; </span></th>
                    <td>

                        <div style="float: left;padding-right:40px;">
                            <!--                            <div style="font-weight: bold;">
							<?php echo $form['score_documentation']->renderLabel(); ?>
                                                        </div>-->
                            <div style="float: left;">
								<?php echo $form['score_documentation']->render(array('score_documentation' => 'Score Documentation.')); ?> 

                            </div>
                        </div>

                        <div style="float: left;">
                            <!--                            <div style="float: left;font-weight: bold;">
							<?php echo $form['notes_documentation']->renderLabel(); ?>
                                                        </div>-->

                            <div>
								<?php echo $form['notes_documentation']->render(array('notes_documentation' => 'Notes Documentation.')); ?> 
								<?php echo $form['notes_documentation']->renderError(); ?>
                            </div>
                        </div>
                    </td>
                </tr>
				<tr>
                    <td colspan="2">
						<?php echo $form['score_documentation']->renderError(); ?>
                        <span style="color:#7D110C;font-size: 9px;font-weight:bold;display:none" id="collection_score_documentation_errorn"><br>Score must be integer , greater then 0 and  less then 5 </span>
                    </td>
                </tr>
                <!-- -->

                <!-- -->
                <tr>
                    <th>    <span style="float: left;font-weight: bold;">Technical Quality:&nbsp;&nbsp;&nbsp; </span></th>
                    <td>


                        <div style="margin-left: 10px;float: left;padding-right:40px;">

                            <div style="float: left;">
								<?php echo $form['score_technical_quality']->render(array('score_technical_quality' => 'Score Technical Quality.')); ?> 

                            </div>
                        </div>
                        <div style="float: left;padding-right:6px;">
                            <div style="font-weight: bold;">
								<?php echo $form['unknown_technical_quality']->renderLabel(); ?>
                            </div>
                            <div style="float: left;margin-left: 30px;">
								<?php echo $form['unknown_technical_quality']->render(array('unknown_technical_quality' => 'Unknown Technical Quality.')); ?> 
								<?php echo $form['unknown_technical_quality']->renderError(); ?>
                            </div>
                        </div>
                        <div style="float: left;">
                            <!--                            <div style="float: left;font-weight: bold;">
							<?php echo $form['notes_technical_quality']->renderLabel(); ?>
                                                        </div>-->

                            <div>
								<?php echo $form['notes_technical_quality']->render(array('notes_technical_quality' => 'Notes Technical Quality.')); ?> 
								<?php echo $form['notes_technical_quality']->renderError(); ?>
                            </div>
                        </div>
                    </td>
                </tr>
				<tr>
                    <td colspan="2">
						<?php echo $form['score_technical_quality']->renderError(); ?>
                        <span style="color:#7D110C;font-size: 9px;font-weight:bold;display:none" id="collection_score_technical_quality_errorn"><br>Score must be integer , greater then 0 and  less then 5 </span>
                    </td>
                </tr>
                <!-- -->

                <!-- -->
                <tr>
                    <th>
						<?php echo $form['collection_score']->renderLabel(); ?>
                    </th>
                    <td>

						<?php echo $form['collection_score']->render(array('collection_score' => 'Collection Score.')); ?> 
						<?php echo $form['collection_score']->renderError(); ?>
                    </td>
                </tr>
                <!-- -->

                <tr>
                    <th>

						<?php echo $form['generation_statement']->renderLabel(); ?>
                    </th>
                    <td>
                        <div style="float: left;">
                            <div style="float: left;padding-right:20px;">
								<?php echo $form['generation_statement']->render(array('generation_statement' => 'Generation Statement.')); ?> 
								<?php echo $form['generation_statement']->renderError(); ?>
                            </div>
                        </div>

                        <div style="float: left;">
                            <div style="float: left;font-weight: bold;">
								<?php echo $form['generation_statement_notes']->renderLabel(); ?>

								<?php echo $form['generation_statement_notes']->render(array('generation_statement_notes' => 'Generation Satement Notes.')); ?> 
								<?php echo $form['generation_statement_notes']->renderError(); ?>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th> <div style="font-weight: bold;">
					<?php echo $form['ip_statement']->renderLabel(); ?>
                </div></th>
                <td>
                    <div style="float: left;">

                        <div style="float: left;padding-right:20px;">
							<?php echo $form['ip_statement']->render(array('ip_statement' => 'IP Statement.')); ?> 
							<?php echo $form['ip_statement']->renderError(); ?>
                        </div>
                    </div>

                    <div style="float: left;">
                        <div style="float: left;font-weight: bold;">
							<?php echo $form['ip_statement_notes']->renderLabel(); ?>

							<?php echo $form['ip_statement_notes']->render(array('ip_statement_notes' => 'IP Statement Notes.')); ?> 
							<?php echo $form['ip_statement_notes']->renderError(); ?>
                        </div>
                    </div>
                </td>
                </tr>

                <!-- -->
                <tr>
                    <th>
						<?php echo $form['general_notes']->renderLabel(); ?>
                    </th>
                    <td >
						<?php echo $form['general_notes']->render(array('general_notes' => 'General Notes.')); ?> 
						<?php echo $form['general_notes']->renderError(); ?>
                    </td>
                </tr>
                <!-- -->


                </tbody> 
            </table>
			<?php echo $form->renderHiddenFields() ?>
        </form>
    </div>
</div></div>
<script type="text/javascript">
	function changeTechnicalQuality() {

		if ($("input:checked").length) {
			$('#collection_score_technical_quality').attr('readonly', true);
			$('#collection_score_technical_quality').val('0');
			$('#collection_score_technical_quality').attr('style', 'background:#F0F0F0;cursor:not-allowed;height: 12px;width: 27px;');
		} else {
			$('#collection_score_technical_quality').attr('readonly', false);
			$('#collection_score_technical_quality').attr('style', 'background:white;cursor:arrow;height: 12px;width: 27px;');
		}
	}

	$(function() {
		changeTechnicalQuality();
		$("#format_type_off_brand").parents(".row").show();
		$("#format_type_fungus").parents(".row").show();



<?php
if (isset($actionType) && $actionType == 'edit')
{
	?>
			$('#collection_inst_id').attr('readonly', 'readonly');
			//            $('#collection_parent_node_id').attr('size', '10');
			$('#collection_inst_id').attr('style', 'background:#F0F0F0;cursor:not-allowed');
			$('#collection_name').attr('readonly', 'readonly');
			$('#collection_name').attr('style', 'background:#F0F0F0;cursor:not-allowed');
			$('#collection_collection_score').attr('style', 'background:#F0F0F0;cursor:not-allowed');
			$('#collection_collection_score').attr('readonly', 'readonly');
	<?php
}
else
{
	?>
			$('#collection_collection_score').attr('style', 'background:#F0F0F0;cursor:not-allowed');
			$('#collection_collection_score').attr('readonly', 'readonly');
<?php } ?>
	});
</script>