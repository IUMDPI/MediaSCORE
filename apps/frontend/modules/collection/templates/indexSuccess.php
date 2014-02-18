<?php
//@set_time_limit(0);
//@ini_set("memory_limit", "1000M"); # 1GB
//@ini_set("max_execution_time", 999999999999); # 1GB
$start_time = microtime(TRUE);
if ( ! isset($view) || $view == '')
	$view = 'score';
if ($sf_user->getGuardUser()->getRole() != 2 || $view == 'river')
{
	?>
	<a class="button new_edit_collection" href="<?php echo url_for('collection/new?u=' . $unitID) ?>">Create Collection</a>
	<?php
}
include_partial('unit/search', array('AllStorageLocations' => $AllStorageLocations));
$url = url_for('collection', $ThisUnit);
if ($url)
	$url = '';
?>    
<style>
    th.header { 
        cursor: pointer; 
        font-weight: bold; 
        margin-left: -1px; 
        padding-top: 11px; 
    } 

    .long_name_handler{
        display:inline-block !important;
        /*white-space: nowrap !important;*/
        text-overflow: ellipsis !important;
        max-width:230px !important;
        height:10px !important;
        overflow:hidden !important;
        width: 230px !important;
    }
    .long_name_handler_inst{
        text-overflow: ellipsis !important;
        /*max-width: 130px !important;*/
        height: 10px !important;
        overflow: hidden !important;
        /*white-space: nowrap !important;*/
        width: 130px !important;
    }

    .intigers {
        text-align: center !important;
        padding-right: 20px !important;
    }

    .tooltip {outline:none; }
    .tooltip strong {line-height:30px;}
    .tooltip:hover {text-decoration:none;} 
    .tooltip span {
        z-index:10;display:none; padding: 10px 20px;
        margin-top: -3px; margin-left:5px;
        width:auto ;line-height:0px;
    }
    .tooltip:hover span{
        display:inline; 
        position:absolute; 
        color:#111;
        border:1px solid gray; 
        background:#d8d8d8;
    }
    .callout {
        z-index:20;
        position:absolute;
        top:30px;
        border:0;
        left:-12px;
    }

    /*CSS3 extras*/
    .tooltip span
    {
        border-radius:4px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;

        -moz-box-shadow: 5px 5px 8px #CCC;
        -webkit-box-shadow: 5px 5px 8px #CCC;
        box-shadow: 5px 5px 8px #CCC;
    }


</style>
<?php
if ($view == 'river')
{
	?>
	<style>
		table.tablesorter thead tr .header {
			background-image: url(/images/tableSorter/bg.gif );
			background-repeat: no-repeat;
			cursor: pointer;
			background-position: right 25px;
		}
	</style>
<?php } ?>
<div style="width: 100%;margin: 0 auto;padding: 10px 0 4px;"> 

    <ul class="tabs" style="background: url(/images/wireframes/nav-background.png), linear-gradient(to bottom, #635e55, #4c473c);" data-persist="true">
		<?php
		if ($sf_user->getGuardUser()->getRole() == 1 || ($sf_user->getGuardUser()->getRole() == 0 && $IsMediaScoreAccess) || ($sf_user->getGuardUser()->getRole() == 2 && $IsMediaScoreAccess))
		{
			?>
			<li><a class='<?php echo (isset($view) && $view == 'score' ) ? 'bg7d110c' : (( ! isset($view)) || ($view == 'bg7d110c' ) ? '' : 'SelectTabClass') ?>' href="<?php echo url_for('collection/setview') . '?view=score&u=' . $unitID ?>"   id="mediascoresView">MediaSCORE</a></li><?php } ?><?php
		if ($sf_user->getGuardUser()->getRole() == 1 || ($sf_user->getGuardUser()->getRole() == 0 && $ISMediaRiverAccess) || ($sf_user->getGuardUser()->getRole() == 2 && $ISMediaRiverAccess))
		{
			?><li><a  class='<?php echo (isset($view) && $view == 'river') ? 'bg7d110c' : 'SelectTabClass'; ?>'  href="<?php echo url_for('collection/setview') . '?view=river&u=' . $unitID ?>" id="mediariversView" >MediaRIVERS</a></li><?php } ?>
    </ul>
    <div class="tabcontents">
		<?php
		if ($IsMediaScoreAccess || $ISMediaRiverAccess || $sf_user->getGuardUser()->getRole() == 1)
		{
			?>
			<input type="hidden"
				   <div id="view1"> 
				<div id="filter-container">
					<div id="filter" class="Xhidden" style="display:none;"> <!-- toggle class "hidden" to show/hide -->
						<div class="title">Filter by:</div>
						<form id="filterCollection" action="<?php echo url_for('collection/index') ?>">
							<strong>Text:</strong> <input type="text" class="text" onkeyup="filterCollection('<?php echo $view; ?>');" id="searchText"/>
							<?php
							if ($view != 'river')
							{
								?>
								<strong>Date:</strong>
								<div class="filter-date">
									<select id="date_type" onchange="filterCollection('<?php echo $view; ?>');">
										<option value="">Date Type</option>
										<option value="0">Created On</option>
										<option value="1">Updated On</option>
									</select>
									<input type="text" id="from" onchange="filterCollection('<?php echo $view; ?>');" readonly="readonly"/>
									to
									<input type="text" id="to" onchange="filterCollection('<?php echo $view; ?>');" readonly="readonly"/>
								</div>
							<?php } ?>
							<strong>Status:</strong>
							<select id="filterStatus" onchange="filterCollection('<?php echo $view; ?>');">
								<option value="">Any Status</option>
								<option value="0">Incomplete</option>
								<option value="1">In Progress</option>
								<option value="2">Completed</option>
							</select>
							<?php
							if ($view == 'river')
							{
								?>

								<input id="scoreType" name="scoreType" type="hidden" value="river" />

								<strong>&nbsp;&nbsp;Score Range: </strong>
								From <input type="text" class="text" onkeyup="filterCollection('<?php echo $view; ?>');" id="score_start"/>To &nbsp;
								<input type="text" class="text" onkeyup="filterCollection('<?php echo $view; ?>');" id="score_end"/> 
								<?php
							}
							else
							{
								?>
								<br/>
								<br/>
								<strong>Score </strong>
								<input id="scoreType" name="scoreType" value="score" type="hidden" />
								From <input type="text" class="text" onkeyup="filterCollection('<?php echo $view; ?>');" id="score_start"/>To &nbsp;
								<input type="text" class="text" onkeyup="filterCollection('<?php echo $view; ?>');" id="score_end"/>  
							<?php } ?>
							<br/>
							<br/>
							<strong>Storage Location : </strong>
							<div class="filter-date">
								<select id="storagefilter" onchange="filterCollection('<?php echo $view; ?>');">
									<option value="">Any Storage Location</option>
									<?php
									foreach ($AllStorageLocations as $StorageLocation)
									{
										?>
										<option value="<?php echo $StorageLocation['id'] ?>"><?php echo $StorageLocation['name'] ?></option>
									<?php } ?>
								</select>
							</div>
							<br/>
							<br/>
						</form>
						<div class="reset"><a href="javascript:void(0);" onclick="resetFields('#filterCollection');"><span>R</span> Reset</a></div>
					</div>
				</div> 
				<div class="show-hide-filter"><a href="javascript:void(0)" onclick="filterToggle();" id="filter_text">Show Filter</a></div> 
				<div class="breadcrumb small"><a href="<?php echo url_for('unit/index') ?>">All Units</a>&nbsp;&gt;&nbsp;<?php echo $unitName ?></div>
				<div  style="margin: 10px; text-align: center;color: #7D110C;font-weight: bold;"><?php echo $deleteMessage; ?></div>

				<table id="collectionTable" class="tablesorter">
					<?php
					if ($view == 'river')
					{
						?><thead> 
							<tr>
								<?php
								if (($sf_user->getGuardUser()->getRole() == 2 && $ISMediaRiverAccess && $view == 'river') || $sf_user->getGuardUser()->getRole() == 1 || $sf_user->getGuardUser()->getRole() == 0)
								{
									?>
									<td width="6%"></td>
								<?php } ?> 
								<th  class="river" style="text-align: left !important;padding-top: 20px !important;">Primary ID</th>
								<th class="river" style="text-align: left !important;padding-top: 20px !important;">Collection</th>
								<th class="river" style="text-align: left !important;">Subject Interest</th>
								<th class="river" style="text-align: left !important;">Content Quality</th>
								<th class="river" style="text-align: left !important;padding-top: 20px !important;">Rareness</th>
								<th class="river" style="text-align: left !important;padding-top: 20px !important;">Documentation</th>
								<th class="river" style="text-align: left !important;">Technical Quality</th>
								<th class="river" style="text-align: left !important;padding-top: 20px !important;">Total</th>
							</tr>
						</thead>
						<tbody id="collectionResult">
							<?php
							if (sizeof($collections) > 0)
							{
								?>
								<?php foreach ($collections as $collection): ?>
									<tr>
										<?php
										if (($sf_user->getGuardUser()->getRole() == 2 && $ISMediaRiverAccess && $view == 'river') || $sf_user->getGuardUser()->getRole() == 1 || $sf_user->getGuardUser()->getRole() == 0)
										{
											?>
											<td class="invisible" width="6%">
												<div class="options">
													<a  class="new_edit_collection" href="<?php echo url_for('collection/edit?id=' . $collection->getId()) . '/u/' . $collection->getParentNodeId() ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
													<a href="#fancybox" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getCollectionId(<?php echo $collection->getId(); ?>);"/></a>
												</div>
											</td> 
											<?php
										}
										$getInstId = $collection->getInstId();
										$lenthInstId = strlen($getInstId);
										$alterInstId = $getInstId;

										$morethenlengthInstId = FALSE;
										if ((int) $lenthInstId >= 10)
										{
											$alterInstId = substr($alterInstId, 0, 10) . '...';
											$morethenlengthInstId = TRUE;
										}
										?>


										<td <?php echo ($morethenlengthInstId) ? 'class="long_name_handler_inst tooltip"' : 'class="long_name_handler_inst"'; ?> width="10%">
											<a href="<?php echo url_for('collection/edit?id=' . $collection->getId()) . '/u/' . $collection->getParentNodeId() . '/form/river' ?>">
												<?php echo $alterInstId ?> <span><?php echo ($morethenlengthInstId) ? $getInstId : ''; ?> </span></a></td>
										<?php
										$getName = $collection->getName();
										$lenthName = strlen($getName);
										$alterName = $getName;

										$morethenlengthName = FALSE;

										if ((int) $lenthName > 35)
										{
											$alterName = (substr($alterName, 0, 35) . '...');
											$morethenlengthName = TRUE;
										}
										?>
										<td <?php echo (($morethenlengthName) ? 'class="long_name_handler tooltip"' : 'class="long_name_handler"'); ?> width="30%" ><a href="<?php echo url_for('collection/edit?id=' . $collection->getId()) . '/u/' . $collection->getParentNodeId() . '/form/river' ?>">
												<?php echo $alterName ?>  
												<span><?php echo ($morethenlengthName ? $getName : ''); ?></span></a></td>
										<td class="intigers" width="8%"><?php echo ($collection->getScoreSubjectInterest()) ? $collection->getScoreSubjectInterest() : 0; ?></td>
										<td class="intigers" width="7%"><?php echo ($collection->getScoreContentQuality()) ? $collection->getScoreContentQuality() : 0; ?></td>
										<td class="intigers" width="9%"><?php echo ($collection->getScoreRareness()) ? $collection->getScoreRareness() : 0; ?></td>
										<td class="intigers" width="12%"><?php echo ($collection->getScoreDocumentation()) ? $collection->getScoreDocumentation() : 0; ?></td>
										<td class="intigers"  width="9%"><?php echo ($collection->getScoreTechnicalQuality()) ? $collection->getScoreTechnicalQuality() : 0; ?></td>
										<td class="intigers" width="7%" ><?php echo ($collection->getCollectionScore()) ? $collection->getCollectionScore() : 0; ?></td>
									</tr> 
								<?php endforeach; ?>

								<?php
							}
							else
							{
								echo '<tr><td>No Collection Available</td></tr>';
							}
							?>
						</tbody>
						<?php
					}
					else
					{
						?> 

						<thead>
							<tr>
								<?php
								if (($sf_user->getGuardUser()->getRole() == 2 && $ISMediaRiverAccess && $view == 'river') || $sf_user->getGuardUser()->getRole() == 1 || $sf_user->getGuardUser()->getRole() == 0)
								{
									?>
									<td width="6%"></td>
								<?php } ?>
								<th width="13%">Primary ID</th>
								<th width="18%">Collection</th>
								<th>Created</th>
								<th width="15%">Created By</th>
								<th width="12%">Updated On</th>
								<th width="15%">Updated By</th>
								<th width="10%" style="text-align: center;">Duration</th>
							</tr>
						</thead>
						<tbody id="collectionResult">
							<?php
							if (sizeof($collections) > 0)
							{
								?>
								<?php foreach ($collections as $collection): ?>
									<tr>
										<?php
										if (($sf_user->getGuardUser()->getRole() == 2 && $ISMediaRiverAccess && $view == 'river') || $sf_user->getGuardUser()->getRole() == 1 || $sf_user->getGuardUser()->getRole() == 0)
										{
											?>

											<td class="invisible">
												<div class="options">
													<a  class="<?php echo ($view == 'score') ? 'new_edit_collection' : ''; ?>" href="<?php echo url_for('collection/edit?id=' . $collection->getId()) . '/u/' . $collection->getParentNodeId() ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
													<a href="#fancybox" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getCollectionId(<?php echo $collection->getId(); ?>);"/></a>
												</div>
											</td>
											<?php
										}
										?>

										<td> <span><?php echo $collection->getInstId(); ?> </span></a></td>
										<?php
										$getName = $collection->getName();
										$lenthName = strlen($getName);
										$alterName = $getName;

										$morethenlengthName = FALSE;

										if ((int) $lenthName > 35)
										{
											$alterName = (substr($alterName, 0, 35) . '...');
											$morethenlengthName = TRUE;
										}
										?>
										<td><span><?php echo ($morethenlengthName) ? $getName : ''; ?></span></a></td>

										<td width="9%"><?php echo date('Y-m-d', strtotime($collection->getCreatedAt())); ?></td>
										<td><span style="display: none;"><?php echo $collection->getCreator()->getLastName() ?></span><?php echo $collection->getCreator()->getName() ?></td>
										<td><?php echo date('Y-m-d', strtotime($collection->getUpdatedAt())); ?></td>
										<td><span style="display: none;"><?php echo $collection->getEditor()->getLastName() ?></span><?php echo $collection->getEditor()->getName() ?></td>
										<td style="display: none;"><span style="display: none;"><?php echo (int) minutesToHour::ConvertHoursToMin($collection->getDuration($collection->getId())); ?></span></td>
										<td style="text-align: right;"><?php echo $collection->getDurationRealTime($collection->getId()) ?></td>

									</tr>
								<?php endforeach; ?>

								<?php
							}
							else
							{
								echo '<tr><td>No Collection Available</td></tr>';
							}
							?>
						</tbody>


					<?php } ?>
				</table>
				<?php
			}
			else
			{
				?>
				<h3> <center>You don't have access to Perform any Operations,please contact the administrator for more information</center></h3>
			<?php } ?>
        </div>

        <div id="view2">
        </div>

    </div>

</div>

<script type="text/javascript">
	var userType = '<?php echo $sf_user->getGuardUser()->getRole(); ?>';
	var ISMediaRiverAccess = '<?php echo $ISMediaRiverAccess; ?>';
	var IsMediaScoreAccess = '<?php echo $IsMediaScoreAccess; ?>';

	$(document).ready(function() {

		var dates = $("#from, #to").datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 2,
			'dateFormat': 'yy-mm-dd',
			onSelect: function(selectedDate) {
				filterCollection('<?php echo $view; ?>');
				var option = this.id == "from" ? "minDate" : "maxDate",
				instance = $(this).data("datepicker"),
				date = $.datepicker.parseDate(
				instance.settings.dateFormat ||
				$.datepicker._defaults.dateFormat,
				selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
		$("#collectionTable").tablesorter();

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
		$(".new_edit_collection").fancybox({
			'width': '100%',
			'height': '100%',
			'autoScale': true,
			'transitionIn': 'none',
			'transitionOut': 'none',
			'type': 'inline',
			'padding': 0,
			'showCloseButton': true

		});
	});
	var filter = 1;
	var collectionId = null;

	var unit_slug_name = '<?php echo $unitObject->getNameSlug(); ?>';
	function filterToggle() {
		$('#filter').slideToggle();
		if (filter == 0) {
			filter = 1;
			$('#filter_text').html('Show Filter');

		}
		else {
			$('#filter_text').html('Hide Filter');
			filter = 0;
		}


	}
	function getCollectionId(id) {
		collectionId = id;
	}
	function deleteCollection(unit) {
		window.location.href = '/collection/delete?id=' + collectionId + '&u=' + unit;
	}
	function resetFields(form) {
		form = $(form);
		form.find('input:text, input:password, input:file, select').val('');
		form.find('input:radio, input:checkbox')
		.removeAttr('checked').removeAttr('selected');
		filterCollection('<?php echo $view; ?>');
	}
	function removeSearchText() {

	}
	var Check = new Array();
	var i = 0;
	function filterCollection(view) {

		unitId = '<?php echo $unitID; ?>';

		Check[i] = $.ajax({
			type: 'POST',
			url: '/index.php/collection/index',
			data: {id: '<?php echo $unitID; ?>', s: $('#searchText').val(), status: $('#filterStatus').val(), from: $('#from').val(), to: $('#to').val(), datetype: $('#date_type').val(), score: $('#score').val(), score_start: $('#score_start').val(), score_end: $('#score_end').val(), scoreType: $("#scoreType").val(), storagefilter: $("#storagefilter").val()},
			dataType: 'json',
			cache: false,
			success: function(result) {
				if (result != undefined && result.length > 0) {
					$('#collectionResult').html('');
					if (view == 'river') {
						for (collection in result) {
							editdelete = '';
							if ((userType == 2 && ISMediaRiverAccess && view == 'river') || userType == 1 || userType == 0) {
								editdelete = '<td width="7%" class="invisible">' +
								'<div class="options" >' +
								'<a class="" href="/collection/edit/id/' + result[collection].id + '/u/' + unitId + '"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a> ' +
								' <a href="#fancybox" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getCollectionId(' + result[collection].id + ');"/></a>' +
								'</div></td>';
							} else {
								editdelete = '<td>&nbsp;</td>'
							}
							$('#collectionResult').append('<tr>' + editdelete
							+
							'<td width="10%" class="long_name_handler_inst tooltip" width="21%"><a href="/collection/edit/id/' + result[collection].id + '/u/' + unitId + '/form/river/' + '">' + ((result[collection].inst_id.length > 10) ? (result[collection].inst_id.substr(0, 10) + '...') : result[collection].inst_id) + ((result[collection].inst_id.length > 10) ? '<span>' + result[collection].inst_id + '</span>' : '') + ' </span> </a></td>' +
							'<td width="30%" class="long_name_handler tooltip" width="25%"><a href="/collection/edit/id/' + result[collection].id + '/u/' + unitId + '/form/river/' + '">' + ((result[collection].name.length > 35) ? (result[collection].name.substr(0, 35) + '...') : result[collection].name) + ((result[collection].name.length > 35) ? ' <span>' + result[collection].name + ' </span>' : '') + '</a></td>' +
							'<td class="intigers" width="8%">' + ((result[collection].score_subject_interest) ? result[collection].score_subject_interest : '0') + '</td>' +
							'<td class="intigers" width="7%">' + ((result[collection].score_content_quality) ? result[collection].score_content_quality : '0') + '</td>' +
							'<td class="intigers" width="9%">' + ((result[collection].score_rareness) ? result[collection].score_rareness : '0') + '</td>' +
							'<td class="intigers" width="12%">' + ((result[collection].score_documentation) ? result[collection].score_documentation : '0') + '</td>' +
							'<td class="intigers" width="9%">' + ((result[collection].score_technical_quality) ? result[collection].score_technical_quality : '0') + '</td>' +
							'<td class="intigers" width="7%">' + ((result[collection].collection_score) ? result[collection].collection_score : '0') + '</td>' +
							'</tr>');
						}
					} else {

						for (collection in result) {

							editdelete = '';
							if (userType != 2) {
								editdelete = '<td width="7%" class="invisible">' +
								'<div class="options">' +
								'<a class="new_edit_collection" href="/collection/edit/id/' + result[collection].id + '/u/' + unitId + '"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a> ' +
								' <a href="#fancybox" class="delete_unit"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" onclick="getCollectionId(' + result[collection].id + ');"/></a>' +
								'</div></td>';
							}

							Created_at = result[collection].created_at.split(' ');
							Updated_at = result[collection].updated_at.split(' ');

							$('#collectionResult').append('<tr>' + editdelete +
							'<td ' + ((result[collection].inst_id.length > 10) ? 'class="long_name_handler_inst tooltip"' : 'class="long_name_handler_inst"') + '><a href="/' + unit_slug_name + '/' + result[collection].name_slug + '/">' + ((result[collection].inst_id.length > 10) ? (result[collection].inst_id.substr(0, 10) + '...') : result[collection].inst_id) + ((result[collection].inst_id.length > 10) ? ' <span>' + result[collection].inst_id + ' </span>' : '') + '</a></td>' +
							'<td width="18%" ' + ((result[collection].name.length > 39) ? 'class="long_name_handler tooltip"' : 'class="long_name_handler"') + '><a href="/' + unit_slug_name + '/' + result[collection].name_slug + '/">' + ((result[collection].name.length > 35) ? (result[collection].name.substr(0, 35) + '...') : result[collection].name) + '' + ((result[collection].name.length > 35) ? '<span>' + result[collection].name + '</span>' : '') + ' </a></td>' +
							'<td width="10%">' + Created_at[0] + '</td>' +
							'<td width="15%"><span style="display: none;">' + result[collection].Creator.last_name + '</span>' + result[collection].Creator.first_name + result[collection].Creator.last_name + '</td>' +
							'<td width="12%">' + Updated_at[0] + '</td>' +
							'<td width="15%"><span style="display: none;">' + result[collection].Editor.last_name + '</span>' + result[collection].Editor.first_name + result[collection].Editor.last_name + '</td>' + '<td width="9%" style="text-align: right;">' + result[collection].duration + '</td>');
							if (result[collection].StorageLocations[0]) {
								//                            $('#collectionResult').append('<td>'+result[collection].StorageLocations[0].resident_structure_description+'</td></tr>'); 
							}
						}
					}
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
					$(".new_edit_collection").fancybox({
						'width': '100%',
						'height': '100%',
						'autoScale': true,
						'transitionIn': 'none',
						'transitionOut': 'none',
						'type': 'inline',
						'padding': 0,
						'showCloseButton': true

					});
				}
				else {
					$('#collectionResult').html('<tr><td colspan="6" style="text-align:center;">No Collection found</td></tr>');
				}

				$("#collectionTable").trigger("update");

			}
		});
		for (j = 0; j <= (i - 1); j++) {
			Check[j].abort();
		}
		i++;
	}
	$(function() {
		//        setTimeout('BindJsAgain()', 1000);
		setInterval(function() {
			if ($("#collection_storage_locations_list").is(":visible")) {
				BindJsAgain();
			}
		}, 1000);
		$("#mediascoresView").bind("click", function() {
			$("#mediascoresView").attr('class', 'bg7d110c');
			$('#mediariversView').attr('class', 'SelectTabClass');
		});

		$("#mediariversView").bind("click", function() {
			$("#mediariversView").attr('class', 'bg7d110c');
			$('#mediascoresView').attr('class', 'SelectTabClass');

		});

	});

	function BindJsAgain() {
		$.get('/index.php/storagelocation/index', {
			u: $('#collection_parent_node_id').val()},
		function(storageLocation) {
			$('#collection_storage_locations_list').html('');
			if (storageLocation.length) {
				for (i in storageLocation)
					if (storageLocation[i]) {
						$('#collection_storage_locations_list').append('<option value="' + storageLocation[i].id + '" selected="selected">' + storageLocation[i].name + '</option>');
					}

				$('#collection_storage_locations_list').multiselect({
					'height': 'auto'
				}).multiselectfilter();
			} else {
				$('#collection_storage_locations_list').append('<option value="-1">No Storage Location</option>');
				$('#collection_storage_locations_list').multiselect({
					'height': 'auto',
					header: "Storage Location!",
					multiple: false,
					selectedList: 1 // 0-based index
				});
				$('#collection_storage_locations_list').multiselect("checkAll");
			}
		});
	}
</script>
<?php
if (sizeof($collections) > 0)
{
	?>
	<div style="display: none;"> 
		<div id="fancybox" style="background-color: #F4F4F4;width: 600px;" >
			<header>
				<h5  class="fancybox-heading">Warning!</h5>
			</header>
			<div style="margin: 10px;">
				<h3>Careful!</h3>
			</div>
			<div style="margin: 10px;font-size: 0.8em;">
				You are about to delete a Collection which will permanently erase all information associated with it.<br/>
				Are you sure you want to proceed?
			</div>
			<div style="margin: 10px;"><a class="button" href="javascript://" onclick="$.fancybox.close();">NO</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="deleteCollection(<?php echo $unitID; ?>);">YES</a></div>
		</div>
	</div>
<?php } ?>
<?php
$end_time = microtime(TRUE);
$time_taken = $end_time - $start_time;
$time_taken = round($time_taken, 5);

echo 'Page generated in ' . $time_taken . ' seconds.';
?>