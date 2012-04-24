<h1>Sound wire reels List</h1>

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
    <?php foreach ($sound_wire_reels as $sound_wire_reel): ?>
    <tr>
      <td><a href="<?php echo url_for('soundwirereel/show?id='.$sound_wire_reel->getId()) ?>"><?php echo $sound_wire_reel->getId() ?></a></td>
      <td><?php echo $sound_wire_reel->getQuantity() ?></td>
      <td><?php echo $sound_wire_reel->getGeneration() ?></td>
      <td><?php echo $sound_wire_reel->getYearRecorded() ?></td>
      <td><?php echo $sound_wire_reel->getCopies() ?></td>
      <td><?php echo $sound_wire_reel->getStockBrand() ?></td>
      <td><?php echo $sound_wire_reel->getOffBrand() ?></td>
      <td><?php echo $sound_wire_reel->getFungus() ?></td>
      <td><?php echo $sound_wire_reel->getOtherContaminants() ?></td>
      <td><?php echo $sound_wire_reel->getDuration() ?></td>
      <td><?php echo $sound_wire_reel->getDurationType() ?></td>
      <td><?php echo $sound_wire_reel->getType() ?></td>
      <td><?php echo $sound_wire_reel->getMaterial() ?></td>
      <td><?php echo $sound_wire_reel->getOxidationCorrosion() ?></td>
      <td><?php echo $sound_wire_reel->getPackDeformation() ?></td>
      <td><?php echo $sound_wire_reel->getNoiseReduction() ?></td>
      <td><?php echo $sound_wire_reel->getTapeType() ?></td>
      <td><?php echo $sound_wire_reel->getThinTape() ?></td>
      <td><?php echo $sound_wire_reel->getSlowSpeed() ?></td>
      <td><?php echo $sound_wire_reel->getSoundField() ?></td>
      <td><?php echo $sound_wire_reel->getSoftBinderSyndrome() ?></td>
      <td><?php echo $sound_wire_reel->getGauge() ?></td>
      <td><?php echo $sound_wire_reel->getColor() ?></td>
      <td><?php echo $sound_wire_reel->getColorFade() ?></td>
      <td><?php echo $sound_wire_reel->getSoundtrackFormat() ?></td>
      <td><?php echo $sound_wire_reel->getSubstrate() ?></td>
      <td><?php echo $sound_wire_reel->getStrongOdor() ?></td>
      <td><?php echo $sound_wire_reel->getVinegarOdor() ?></td>
      <td><?php echo $sound_wire_reel->getADStripLevel() ?></td>
      <td><?php echo $sound_wire_reel->getShrinkage() ?></td>
      <td><?php echo $sound_wire_reel->getLevelOfShrinkage() ?></td>
      <td><?php echo $sound_wire_reel->getRust() ?></td>
      <td><?php echo $sound_wire_reel->getDiscoloration() ?></td>
      <td><?php echo $sound_wire_reel->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $sound_wire_reel->getThinTape() ?></td>
      <td><?php echo $sound_wire_reel->get1993OrEarlier() ?></td>
      <td><?php echo $sound_wire_reel->getDataGradeTape() ?></td>
      <td><?php echo $sound_wire_reel->getLongPlay32K96K() ?></td>
      <td><?php echo $sound_wire_reel->getCorrosionRustOxidation() ?></td>
      <td><?php echo $sound_wire_reel->getComposition() ?></td>
      <td><?php echo $sound_wire_reel->getNonStandardBrand() ?></td>
      <td><?php echo $sound_wire_reel->getTrackConfiguration() ?></td>
      <td><?php echo $sound_wire_reel->getTapeThickness() ?></td>
      <td><?php echo $sound_wire_reel->getSpeed() ?></td>
      <td><?php echo $sound_wire_reel->getSoftBinderSyndrome() ?></td>
      <td><?php echo $sound_wire_reel->getMaterialsBreakdown() ?></td>
      <td><?php echo $sound_wire_reel->getPhysicalDamage() ?></td>
      <td><?php echo $sound_wire_reel->getDelamination() ?></td>
      <td><?php echo $sound_wire_reel->getPlasticizerExudation() ?></td>
      <td><?php echo $sound_wire_reel->getRecordingLayer() ?></td>
      <td><?php echo $sound_wire_reel->getRecordingSpeed() ?></td>
      <td><?php echo $sound_wire_reel->getCylinderType() ?></td>
      <td><?php echo $sound_wire_reel->getReflectiveLayer() ?></td>
      <td><?php echo $sound_wire_reel->getDataLayer() ?></td>
      <td><?php echo $sound_wire_reel->getOpticalDiscType() ?></td>
      <td><?php echo $sound_wire_reel->getFormat() ?></td>
      <td><?php echo $sound_wire_reel->getRecordingStandard() ?></td>
      <td><?php echo $sound_wire_reel->getPublicationYear() ?></td>
      <td><?php echo $sound_wire_reel->getCapacityLayers() ?></td>
      <td><?php echo $sound_wire_reel->getCodec() ?></td>
      <td><?php echo $sound_wire_reel->getDataRate() ?></td>
      <td><?php echo $sound_wire_reel->getSheddingSoftBinder() ?></td>
      <td><?php echo $sound_wire_reel->getFormatVersion() ?></td>
      <td><?php echo $sound_wire_reel->getOxide() ?></td>
      <td><?php echo $sound_wire_reel->getBinderSystem() ?></td>
      <td><?php echo $sound_wire_reel->getReelSize() ?></td>
      <td><?php echo $sound_wire_reel->getWhiteResidue() ?></td>
      <td><?php echo $sound_wire_reel->getSize() ?></td>
      <td><?php echo $sound_wire_reel->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $sound_wire_reel->getBitrate() ?></td>
      <td><?php echo $sound_wire_reel->getScanning() ?></td>
      <td><?php echo $sound_wire_reel->getCreatedAt() ?></td>
      <td><?php echo $sound_wire_reel->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('soundwirereel/new') ?>">New</a>
