<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $person->getId() ?></td>
    </tr>
    <tr>
      <th>First name:</th>
      <td><?php echo $person->getFirstName() ?></td>
    </tr>
    <tr>
      <th>Last name:</th>
      <td><?php echo $person->getLastName() ?></td>
    </tr>
    <tr>
      <th>Password:</th>
      <td><?php echo $person->getPassword() ?></td>
    </tr>
    <tr>
      <th>Email:</th>
      <td><?php echo $person->getEmail() ?></td>
    </tr>
    <tr>
      <th>Phone:</th>
      <td><?php echo $person->getPhone() ?></td>
    </tr>
    <tr>
      <th>Role:</th>
      <td><?php echo $person->getRole() ?></td>
    </tr>
    <tr>
      <th>Type:</th>
      <td><?php echo $person->getType() ?></td>
    </tr>
    <tr>
      <th>Contact info:</th>
      <td><?php echo $person->getContactInfo() ?></td>
    </tr>
    <tr>
      <th>Unit:</th>
      <td><?php echo $person->getUnitId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $person->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $person->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('person/edit?id='.$person->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('person/index') ?>">List</a>
