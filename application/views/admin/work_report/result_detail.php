<table class="table table-striped table-hover">
	<tr>
		<th width="30%">ID</th> <td width="1px">: </td>
		<td><span class="label label-danger">#<?php echo $item->id; ?></span></td>
	</tr>
	<tr>
		<th width="30%">Departement</th> <td width="1px">: </td>
		<td><?php echo $item->departement; ?></td>
	</tr>
	<tr>
		<th width="30%">User Complain</th> <td width="1px">: </td>
		<td><?php echo $item->user_complain; ?></td>
	</tr>
	<tr>
		<th width="30%">Problem</th> <td width="1px">: </td>
		<td><?php echo $item->problem; ?></td>
	</tr>
	<tr>
		<th width="30%">Progress</th> <td width="1px">: </td>
		<td><?php echo $item->progress; ?></td>
	</tr>
	<tr>
		<th width="30%">Time</th> <td width="1px">: </td>
		<td><?php echo $item->time; ?></td>
	</tr>
	<tr>
		<th width="30%">Created by</th> <td width="1px">: </td>
		<td><?php echo $item->created_by; ?></td>
	</tr>
	<tr>
		<th width="30%">Created date</th> <td width="1px">: </td>
		<td><?php echo $item->created_date; ?></td>
	</tr>
	<tr>
		<th width="30%">Image before</th> <td width="1px">: </td>
		<td><img src="<?php echo base_url('/assets/images/'.$item->img_before); ?>" width="100"></td>
	</tr>
	<tr>
		<th width="30%">Image after</th> <td width="1px">: </td>
		<td><img src="<?php echo base_url('/assets/images/'.$item->img_after); ?>" width="100"></td>
	</tr>
</table>