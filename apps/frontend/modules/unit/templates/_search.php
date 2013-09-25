<div id="search-box">
    <form action="<?php echo url_for('unit/search') ?>" method="post" onkeypress="return event.keyCode != 13;">
        <div class="search-input">
            <div id="token_string" style="float: left;">

            </div>
            <input type="hidden" id="search_values" name="search_values"/>
            <input type="search" placeholder="Search all records" id="mainsearch" onkeyup="makeToken(event);"/>
            <div class="container">
                <a class="search-triangle" href="javascript:void(0);" onclick="$('.dropdown-container').slideToggle();
			$('.dropdown-container').css('width', $('.search-input').width() + 26);"></a><b class="token-count" style="display: none;"></b>
                <a class="search-close" href="javascript:void(0);" onclick="removeAllTokenDivs();" style="display: none;"></a>
            </div>
            <input class="button" type="submit" value="" />
            <div class="dropdown-container" style="height: 200px;overflow-y: scroll;display: none;">
                <div class="dropdown clearfix Xhidden">
                    <ul class="left-column">
                        <li><h1>Format</h1></li>
						<?php
						foreach (FormatType::$formatTypesValue as $formatTypeArray):
							foreach ($formatTypeArray as $formatTypeModelName => $formatTypeStr):
								?>
								<li><a id="type_<?php echo $formatTypeModelName ?>" value="<?php echo $formatTypeModelName ?>" onclick="makeTypeToken('<?php echo $formatTypeStr ?>');"><?php echo $formatTypeStr ?></a></li>

								<?php
							endforeach;
						endforeach
						?>

                    </ul>
                    <ul class="right-column">
                        <li><h1>Type</h1></li>

                        <li><a href="javascript:void(0);" onclick="makeTypeToken(0);">Unit</a></li>
                        <li><a href="javascript:void(0);" onclick="makeTypeToken(1);">Collection</a></li>
                        <li><a href="javascript:void(0);" onclick="makeTypeToken(2);">Asset Group</a></li>

                    </ul>
                    <br/>
                    <ul class="right-column">

                        <li><h1>Storage Location</h1></li>
						<?php foreach ($AllStorageLocations as $StorageLoca): ?>
							<li><a href="javascript:void(0);" onclick="makeTypeToken('<?php echo $StorageLoca['name'] ?>');"><?php echo $StorageLoca['name'] ?></a></li>
						<?php endforeach
						?>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
	var token=0;
	
    var removeToken=0;
		function makeToken(event) {

			if (event.keyCode == 13 && $('#mainsearch').val() != '') {
				token = token + 1;

				$('#token_string').append('<div class="token" id="div_' + token + '"><span id="search_string_' + token + '">' + $('#mainsearch').val() + '</span><span> <a href="javascript:void(0);" onclick="removeTokenDiv(' + token + ');">X</a></span></div>');
				getRecords();
				$('#mainsearch').val('');
				$('.dropdown-container').css('width', $('.search-input').width() + 26);

			}
			else if (event.keyCode == 8) {
				if ($('#mainsearch').val() == '' && token != 0) {
					if (removeToken == 1) {
						$('.token').last().remove();

						$('.dropdown-container').css('width', $('.search-input').width() + 26);
						token = token - 1;
						removeToken = 0;
						getRecords();
					}
					else {
						removeToken = 1;
					}

				}

			}
			if (token > 0) {
				$('.token-count').html(token);
				$('.search-close').show();
				$('.token-count').show();

			}
			else {
				$('.token-count').html(token);
				$('.search-close').hide();
				$('.token-count').hide();
			}
			//        console.log(token);
		}
		function removeTokenDiv(id) {
			$('#div_' + id).remove();

			token = token - 1;
			getRecords();
			if (token > 0) {
				$('.token-count').html(token);
				$('.search-close').show();
				$('.token-count').show();
				$('.dropdown-container').css('width', $('.search-input').width() + 26);

			}
			else {
				$('.token-count').html(token);
				$('.search-close').hide();
				$('.token-count').hide();
			}

		}
		function removeAllTokenDivs() {
			$('.token').remove();
			token = 0;
			getRecords();
			$('.token-count').html(token);
			$('.search-close').hide();
			$('.token-count').hide();
			$('.dropdown-container').css('width', $('.search-input').width() + 26);


		}
		function makeTypeToken(type) {
			if (type == 0) {
				value = 'Unit';
			}
			else if (type == 1) {
				value = 'Collection';
			}
			else if (type == 2) {
				value = 'Asset Group';
			}
			else {
				value = type;
			}
			token = token + 1;
			$('#token_string').append('<div class="token" id="div_' + token + '"><span id="search_string_' + token + '">' + value + '</span><span> <a href="javascript:void(0);" onclick="removeTokenDiv(' + token + ');">X</a></span></div>');
			getRecords();
			$('.dropdown-container').css('width', $('.search-input').width() + 26);
			if (token > 0) {
				$('.token-count').html(token);
				$('.search-close').show();
				$('.token-count').show();

			}
			else {
				$('.token-count').html(token);
				$('.search-close').hide();
				$('.token-count').hide();
			}
		}
		function getRecords() {
			var search = new Array();
			count = 1;
			;
			if (token > 0) {
				for (i = 1; i <= token; ) {
					if ($('#search_string_' + count).length > 0) {
						search[i - 1] = $('#search_string_' + count).text();
						i++;
					}
					count++;
				}
			}
			$('#search_values').val(search);
		}
</script>