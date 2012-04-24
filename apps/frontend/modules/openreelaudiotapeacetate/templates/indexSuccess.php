<h1>Open reel audiotape acetates List</h1>

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
    <?php foreach ($open_reel_audiotape_acetates as $open_reel_audiotape_acetate): ?>
    <tr>
      <td><a href="<?php echo url_for('openreelaudiotapeacetate/show?id='.$open_reel_audiotape_acetate->getId()) ?>"><?php echo $open_reel_audiotape_acetate->getId() ?></a></td>
      <td><?php echo $open_reel_audiotape_acetate->getQuantity() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getGeneration() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getYearRecorded() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getCopies() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getStockBrand() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getOffBrand() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getFungus() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getOtherContaminants() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getDuration() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getDurationType() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getType() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getMaterial() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getOxidationCorrosion() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getPackDeformation() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getNoiseReduction() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getTapeType() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getThinTape() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getSlowSpeed() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getSoundField() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getSoftBinderSyndrome() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getGauge() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getColor() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getColorFade() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getSoundtrackFormat() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getSubstrate() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getStrongOdor() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getVinegarOdor() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getADStripLevel() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getShrinkage() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getLevelOfShrinkage() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getRust() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getDiscoloration() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getThinTape() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->get1993OrEarlier() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getDataGradeTape() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getLongPlay32K96K() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getCorrosionRustOxidation() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getComposition() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getNonStandardBrand() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getTrackConfiguration() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getTapeThickness() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getSpeed() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getSoftBinderSyndrome() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getMaterialsBreakdown() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getPhysicalDamage() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getDelamination() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getPlasticizerExudation() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getRecordingLayer() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getRecordingSpeed() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getCylinderType() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getReflectiveLayer() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getDataLayer() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getOpticalDiscType() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getFormat() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getRecordingStandard() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getPublicationYear() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getCapacityLayers() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getCodec() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getDataRate() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getSheddingSoftBinder() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getFormatVersion() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getOxide() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getBinderSystem() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getReelSize() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getWhiteResidue() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getSize() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getBitrate() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getScanning() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getCreatedAt() ?></td>
      <td><?php echo $open_reel_audiotape_acetate->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('openreelaudiotapeacetate/new') ?>">New</a>
