<table>
    <tbody>
		<tr>
			<th>ID</th>
			<th>Name</th>
		</tr>
		<?php
		foreach ($collection as $key => $value)
		{
			?>	
			<tr>
	            <td><?php echo $value->getId() ?></td>
				<td><?php echo $value->getName() ?></td>
			</tr>
		<?php } ?>




    </tbody>
</table>

