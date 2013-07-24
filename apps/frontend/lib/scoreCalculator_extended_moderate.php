<?php

/**
 * Description of scoreCalculator_extended_moderate
 *
 * @author Furqan
 */
class scoreCalculator_extended_moderate
{

	/**
	 * DV Score Calculator
	 * @param Array $AssetInformatoin
	 * @param Array $characteristicsValues
	 * 
	 * 
	 * @return int $CaliculatedScore
	 */
	public function DVCalc($AssetInformatoin = array(), $characteristicsValues = array())
	{
		$constraint_will_be_applied = FALSE;

		if ($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL)
		{
			$constraint_will_be_applied = TRUE;
		}

		foreach ($characteristicsValues as $characteristicsValue)
		{
			if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove'))
			{
				continue;
			}
			if ($characteristicsValue['c_name'] == 'base_score')
			{
				echo 'base_score = ';
				echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
				echo '<br/>';
				echo '<br/>';
			}

			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec'))
			{
				if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year')
				{
					echo 'year_rec = ';
					$year = date('Y');
					echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
					echo '<br/>';
					echo '<br/>';
				}
				else
				{
					$this->score = (float) $this->score + 0.0;
					echo '<br/>';
					echo '<br/>';
				}
			}

			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome'))
			{

				if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome']))
				{
					echo 'softBinderSyndrome = ';
					echo $softBinderSyndrome = (($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
					$this->score = (float) $this->score + (float) $softBinderSyndrome;
					echo '<br/>';
					echo '<br/>';
				}
			}
			if ( ! $constraint_will_be_applied)
			{
				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['copies']))
					{
						echo 'copies = ';
						echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + (float) $copies;
						echo '<br/>';
						echo '<br/>';
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'off_brand'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['off_brand']))
					{
						echo 'off_brand = ';
						echo $off_brand = (($AssetInformatoin[0]['FormatType']['off_brand'] != '' && $AssetInformatoin[0]['FormatType']['off_brand'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
						echo '<br/>';
						$this->score = (float) $this->score + (float) $off_brand;
						echo '<br/>';
						echo '<br/>';
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus'))
				{
					echo 'fungus = ';
					if (isset($AssetInformatoin[0]['FormatType']['fungus']))
					{
						echo $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + $fungus;
						echo '<br/>';
						echo '<br/>';
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['other_contaminants']))
					{
						echo 'other_contaminants = ';
						echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + $other_contaminants;
						echo '<br/>';
						echo '<br/>';
					}
				}



				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['recordingStandard']))
					{
						if (strstr(strtolower($this->multiselection_value['NewrecordingStandard'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'recordingStandard = ';
							echo $recordingStandard = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $recordingStandard;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}


				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingSpeed'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['recordingSpeed']))
					{
						if (strstr(strtolower($this->multiselection_value['DVrecordingSpeed'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'recordingSpeed = ';
							echo $recordingSpeed = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $recordingSpeed;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}



				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'size'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['size']))
					{
						if (strstr(strtolower($this->multiselection_value['size'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'size = ';
							echo $size = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $size;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['pack_deformation']))
					{
						if (strstr(strtolower($this->multiselection_value['NewPack_deformation'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'pack_deformation = ';
							echo $pack_deformation = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $pack_deformation;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}
			}
		}
		return $this->score;
	}

	/**
	 * DVCAM Score Calculator
	 * @param Array $AssetInformatoin
	 * @param Array $characteristicsValues
	 * 
	 * 
	 * @return int $CaliculatedScore
	 */
	public function DVCAMCalc($AssetInformatoin = array(), $characteristicsValues = array())
	{
		$constraint_will_be_applied = FALSE;

		if ($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL)
		{
			$constraint_will_be_applied = TRUE;
		}
		foreach ($characteristicsValues as $characteristicsValue)
		{
			if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove'))
			{
				continue;
			}



			if ($characteristicsValue['c_name'] == 'base_score')
			{
				echo 'base_score = ';
				echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
				echo '<br/>';
				echo '<br/>';
			}

			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec'))
			{
				if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year')
				{
					echo 'year_rec = ';
					$year = date('Y');
					echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
					echo '<br/>';
					echo '<br/>';
				}
				else
				{
					$this->score = (float) $this->score + 0.0;
					echo '<br/>';
					echo '<br/>';
				}
			}

			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome'))
			{

				if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome']))
				{
					echo 'softBinderSyndrome = ';
					echo $softBinderSyndrome = (($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
					$this->score = (float) $this->score + (float) $softBinderSyndrome;
					echo '<br/>';
					echo '<br/>';
				}
			}
			if ( ! $constraint_will_be_applied)
			{
				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['copies']))
					{
						echo 'copies = ';
						echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + (float) $copies;
						echo '<br/>';
						echo '<br/>';
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'off_brand'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['off_brand']))
					{
						echo 'off_brand = ';
						echo $off_brand = (($AssetInformatoin[0]['FormatType']['off_brand'] != '' && $AssetInformatoin[0]['FormatType']['off_brand'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
						echo '<br/>';
						$this->score = (float) $this->score + (float) $off_brand;
						echo '<br/>';
						echo '<br/>';
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus'))
				{
					echo 'fungus = ';
					if (isset($AssetInformatoin[0]['FormatType']['fungus']))
					{
						echo $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + $fungus;
						echo '<br/>';
						echo '<br/>';
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['other_contaminants']))
					{
						echo 'other_contaminants = ';
						echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + $other_contaminants;
						echo '<br/>';
						echo '<br/>';
					}
				}



				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['recordingStandard']))
					{
						if (strstr(strtolower($this->multiselection_value['NewrecordingStandard'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'recordingStandard = ';
							echo $recordingStandard = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $recordingStandard;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}



				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'size'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['size']))
					{
						if (strstr(strtolower($this->multiselection_value['size'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'size = ';
							echo $size = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $size;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['pack_deformation']))
					{
						if (strstr(strtolower($this->multiselection_value['NewPack_deformation'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'pack_deformation = ';
							echo $pack_deformation = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $pack_deformation;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}
			}
		}
		return $this->score;
	}

	/**
	 * BetaCam Score Calculator
	 * @param Array $AssetInformatoin
	 * @param Array $characteristicsValues
	 * 
	 * 
	 * @return int $CaliculatedScore
	 */
	public function BetaCamCalc($AssetInformatoin = array(), $characteristicsValues = array())
	{
		$constraint_will_be_applied = FALSE;
		if ($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL)
		{
			$constraint_will_be_applied = TRUE;
		}

		foreach ($characteristicsValues as $characteristicsValue)
		{
			if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove'))
			{
				continue;
			}

			if ($characteristicsValue['c_name'] == 'base_score')
			{
				echo 'base_score = ';
				echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
				echo '<br/>';
				echo '<br/>';
			}

			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec'))
			{
				if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year')
				{
					echo 'year_rec = ';
					$year = date('Y');
					echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
					echo '<br/>';
					echo '<br/>';
				}
				else
				{
					$this->score = (float) $this->score + 0.0;
					echo '<br/>';
					echo '<br/>';
				}
			}
			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies'))
			{
				if (isset($AssetInformatoin[0]['FormatType']['copies']))
				{
					echo 'copies = ';
					echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
					$this->score = (float) $this->score + (float) $copies;
					echo '<br/>';
					echo '<br/>';
				}
			}

			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome'))
			{

				if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome']))
				{
					echo 'softBinderSyndrome = ';
					echo $softBinderSyndrome = (($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
					$this->score = (float) $this->score + (float) $softBinderSyndrome;
					echo '<br/>';
					echo '<br/>';
				}
			}
			if ( ! $constraint_will_be_applied)
			{
				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'off_brand'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['off_brand']))
					{
						echo 'off_brand = ';
						echo $off_brand = (($AssetInformatoin[0]['FormatType']['off_brand'] != '' && $AssetInformatoin[0]['FormatType']['off_brand'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
						echo '<br/>';
						$this->score = (float) $this->score + (float) $off_brand;
						echo '<br/>';
						echo '<br/>';
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus'))
				{
					echo 'fungus = ';
					if (isset($AssetInformatoin[0]['FormatType']['fungus']))
					{
						echo $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + $fungus;
						echo '<br/>';
						echo '<br/>';
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['other_contaminants']))
					{
						echo 'other_contaminants = ';
						echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + $other_contaminants;
						echo '<br/>';
						echo '<br/>';
					}
				}



				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['recordingStandard']))
					{
						if (strstr(strtolower($this->multiselection_value['NewrecordingStandard'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'recordingStandard = ';
							echo $recordingStandard = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $recordingStandard;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}


				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'format'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['format']))
					{
						if (strstr(strtolower($this->multiselection_value['BetaCamformatVersion'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'BetaCamformatVersion = ';
							echo $BetaCamformatVersion = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $BetaCamformatVersion;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}


				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['pack_deformation']))
					{
						if (strstr(strtolower($this->multiselection_value['NewPack_deformation'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'pack_deformation = ';
							echo $pack_deformation = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $pack_deformation;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}
			}
		}
		return $this->score;
	}

	/**
	 * VHS Score Calculator
	 * @param Array $AssetInformatoin
	 * @param Array $characteristicsValues
	 * 
	 * 
	 * @return int $CaliculatedScore
	 */
	public function VHSCalc($AssetInformatoin = array(), $characteristicsValues = array())
	{
		$constraint_will_be_applied = FALSE;
		if ($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL)
		{
			$constraint_will_be_applied = TRUE;
		}

		foreach ($characteristicsValues as $characteristicsValue)
		{
			if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove'))
			{
				continue;
			}

			if ($characteristicsValue['c_name'] == 'base_score')
			{
				echo 'base_score = ';
				echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
				echo '<br/>';
				echo '<br/>';
			}

			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec'))
			{
				if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year')
				{
					echo 'year_rec = ';
					$year = date('Y');
					echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
					echo '<br/>';
					echo '<br/>';
				}
				else
				{
					$this->score = (float) $this->score + 0.0;
					echo '<br/>';
					echo '<br/>';
				}
			}
			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies'))
			{
				if (isset($AssetInformatoin[0]['FormatType']['copies']))
				{
					echo 'copies = ';
					echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
					$this->score = (float) $this->score + (float) $copies;
					echo '<br/>';
					echo '<br/>';
				}
			}

			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome'))
			{

				if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome']))
				{
					echo 'softBinderSyndrome = ';
					echo $softBinderSyndrome = (($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
					$this->score = (float) $this->score + (float) $softBinderSyndrome;
					echo '<br/>';
					echo '<br/>';
				}
			}
			if ( ! $constraint_will_be_applied)
			{
				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'off_brand'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['off_brand']))
					{
						echo 'off_brand = ';
						echo $off_brand = (($AssetInformatoin[0]['FormatType']['off_brand'] != '' && $AssetInformatoin[0]['FormatType']['off_brand'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
						echo '<br/>';
						$this->score = (float) $this->score + (float) $off_brand;
						echo '<br/>';
						echo '<br/>';
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus'))
				{
					echo 'fungus = ';
					if (isset($AssetInformatoin[0]['FormatType']['fungus']))
					{
						echo $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + $fungus;
						echo '<br/>';
						echo '<br/>';
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['other_contaminants']))
					{
						echo 'other_contaminants = ';
						echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + $other_contaminants;
						echo '<br/>';
						echo '<br/>';
					}
				}



				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['recordingStandard']))
					{
						if (strstr(strtolower($this->multiselection_value['NewrecordingStandard'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'recordingStandard = ';
							echo $recordingStandard = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $recordingStandard;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}
				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'size'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['size']))
					{
						if (strstr(strtolower($this->multiselection_value['VHSSize'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'size = ';
							echo $size = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $size;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}
				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingSpeed'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['recordingSpeed']))
					{
						if (strtolower($this->multiselection_value['VHSrecordingSpeed'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]) == strtolower($characteristicsValue['c_name']))
						{
							echo 'recordingSpeed = ';
							echo $recordingSpeed = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $recordingSpeed;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'format'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['format']))
					{
						if (strtolower($this->multiselection_value['VHSformatVersion'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]) == strtolower($characteristicsValue['c_name']))
						{
							echo $characteristicsValue['c_name'] . 'formatVersion = ';
							echo $VHSformatVersion = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $VHSformatVersion;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}


				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['pack_deformation']))
					{
						if (strstr(strtolower($this->multiselection_value['NewPack_deformation'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'pack_deformation = ';
							echo $pack_deformation = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $pack_deformation;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}
			}
		}
		return $this->score;
	}

	/**
	 * HDCAM Score Calculator
	 * @param Array $AssetInformatoin
	 * @param Array $characteristicsValues
	 * 
	 * 
	 * @return int $CaliculatedScore
	 */
	public function HDCAMCalc($AssetInformatoin = array(), $characteristicsValues = array())
	{
		$constraint_will_be_applied = FALSE;
		if ($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL)
		{
			$constraint_will_be_applied = TRUE;
		}

		foreach ($characteristicsValues as $characteristicsValue)
		{
			if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove'))
			{
				continue;
			}

			if ($characteristicsValue['c_name'] == 'base_score')
			{
				echo 'base_score = ';
				echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
				echo '<br/>';
				echo '<br/>';
			}

			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec'))
			{
				if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year')
				{
					echo 'year_rec = ';
					$year = date('Y');
					echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
					echo '<br/>';
					echo '<br/>';
				}
				else
				{
					$this->score = (float) $this->score + 0.0;
					echo '<br/>';
					echo '<br/>';
				}
			}
			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies'))
			{
				if (isset($AssetInformatoin[0]['FormatType']['copies']))
				{
					echo 'copies = ';
					echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
					$this->score = (float) $this->score + (float) $copies;
					echo '<br/>';
					echo '<br/>';
				}
			}

			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome'))
			{

				if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome']))
				{
					echo 'softBinderSyndrome = ';
					echo $softBinderSyndrome = (($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
					$this->score = (float) $this->score + (float) $softBinderSyndrome;
					echo '<br/>';
					echo '<br/>';
				}
			}


			if ( ! $constraint_will_be_applied)
			{
				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'off_brand'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['off_brand']))
					{
						echo 'off_brand = ';
						echo $off_brand = (($AssetInformatoin[0]['FormatType']['off_brand'] != '' && $AssetInformatoin[0]['FormatType']['off_brand'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
						echo '<br/>';
						$this->score = (float) $this->score + (float) $off_brand;
						echo '<br/>';
						echo '<br/>';
					}
				}


				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus'))
				{
					echo 'fungus = ';
					if (isset($AssetInformatoin[0]['FormatType']['fungus']))
					{
						echo $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + $fungus;
						echo '<br/>';
						echo '<br/>';
					}
				}


				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['other_contaminants']))
					{
						echo 'other_contaminants = ';
						echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + $other_contaminants;
						echo '<br/>';
						echo '<br/>';
					}
				}



				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['recordingStandard']))
					{
						if (strstr(strtolower($this->multiselection_value['NewrecordingStandard'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'recordingStandard = ';
							echo $recordingStandard = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $recordingStandard;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}


				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'scanning'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['scanning']))
					{
						if (strstr(strtolower($this->multiselection_value['scanning'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'scanning = ';
							echo $scanning = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $scanning;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}


				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'formatVersion'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['formatVersion']))
					{
						if (strstr(strtolower($this->multiselection_value['HDCAMformatVersion'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'VHSformatVersion = ';
							echo $VHSformatVersion = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $VHSformatVersion;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}


				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['pack_deformation']))
					{
						if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'pack_deformation = ';
							echo $pack_deformation = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $pack_deformation;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}
			}
		}
		return $this->score;
	}

	/**
	 * DVCPro Score Calculator
	 * @param Array $AssetInformatoin
	 * @param Array $characteristicsValues
	 * 
	 * 
	 * @return int $CaliculatedScore
	 */
	public function DVCProCalc($AssetInformatoin = array(), $characteristicsValues = array())
	{


		foreach ($characteristicsValues as $characteristicsValue)
		{
			if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove'))
			{
				continue;
			}

			if ($characteristicsValue['c_name'] == 'base_score')
			{
				echo 'base_score = ';
				echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
				echo '<br/>';
				echo '<br/>';
			}

			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec'))
			{
				if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year')
				{
					echo 'year_rec = ';
					$year = date('Y');
					echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
					echo '<br/>';
					echo '<br/>';
				}
				else
				{
					$this->score = (float) $this->score + 0.0;
					echo '<br/>';
					echo '<br/>';
				}
			}
			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies'))
			{
				if (isset($AssetInformatoin[0]['FormatType']['copies']))
				{
					echo 'copies = ';
					echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
					$this->score = (float) $this->score + (float) $copies;
					echo '<br/>';
					echo '<br/>';
				}
			}




			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'off_brand'))
			{
				if (isset($AssetInformatoin[0]['FormatType']['off_brand']))
				{
					echo 'off_brand = ';
					echo $off_brand = (($AssetInformatoin[0]['FormatType']['off_brand'] != '' && $AssetInformatoin[0]['FormatType']['off_brand'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
					echo '<br/>';
					$this->score = (float) $this->score + (float) $off_brand;
					echo '<br/>';
					echo '<br/>';
				}
			}


			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus'))
			{
				echo 'fungus = ';
				if (isset($AssetInformatoin[0]['FormatType']['fungus']))
				{
					echo $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
					$this->score = (float) $this->score + $fungus;
					echo '<br/>';
					echo '<br/>';
				}
			}


			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants'))
			{
				if (isset($AssetInformatoin[0]['FormatType']['other_contaminants']))
				{
					echo 'other_contaminants = ';
					echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
					$this->score = (float) $this->score + $other_contaminants;
					echo '<br/>';
					echo '<br/>';
				}
			}




			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'formatVersion'))
			{

				if (isset($AssetInformatoin[0]['FormatType']['formatVersion']))
				{
					$formatVersion_array = explode(',', $AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]);

					foreach ($formatVersion_array as $formatVersion_one)
					{
						if (strstr(strtolower($this->multiselection_value['DVCProformatVersion'][$formatVersion_one]), strtolower($characteristicsValue['c_name'])))
						{
							var_dump($this->multiselection_value['DVCProformatVersion'][$formatVersion_one]);
							echo 'formatVersion = ';
							echo $formatVersion = $characteristicsValue['c_score'];

							$this->score = (float) $this->score + (float) $formatVersion;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}
			}
			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard'))
			{
				if (isset($AssetInformatoin[0]['FormatType']['recordingStandard']))
				{
					if (strstr(strtolower($this->multiselection_value['NewrecordingStandard'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
					{
						echo 'recordingStandard = ';
						echo $recordingStandard = $characteristicsValue['c_score'];
						$this->score = (float) $this->score + (float) $recordingStandard;
						echo '<br/>';
						echo '<br/>';
					}
				}
			}


			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome'))
			{

				if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome']))
				{
					echo 'softBinderSyndrome = ';
					echo $softBinderSyndrome = (($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
					$this->score = (float) $this->score + (float) $softBinderSyndrome;
					echo '<br/>';
					echo '<br/>';
				}
			}



			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'size'))
			{
				if (isset($AssetInformatoin[0]['FormatType']['size']))
				{
					if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
					{
						echo 'size = ';
						echo $size = $characteristicsValue['c_score'];
						$this->score = (float) $this->score + (float) $size;
						echo '<br/>';
						echo '<br/>';
					}
				}
			}


			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingSpeed'))
			{
				if (isset($AssetInformatoin[0]['FormatType']['recordingSpeed']))
				{
					if (strstr(strtolower($this->multiselection_value['DVCProrecordingSpeed'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
					{
						echo 'recordingSpeed = ';
						echo $recordingSpeed = $characteristicsValue['c_score'];
						$this->score = (float) $this->score + (float) $recordingSpeed;
						echo '<br/>';
						echo '<br/>';
					}
				}
			}



			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation'))
			{
				if (isset($AssetInformatoin[0]['FormatType']['pack_deformation']))
				{
					if (strstr(strtolower($this->multiselection_value['NewPack_deformation'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
					{
						echo 'pack_deformation = ';
						echo $pack_deformation = $characteristicsValue['c_score'];
						$this->score = (float) $this->score + (float) $pack_deformation;
						echo '<br/>';
						echo '<br/>';
					}
				}
			}
		}
		return $this->score;
	}

	/**
	 * OpenReelVideoHalf Score Calculator
	 * @param Array $AssetInformatoin
	 * @param Array $characteristicsValues
	 * 
	 * 
	 * @return int $CaliculatedScore
	 */
	public function OpenReelVideoHalfCalc($AssetInformatoin = array(), $characteristicsValues = array())
	{
		$constraint_will_be_applied = FALSE;
		if ($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL)
		{
			$constraint_will_be_applied = TRUE;
		}
		foreach ($characteristicsValues as $characteristicsValue)
		{
			if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove'))
			{
				continue;
			}

			if ($characteristicsValue['c_name'] == 'base_score')
			{
				echo 'base_score = ';
				echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
				echo '<br/>';
				echo '<br/>';
			}

			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec'))
			{
				if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year')
				{
					echo 'year_rec = ';
					$year = date('Y');
					echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
					echo '<br/>';
					echo '<br/>';
				}
				else
				{
					$this->score = (float) $this->score + 0.0;
					echo '<br/>';
					echo '<br/>';
				}
			}

			if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies'))
			{
				if (isset($AssetInformatoin[0]['FormatType']['copies']))
				{
					echo 'copies = ';
					echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
					$this->score = (float) $this->score + (float) $copies;
					echo '<br/>';
					echo '<br/>';
				}
			}
			if ( ! $constraint_will_be_applied)
			{
				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'off_brand'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['off_brand']))
					{
						echo 'off_brand = ';
						echo $off_brand = (($AssetInformatoin[0]['FormatType']['off_brand'] != '' && $AssetInformatoin[0]['FormatType']['off_brand'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
						echo '<br/>';
						$this->score = (float) $this->score + (float) $off_brand;
						echo '<br/>';
						echo '<br/>';
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus'))
				{
					echo 'fungus = ';
					if (isset($AssetInformatoin[0]['FormatType']['fungus']))
					{
						echo $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + $fungus;
						echo '<br/>';
						echo '<br/>';
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['other_contaminants']))
					{
						echo 'other_contaminants = ';
						echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + $other_contaminants;
						echo '<br/>';
						echo '<br/>';
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'format'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['format']))
					{
						if (strstr(strtolower($this->multiselection_value['OpenReelVideoHALFformatVersion'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'formatVersion = ';
							echo $formatVersion = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $formatVersion;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}


				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['recordingStandard']))
					{
						if (strstr(strtolower($this->multiselection_value['NewrecordingStandard'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'recordingStandard = ';
							echo $recordingStandard = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $recordingStandard;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}

				
				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome'))
				{

					if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome']))
					{
						echo 'softBinderSyndrome = ';
						echo $softBinderSyndrome = (($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
						$this->score = (float) $this->score + (float) $softBinderSyndrome;
						echo '<br/>';
						echo '<br/>';
					}
				}
				

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'reelSize'))
				{

					if (isset($AssetInformatoin[0]['FormatType']['reelSize']))
					{
						$reelSize_array = explode(',', $AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]);

						foreach ($reelSize_array as $reelSize_one)
						{

							if (strstr(strtolower($this->multiselection_value['HalfInchReelSize'][$reelSize_one]), strtolower($characteristicsValue['c_name'])))
							{
								echo 'reelSize = ';
								echo $reelSize = $characteristicsValue['c_score'];
								$this->score = (float) $this->score + (float) $reelSize;
								echo '<br/>';
								echo '<br/>';
							}
						}
					}
				}

				if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation'))
				{
					if (isset($AssetInformatoin[0]['FormatType']['pack_deformation']))
					{
						if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])))
						{
							echo 'pack_deformation = ';
							echo $pack_deformation = $characteristicsValue['c_score'];
							$this->score = (float) $this->score + (float) $pack_deformation;
							echo '<br/>';
							echo '<br/>';
						}
					}
				}
			}
		}

		return $this->score;
	}

}

?>
