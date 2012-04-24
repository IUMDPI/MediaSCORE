<h1>Xd cam opticals List</h1>

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
    <?php foreach ($xd_cam_opticals as $xd_cam_optical): ?>
    <tr>
      <td><a href="<?php echo url_for('xdcamoptical/show?id='.$xd_cam_optical->getId()) ?>"><?php echo $xd_cam_optical->getId() ?></a></td>
      <td><?php echo $xd_cam_optical->getQuantity() ?></td>
      <td><?php echo $xd_cam_optical->getGeneration() ?></td>
      <td><?php echo $xd_cam_optical->getYearRecorded() ?></td>
      <td><?php echo $xd_cam_optical->getCopies() ?></td>
      <td><?php echo $xd_cam_optical->getStockBrand() ?></td>
      <td><?php echo $xd_cam_optical->getOffBrand() ?></td>
      <td><?php echo $xd_cam_optical->getFungus() ?></td>
      <td><?php echo $xd_cam_optical->getOtherContaminants() ?></td>
      <td><?php echo $xd_cam_optical->getDuration() ?></td>
      <td><?php echo $xd_cam_optical->getDurationType() ?></td>
      <td><?php echo $xd_cam_optical->getType() ?></td>
      <td><?php echo $xd_cam_optical->getMaterial() ?></td>
      <td><?php echo $xd_cam_optical->getOxidationCorrosion() ?></td>
      <td><?php echo $xd_cam_optical->getPackDeformation() ?></td>
      <td><?php echo $xd_cam_optical->getNoiseReduction() ?></td>
      <td><?php echo $xd_cam_optical->getTapeType() ?></td>
      <td><?php echo $xd_cam_optical->getThinTape() ?></td>
      <td><?php echo $xd_cam_optical->getSlowSpeed() ?></td>
      <td><?php echo $xd_cam_optical->getSoundField() ?></td>
      <td><?php echo $xd_cam_optical->getSoftBinderSyndrome() ?></td>
      <td><?php echo $xd_cam_optical->getGauge() ?></td>
      <td><?php echo $xd_cam_optical->getColor() ?></td>
      <td><?php echo $xd_cam_optical->getColorFade() ?></td>
      <td><?php echo $xd_cam_optical->getSoundtrackFormat() ?></td>
      <td><?php echo $xd_cam_optical->getSubstrate() ?></td>
      <td><?php echo $xd_cam_optical->getStrongOdor() ?></td>
      <td><?php echo $xd_cam_optical->getVinegarOdor() ?></td>
      <td><?php echo $xd_cam_optical->getADStripLevel() ?></td>
      <td><?php echo $xd_cam_optical->getShrinkage() ?></td>
      <td><?php echo $xd_cam_optical->getLevelOfShrinkage() ?></td>
      <td><?php echo $xd_cam_optical->getRust() ?></td>
      <td><?php echo $xd_cam_optical->getDiscoloration() ?></td>
      <td><?php echo $xd_cam_optical->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $xd_cam_optical->getThinTape() ?></td>
      <td><?php echo $xd_cam_optical->get1993OrEarlier() ?></td>
      <td><?php echo $xd_cam_optical->getDataGradeTape() ?></td>
      <td><?php echo $xd_cam_optical->getLongPlay32K96K() ?></td>
      <td><?php echo $xd_cam_optical->getCorrosionRustOxidation() ?></td>
      <td><?php echo $xd_cam_optical->getComposition() ?></td>
      <td><?php echo $xd_cam_optical->getNonStandardBrand() ?></td>
      <td><?php echo $xd_cam_optical->getTrackConfiguration() ?></td>
      <td><?php echo $xd_cam_optical->getTapeThickness() ?></td>
      <td><?php echo $xd_cam_optical->getSpeed() ?></td>
      <td><?php echo $xd_cam_optical->getSoftBinderSyndrome() ?></td>
      <td><?php echo $xd_cam_optical->getMaterialsBreakdown() ?></td>
      <td><?php echo $xd_cam_optical->getPhysicalDamage() ?></td>
      <td><?php echo $xd_cam_optical->getDelamination() ?></td>
      <td><?php echo $xd_cam_optical->getPlasticizerExudation() ?></td>
      <td><?php echo $xd_cam_optical->getRecordingLayer() ?></td>
      <td><?php echo $xd_cam_optical->getRecordingSpeed() ?></td>
      <td><?php echo $xd_cam_optical->getCylinderType() ?></td>
      <td><?php echo $xd_cam_optical->getReflectiveLayer() ?></td>
      <td><?php echo $xd_cam_optical->getDataLayer() ?></td>
      <td><?php echo $xd_cam_optical->getOpticalDiscType() ?></td>
      <td><?php echo $xd_cam_optical->getFormat() ?></td>
      <td><?php echo $xd_cam_optical->getRecordingStandard() ?></td>
      <td><?php echo $xd_cam_optical->getPublicationYear() ?></td>
      <td><?php echo $xd_cam_optical->getCapacityLayers() ?></td>
      <td><?php echo $xd_cam_optical->getCodec() ?></td>
      <td><?php echo $xd_cam_optical->getDataRate() ?></td>
      <td><?php echo $xd_cam_optical->getSheddingSoftBinder() ?></td>
      <td><?php echo $xd_cam_optical->getFormatVersion() ?></td>
      <td><?php echo $xd_cam_optical->getOxide() ?></td>
      <td><?php echo $xd_cam_optical->getBinderSystem() ?></td>
      <td><?php echo $xd_cam_optical->getReelSize() ?></td>
      <td><?php echo $xd_cam_optical->getWhiteResidue() ?></td>
      <td><?php echo $xd_cam_optical->getSize() ?></td>
      <td><?php echo $xd_cam_optical->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $xd_cam_optical->getBitrate() ?></td>
      <td><?php echo $xd_cam_optical->getScanning() ?></td>
      <td><?php echo $xd_cam_optical->getCreatedAt() ?></td>
      <td><?php echo $xd_cam_optical->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('xdcamoptical/new') ?>">New</a>
