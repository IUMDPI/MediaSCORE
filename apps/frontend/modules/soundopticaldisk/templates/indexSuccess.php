<h1>Sound optical disks List</h1>

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
    <?php foreach ($sound_optical_disks as $sound_optical_disk): ?>
    <tr>
      <td><a href="<?php echo url_for('soundopticaldisk/show?id='.$sound_optical_disk->getId()) ?>"><?php echo $sound_optical_disk->getId() ?></a></td>
      <td><?php echo $sound_optical_disk->getQuantity() ?></td>
      <td><?php echo $sound_optical_disk->getGeneration() ?></td>
      <td><?php echo $sound_optical_disk->getYearRecorded() ?></td>
      <td><?php echo $sound_optical_disk->getCopies() ?></td>
      <td><?php echo $sound_optical_disk->getStockBrand() ?></td>
      <td><?php echo $sound_optical_disk->getOffBrand() ?></td>
      <td><?php echo $sound_optical_disk->getFungus() ?></td>
      <td><?php echo $sound_optical_disk->getOtherContaminants() ?></td>
      <td><?php echo $sound_optical_disk->getDuration() ?></td>
      <td><?php echo $sound_optical_disk->getDurationType() ?></td>
      <td><?php echo $sound_optical_disk->getType() ?></td>
      <td><?php echo $sound_optical_disk->getMaterial() ?></td>
      <td><?php echo $sound_optical_disk->getOxidationCorrosion() ?></td>
      <td><?php echo $sound_optical_disk->getPackDeformation() ?></td>
      <td><?php echo $sound_optical_disk->getNoiseReduction() ?></td>
      <td><?php echo $sound_optical_disk->getTapeType() ?></td>
      <td><?php echo $sound_optical_disk->getThinTape() ?></td>
      <td><?php echo $sound_optical_disk->getSlowSpeed() ?></td>
      <td><?php echo $sound_optical_disk->getSoundField() ?></td>
      <td><?php echo $sound_optical_disk->getSoftBinderSyndrome() ?></td>
      <td><?php echo $sound_optical_disk->getGauge() ?></td>
      <td><?php echo $sound_optical_disk->getColor() ?></td>
      <td><?php echo $sound_optical_disk->getColorFade() ?></td>
      <td><?php echo $sound_optical_disk->getSoundtrackFormat() ?></td>
      <td><?php echo $sound_optical_disk->getSubstrate() ?></td>
      <td><?php echo $sound_optical_disk->getStrongOdor() ?></td>
      <td><?php echo $sound_optical_disk->getVinegarOdor() ?></td>
      <td><?php echo $sound_optical_disk->getADStripLevel() ?></td>
      <td><?php echo $sound_optical_disk->getShrinkage() ?></td>
      <td><?php echo $sound_optical_disk->getLevelOfShrinkage() ?></td>
      <td><?php echo $sound_optical_disk->getRust() ?></td>
      <td><?php echo $sound_optical_disk->getDiscoloration() ?></td>
      <td><?php echo $sound_optical_disk->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $sound_optical_disk->getThinTape() ?></td>
      <td><?php echo $sound_optical_disk->get1993OrEarlier() ?></td>
      <td><?php echo $sound_optical_disk->getDataGradeTape() ?></td>
      <td><?php echo $sound_optical_disk->getLongPlay32K96K() ?></td>
      <td><?php echo $sound_optical_disk->getCorrosionRustOxidation() ?></td>
      <td><?php echo $sound_optical_disk->getComposition() ?></td>
      <td><?php echo $sound_optical_disk->getNonStandardBrand() ?></td>
      <td><?php echo $sound_optical_disk->getTrackConfiguration() ?></td>
      <td><?php echo $sound_optical_disk->getTapeThickness() ?></td>
      <td><?php echo $sound_optical_disk->getSpeed() ?></td>
      <td><?php echo $sound_optical_disk->getSoftBinderSyndrome() ?></td>
      <td><?php echo $sound_optical_disk->getMaterialsBreakdown() ?></td>
      <td><?php echo $sound_optical_disk->getPhysicalDamage() ?></td>
      <td><?php echo $sound_optical_disk->getDelamination() ?></td>
      <td><?php echo $sound_optical_disk->getPlasticizerExudation() ?></td>
      <td><?php echo $sound_optical_disk->getRecordingLayer() ?></td>
      <td><?php echo $sound_optical_disk->getRecordingSpeed() ?></td>
      <td><?php echo $sound_optical_disk->getCylinderType() ?></td>
      <td><?php echo $sound_optical_disk->getReflectiveLayer() ?></td>
      <td><?php echo $sound_optical_disk->getDataLayer() ?></td>
      <td><?php echo $sound_optical_disk->getOpticalDiscType() ?></td>
      <td><?php echo $sound_optical_disk->getFormat() ?></td>
      <td><?php echo $sound_optical_disk->getRecordingStandard() ?></td>
      <td><?php echo $sound_optical_disk->getPublicationYear() ?></td>
      <td><?php echo $sound_optical_disk->getCapacityLayers() ?></td>
      <td><?php echo $sound_optical_disk->getCodec() ?></td>
      <td><?php echo $sound_optical_disk->getDataRate() ?></td>
      <td><?php echo $sound_optical_disk->getSheddingSoftBinder() ?></td>
      <td><?php echo $sound_optical_disk->getFormatVersion() ?></td>
      <td><?php echo $sound_optical_disk->getOxide() ?></td>
      <td><?php echo $sound_optical_disk->getBinderSystem() ?></td>
      <td><?php echo $sound_optical_disk->getReelSize() ?></td>
      <td><?php echo $sound_optical_disk->getWhiteResidue() ?></td>
      <td><?php echo $sound_optical_disk->getSize() ?></td>
      <td><?php echo $sound_optical_disk->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $sound_optical_disk->getBitrate() ?></td>
      <td><?php echo $sound_optical_disk->getScanning() ?></td>
      <td><?php echo $sound_optical_disk->getCreatedAt() ?></td>
      <td><?php echo $sound_optical_disk->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('soundopticaldisk/new') ?>">New</a>
