<div class="container">
<div class="panel panel-primary">
    <div class="panel-body">
        <form  method="post" action="processreservation.php?action=delete">
            <table id="example" class="table table-striped" cellspacing="0">
                <thead>
                    <tr>
                        <td>No</td>                        
                        <td width="90"><strong>Име</strong></td>                        
                        <td width="80"><strong>Потвърждение</strong></td>
                        <td width="80"><strong>Пристигане</strong></td>
                        <td width="70"><strong>Заминаване</strong></td>
                        <td width="80"><strong>Тип</strong></td>
                        <td width="80"><strong>Нощувки</strong></td> 
                        <td width="80"><strong>--- >>> Статус</strong></td>                                          
                        <td width="100"><strong>Действие</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                        $mydb->setQuery("select *, roomName, firstname, lastname
										from reservation re, room ro, guest gu, roomtype rt
										where re.roomNo = ro.roomNo
										and ro.`typeID` = rt.`typeID` 
										and re.guest_id = gu.guest_id");
                        $cur = $mydb->loadResultList();                        				  			
                        foreach ($cur as $result) {
					?>
                    <tr>
                        <td width="5%" align="center"></td>
                        <td><?php echo $result->firstname." ".$result->lastname; ?></td>
                        <td><?php echo $result->confirmation; ?></td>
                        <td><?php echo $result->arrival; ?></td>
                        <td><?php echo $result->departure; ?></td>
                        <td><?php echo $result->typename; ?></td>
                        <td><?php echo dateDiff($result->arrival,$result->departure); ?></td>
                        <td>
							<?php 
								switch($result->status)
								{
									case 'Confirmed':
										echo 'Потвърдена';
										break;
									case 'Checkedin':
										echo 'Започната';
										break;
									case 'Checkedout':
										echo 'Приключила';
										break;
									case 'pending':
										echo 'Чакаща';
										break;
									case 'Cancelled':
										echo 'Отказана';
										break;	
								}							
							?>
						</td>
                        <td>
                            <?php 
                                if($result->status == 'Confirmed'){ 
							?>
                            <a href="index.php?view=view&id=<?php echo $result->reservation_id; ?>" class="btn btn-primary btn-xs" ><i class="icon-edit">Виж</a>
                            <a href="controller.php?action=checkin&id=<?php echo $result->reservation_id; ?>" class="btn btn-danger btn-xs" ><i class="icon-edit">От</a>
                            <?php
                                } elseif($result->status == 'Checkedin') {
							?>
                            <a href="index.php?view=view&id=<?php echo $result->reservation_id; ?>" class="btn btn-primary btn-xs" ><i class="icon-edit">Виж</a>
                            <a href="controller.php?action=checkout&id=<?php echo $result->reservation_id; ?>" class="btn btn-success btn-xs" ><i class="icon-edit">До</a>
                            <?php
                                } else {
							?>
                            <a href="index.php?view=view&id=<?php echo $result->reservation_id; ?>" class="btn btn-primary btn-xs" ><i class="icon-edit">Виж</a>
                            <a href="index.php?view=view&id=<?php echo $result->reservation_id; ?>" class="btn btn-danger btn-xs" disabled="disabled"><i class="icon-edit">От</a>
                            <?php
                                }                                
							?>
                        </td>
					<?php 
						}
					?>
					</tr>
					<div class="modal fade" id="profile" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<div class="alert alert-info">Профил:</div>
								</div>
								
								<form action="#"  method="post">
									<div class="modal-body">
										<div id="display">
											<p>
												
											</p>
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn btn-default" data-dismiss="modal" type="button">Затвори</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				<tbody>
			</table>
		</form>
	</div>
</div>