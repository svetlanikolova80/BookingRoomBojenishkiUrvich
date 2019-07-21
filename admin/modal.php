<div class="modal fade" id="logout" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			</div>
			<div class="modal-body">
				<div class="alert alert-info"><strong>Изход</strong>?</div>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Затвори</button>
				<a href="<?php echo WEB_ROOT; ?>admin/logout.php" class="btn btn-info"><i class="icon-off"></i> Изход</a>
			</div>
		</div>
	</div>
</div>

<div class="modal fade"  id="reservation" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			</div>
			<div class="modal-body">
				<div class="alert alert-info">Детайли за резервация</div>
				<form  method="post" action="processreservation.php?action=delete">
					<?php		
						echo $resid;
					?>
					<p>	
						<strong>Потвърждаване</strong>:<br/>
						<strong>Име</strong><br/>
						<strong>Пристигане</strong><br/>
						<strong>Заминаване</strong><br/>
						<strong>Стая</strong><br/>
						<strong>Тип стая</strong><br/>
						<strong>Нощувки</strong><br/>
						<strong>Статус</strong><br/>
						<strong>Опция</strong><br/>
					</p>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Затвори</button>
				<a href="<?php echo WEB_ROOT; ?>admin/logout.php" class="btn btn-info"><i class="icon-off"></i> Изход</a>
			</div>
		</div>
	</div>
</div>
		