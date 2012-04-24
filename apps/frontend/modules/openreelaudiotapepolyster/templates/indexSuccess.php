<h1>Open reel audiotape polysters List</h1>

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
    <?php foreach ($open_reel_audiotape_polysters as $open_reel_audiotape_polyster): ?>
    <tr>
      <td><a href="<?php echo url_for('openreelaudiotapepolyster/show?id='.$open_reel_audiotape_polyster->getId()) ?>"><?php echo $open_reel_audiotape_polyster->getId() ?></a></td>
      <td><?php echo $open_reel_audiotape_polyster->getQuantity() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getGeneration() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getYearRecorded() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getCopies() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getStockBrand() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getOffBrand() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getFungus() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getOtherContaminants() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getDuration() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getDurationType() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getType() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getMaterial() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getOxidationCorrosion() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getPackDeformation() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getNoiseReduction() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getTapeType() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getThinTape() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getSlowSpeed() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getSoundField() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getSoftBinderSyndrome() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getGauge() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getColor() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getColorFade() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getSoundtrackFormat() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getSubstrate() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getStrongOdor() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getVinegarOdor() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getADStripLevel() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getShrinkage() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getLevelOfShrinkage() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getRust() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getDiscoloration() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getThinTape() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->get1993OrEarlier() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getDataGradeTape() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getLongPlay32K96K() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getCorrosionRustOxidation() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getComposition() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getNonStandardBrand() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getTrackConfiguration() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getTapeThickness() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getSpeed() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getSoftBinderSyndrome() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getMaterialsBreakdown() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getPhysicalDamage() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getDelamination() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getPlasticizerExudation() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getRecordingLayer() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getRecordingSpeed() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getCylinderType() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getReflectiveLayer() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getDataLayer() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getOpticalDiscType() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getFormat() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getRecordingStandard() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getPublicationYear() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getCapacityLayers() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getCodec() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getDataRate() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getSheddingSoftBinder() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getFormatVersion() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getOxide() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getBinderSystem() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getReelSize() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getWhiteResidue() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getSize() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getBitrate() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getScanning() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getCreatedAt() ?></td>
      <td><?php echo $open_reel_audiotape_polyster->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('openreelaudiotapepolyster/new') ?>">New</a>
