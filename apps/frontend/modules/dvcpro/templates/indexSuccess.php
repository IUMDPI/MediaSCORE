<h1>Dvc pros List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Quantity</th>
      <th>Generation</th>
      <th>Year recorded</th>
      <th>Copies</th>
      <th>Stock brand</th>
      <th>Off brand</th>
      <th>Fungus</th>
      <th>Other contaminants</th>
      <th>Duration</th>
      <th>Duration type</th>
      <th>Type</th>
      <th>Material</th>
      <th>Oxidation corrosion</th>
      <th>Pack deformation</th>
      <th>Noise reduction</th>
      <th>Tape type</th>
      <th>Thin tape</th>
      <th>Slow speed</th>
      <th>Sound field</th>
      <th>Soft binder syndrome</th>
      <th>Gauge</th>
      <th>Color</th>
      <th>Color fade</th>
      <th>Soundtrack format</th>
      <th>Substrate</th>
      <th>Strong odor</th>
      <th>Vinegar odor</th>
      <th>Ad strip level</th>
      <th>Shrinkage</th>
      <th>Level of shrinkage</th>
      <th>Rust</th>
      <th>Discoloration</th>
      <th>Surface blistering bubbling</th>
      <th>Thin tape</th>
      <th>1993 or earlier</th>
      <th>Data grade tape</th>
      <th>Long play32 k96 k</th>
      <th>Corrosion rust oxidation</th>
      <th>Composition</th>
      <th>Non standard brand</th>
      <th>Track configuration</th>
      <th>Tape thickness</th>
      <th>Speed</th>
      <th>Soft binder syndrome</th>
      <th>Materials breakdown</th>
      <th>Physical damage</th>
      <th>Delamination</th>
      <th>Plasticizer exudation</th>
      <th>Recording layer</th>
      <th>Recording speed</th>
      <th>Cylinder type</th>
      <th>Reflective layer</th>
      <th>Data layer</th>
      <th>Optical disc type</th>
      <th>Format</th>
      <th>Recording standard</th>
      <th>Publication year</th>
      <th>Capacity layers</th>
      <th>Codec</th>
      <th>Data rate</th>
      <th>Shedding soft binder</th>
      <th>Format version</th>
      <th>Oxide</th>
      <th>Binder system</th>
      <th>Reel size</th>
      <th>White residue</th>
      <th>Size</th>
      <th>Format typed video recording format</th>
      <th>Bitrate</th>
      <th>Scanning</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($dvc_pros as $dvc_pro): ?>
    <tr>
      <td><a href="<?php echo url_for('dvcpro/show?id='.$dvc_pro->getId()) ?>"><?php echo $dvc_pro->getId() ?></a></td>
      <td><?php echo $dvc_pro->getQuantity() ?></td>
      <td><?php echo $dvc_pro->getGeneration() ?></td>
      <td><?php echo $dvc_pro->getYearRecorded() ?></td>
      <td><?php echo $dvc_pro->getCopies() ?></td>
      <td><?php echo $dvc_pro->getStockBrand() ?></td>
      <td><?php echo $dvc_pro->getOffBrand() ?></td>
      <td><?php echo $dvc_pro->getFungus() ?></td>
      <td><?php echo $dvc_pro->getOtherContaminants() ?></td>
      <td><?php echo $dvc_pro->getDuration() ?></td>
      <td><?php echo $dvc_pro->getDurationType() ?></td>
      <td><?php echo $dvc_pro->getType() ?></td>
      <td><?php echo $dvc_pro->getMaterial() ?></td>
      <td><?php echo $dvc_pro->getOxidationCorrosion() ?></td>
      <td><?php echo $dvc_pro->getPackDeformation() ?></td>
      <td><?php echo $dvc_pro->getNoiseReduction() ?></td>
      <td><?php echo $dvc_pro->getTapeType() ?></td>
      <td><?php echo $dvc_pro->getThinTape() ?></td>
      <td><?php echo $dvc_pro->getSlowSpeed() ?></td>
      <td><?php echo $dvc_pro->getSoundField() ?></td>
      <td><?php echo $dvc_pro->getSoftBinderSyndrome() ?></td>
      <td><?php echo $dvc_pro->getGauge() ?></td>
      <td><?php echo $dvc_pro->getColor() ?></td>
      <td><?php echo $dvc_pro->getColorFade() ?></td>
      <td><?php echo $dvc_pro->getSoundtrackFormat() ?></td>
      <td><?php echo $dvc_pro->getSubstrate() ?></td>
      <td><?php echo $dvc_pro->getStrongOdor() ?></td>
      <td><?php echo $dvc_pro->getVinegarOdor() ?></td>
      <td><?php echo $dvc_pro->getADStripLevel() ?></td>
      <td><?php echo $dvc_pro->getShrinkage() ?></td>
      <td><?php echo $dvc_pro->getLevelOfShrinkage() ?></td>
      <td><?php echo $dvc_pro->getRust() ?></td>
      <td><?php echo $dvc_pro->getDiscoloration() ?></td>
      <td><?php echo $dvc_pro->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $dvc_pro->getThinTape() ?></td>
      <td><?php echo $dvc_pro->get1993OrEarlier() ?></td>
      <td><?php echo $dvc_pro->getDataGradeTape() ?></td>
      <td><?php echo $dvc_pro->getLongPlay32K96K() ?></td>
      <td><?php echo $dvc_pro->getCorrosionRustOxidation() ?></td>
      <td><?php echo $dvc_pro->getComposition() ?></td>
      <td><?php echo $dvc_pro->getNonStandardBrand() ?></td>
      <td><?php echo $dvc_pro->getTrackConfiguration() ?></td>
      <td><?php echo $dvc_pro->getTapeThickness() ?></td>
      <td><?php echo $dvc_pro->getSpeed() ?></td>
      <td><?php echo $dvc_pro->getSoftBinderSyndrome() ?></td>
      <td><?php echo $dvc_pro->getMaterialsBreakdown() ?></td>
      <td><?php echo $dvc_pro->getPhysicalDamage() ?></td>
      <td><?php echo $dvc_pro->getDelamination() ?></td>
      <td><?php echo $dvc_pro->getPlasticizerExudation() ?></td>
      <td><?php echo $dvc_pro->getRecordingLayer() ?></td>
      <td><?php echo $dvc_pro->getRecordingSpeed() ?></td>
      <td><?php echo $dvc_pro->getCylinderType() ?></td>
      <td><?php echo $dvc_pro->getReflectiveLayer() ?></td>
      <td><?php echo $dvc_pro->getDataLayer() ?></td>
      <td><?php echo $dvc_pro->getOpticalDiscType() ?></td>
      <td><?php echo $dvc_pro->getFormat() ?></td>
      <td><?php echo $dvc_pro->getRecordingStandard() ?></td>
      <td><?php echo $dvc_pro->getPublicationYear() ?></td>
      <td><?php echo $dvc_pro->getCapacityLayers() ?></td>
      <td><?php echo $dvc_pro->getCodec() ?></td>
      <td><?php echo $dvc_pro->getDataRate() ?></td>
      <td><?php echo $dvc_pro->getSheddingSoftBinder() ?></td>
      <td><?php echo $dvc_pro->getFormatVersion() ?></td>
      <td><?php echo $dvc_pro->getOxide() ?></td>
      <td><?php echo $dvc_pro->getBinderSystem() ?></td>
      <td><?php echo $dvc_pro->getReelSize() ?></td>
      <td><?php echo $dvc_pro->getWhiteResidue() ?></td>
      <td><?php echo $dvc_pro->getSize() ?></td>
      <td><?php echo $dvc_pro->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $dvc_pro->getBitrate() ?></td>
      <td><?php echo $dvc_pro->getScanning() ?></td>
      <td><?php echo $dvc_pro->getCreatedAt() ?></td>
      <td><?php echo $dvc_pro->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('dvcpro/new') ?>">New</a>
