<h1>Persons List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>First name</th>
      <th>Last name</th>
      <th>Password</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Role</th>
      <th>Type</th>
      <th>Contact info</th>
      <th>Unit</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($persons as $person): ?>
    <tr>
      <td><a href="<?php echo url_for('person/show?id='.$person->getId()) ?>"><?php echo $person->getId() ?></a></td>
      <td><?php echo $person->getFirstName() ?></td>
      <td><?php echo $person->getLastName() ?></td>
      <td><?php echo $person->getPassword() ?></td>
      <td><?php echo $person->getEmail() ?></td>
      <td><?php echo $person->getPhone() ?></td>
      <td><?php echo $person->getRole() ?></td>
      <td><?php echo $person->getType() ?></td>
      <td><?php echo $person->getContactInfo() ?></td>
      <td><?php echo $person->getUnitId() ?></td>
      <td><?php echo $person->getCreatedAt() ?></td>
      <td><?php echo $person->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('person/new') ?>">New</a>
