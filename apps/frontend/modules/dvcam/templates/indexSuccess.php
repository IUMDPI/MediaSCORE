<h1>Dv cams List</h1>

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
    <?php foreach ($dv_cams as $dv_cam): ?>
    <tr>
      <td><a href="<?php echo url_for('dvcam/show?id='.$dv_cam->getId()) ?>"><?php echo $dv_cam->getId() ?></a></td>
      <td><?php echo $dv_cam->getQuantity() ?></td>
      <td><?php echo $dv_cam->getGeneration() ?></td>
      <td><?php echo $dv_cam->getYearRecorded() ?></td>
      <td><?php echo $dv_cam->getCopies() ?></td>
      <td><?php echo $dv_cam->getStockBrand() ?></td>
      <td><?php echo $dv_cam->getOffBrand() ?></td>
      <td><?php echo $dv_cam->getFungus() ?></td>
      <td><?php echo $dv_cam->getOtherContaminants() ?></td>
      <td><?php echo $dv_cam->getDuration() ?></td>
      <td><?php echo $dv_cam->getDurationType() ?></td>
      <td><?php echo $dv_cam->getType() ?></td>
      <td><?php echo $dv_cam->getMaterial() ?></td>
      <td><?php echo $dv_cam->getOxidationCorrosion() ?></td>
      <td><?php echo $dv_cam->getPackDeformation() ?></td>
      <td><?php echo $dv_cam->getNoiseReduction() ?></td>
      <td><?php echo $dv_cam->getTapeType() ?></td>
      <td><?php echo $dv_cam->getThinTape() ?></td>
      <td><?php echo $dv_cam->getSlowSpeed() ?></td>
      <td><?php echo $dv_cam->getSoundField() ?></td>
      <td><?php echo $dv_cam->getSoftBinderSyndrome() ?></td>
      <td><?php echo $dv_cam->getGauge() ?></td>
      <td><?php echo $dv_cam->getColor() ?></td>
      <td><?php echo $dv_cam->getColorFade() ?></td>
      <td><?php echo $dv_cam->getSoundtrackFormat() ?></td>
      <td><?php echo $dv_cam->getSubstrate() ?></td>
      <td><?php echo $dv_cam->getStrongOdor() ?></td>
      <td><?php echo $dv_cam->getVinegarOdor() ?></td>
      <td><?php echo $dv_cam->getADStripLevel() ?></td>
      <td><?php echo $dv_cam->getShrinkage() ?></td>
      <td><?php echo $dv_cam->getLevelOfShrinkage() ?></td>
      <td><?php echo $dv_cam->getRust() ?></td>
      <td><?php echo $dv_cam->getDiscoloration() ?></td>
      <td><?php echo $dv_cam->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $dv_cam->getThinTape() ?></td>
      <td><?php echo $dv_cam->get1993OrEarlier() ?></td>
      <td><?php echo $dv_cam->getDataGradeTape() ?></td>
      <td><?php echo $dv_cam->getLongPlay32K96K() ?></td>
      <td><?php echo $dv_cam->getCorrosionRustOxidation() ?></td>
      <td><?php echo $dv_cam->getComposition() ?></td>
      <td><?php echo $dv_cam->getNonStandardBrand() ?></td>
      <td><?php echo $dv_cam->getTrackConfiguration() ?></td>
      <td><?php echo $dv_cam->getTapeThickness() ?></td>
      <td><?php echo $dv_cam->getSpeed() ?></td>
      <td><?php echo $dv_cam->getSoftBinderSyndrome() ?></td>
      <td><?php echo $dv_cam->getMaterialsBreakdown() ?></td>
      <td><?php echo $dv_cam->getPhysicalDamage() ?></td>
      <td><?php echo $dv_cam->getDelamination() ?></td>
      <td><?php echo $dv_cam->getPlasticizerExudation() ?></td>
      <td><?php echo $dv_cam->getRecordingLayer() ?></td>
      <td><?php echo $dv_cam->getRecordingSpeed() ?></td>
      <td><?php echo $dv_cam->getCylinderType() ?></td>
      <td><?php echo $dv_cam->getReflectiveLayer() ?></td>
      <td><?php echo $dv_cam->getDataLayer() ?></td>
      <td><?php echo $dv_cam->getOpticalDiscType() ?></td>
      <td><?php echo $dv_cam->getFormat() ?></td>
      <td><?php echo $dv_cam->getRecordingStandard() ?></td>
      <td><?php echo $dv_cam->getPublicationYear() ?></td>
      <td><?php echo $dv_cam->getCapacityLayers() ?></td>
      <td><?php echo $dv_cam->getCodec() ?></td>
      <td><?php echo $dv_cam->getDataRate() ?></td>
      <td><?php echo $dv_cam->getSheddingSoftBinder() ?></td>
      <td><?php echo $dv_cam->getFormatVersion() ?></td>
      <td><?php echo $dv_cam->getOxide() ?></td>
      <td><?php echo $dv_cam->getBinderSystem() ?></td>
      <td><?php echo $dv_cam->getReelSize() ?></td>
      <td><?php echo $dv_cam->getWhiteResidue() ?></td>
      <td><?php echo $dv_cam->getSize() ?></td>
      <td><?php echo $dv_cam->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $dv_cam->getBitrate() ?></td>
      <td><?php echo $dv_cam->getScanning() ?></td>
      <td><?php echo $dv_cam->getCreatedAt() ?></td>
      <td><?php echo $dv_cam->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('dvcam/new') ?>">New</a>
