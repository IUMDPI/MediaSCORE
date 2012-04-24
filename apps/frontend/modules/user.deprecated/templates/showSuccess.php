<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $user->getId() ?></td>
    </tr>
    <tr>
      <th>First name:</th>
      <td><?php echo $user->getFirstName() ?></td>
    </tr>
    <tr>
      <th>Last name:</th>
      <td><?php echo $user->getLastName() ?></td>
    </tr>
    <tr>
      <th>Password:</th>
      <td><?php echo $user->getPassword() ?></td>
    </tr>
    <tr>
      <th>Email:</th>
      <td><?php echo $user->getEmail() ?></td>
    </tr>
    <tr>
      <th>Phone:</th>
      <td><?php echo $user->getPhone() ?></td>
    </tr>
    <tr>
      <th>Role:</th>
      <td><?php echo $user->getRole() ?></td>
    </tr>
    <tr>
      <th>Type:</th>
      <td><?php echo $user->getType() ?></td>
    </tr>
    <tr>
      <th>Contact info:</th>
      <td><?php echo $user->getContactInfo() ?></td>
    </tr>
    <tr>
      <th>Unit:</th>
      <td><?php echo $user->getUnitId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $user->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $user->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('user/edit?id='.$user->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('user/index') ?>">List</a>
