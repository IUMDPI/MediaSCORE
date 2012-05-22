<td class="sf_admin_date sf_admin_list_td_first_name">
  <?php echo $sf_guard_user->getFirstName() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_last_name">
  <?php echo $sf_guard_user->getLastName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_email_address">
  <?php echo link_to($sf_guard_user->getEmailAddress(), 'sf_guard_user_edit', $sf_guard_user) ?>
</td>

