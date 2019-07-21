<?php
    if (!defined('WEB_ROOT')) {
    	exit;
    }
    $id=$_GET['id'];
    $mydb->setQuery("select *, roomName, firstname, lastname, roomImage, address from reservation re, room ro, guest gu  where re.roomNo = ro.roomNo and re.guest_id = gu.guest_id and reservation_id = ".$id);
    $cur = $mydb->loadSingleResult();
    $image = WEB_ROOT . 'admin/mod_room/'.$cur->roomImage;	
?>
<div class="panel panel-primary">
    <div class="panel-body">
        <table class="table table-hover" border="0">
            <caption>
                <h3 align="left">Детайли за резервация</h3>
            </caption>
            <tr>
                <td width="80"><img src="<?php echo $image; ?>" width="300" height="300" title="<?php ?>"/></td>
                <td>
                    <p>
                        <strong>Име: </strong><?php echo $cur->firstname; ?><br/>
                        <strong>Фамилия: </strong><?php echo $cur->lastname;?><br/>
                        <strong>Телефон: </strong><?php echo $cur->phone;?><br/>
                        <strong>Имейл: </strong><?php echo $cur->email;?><br/>
                        <strong>Пристигане: </strong><?php echo $cur->arrival;?><br/>
                        <strong>Тръгване: </strong><?php echo $cur->departure; ?><br/>
                        <b><h4>Статус: </h4></b>
						<h4><i>
							<?php 
								switch($cur->status)
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
						</i></h4>
                    </p>
                    <?php 
                        $stat = $cur->status;
                        if($stat == 'pending'){
					?>
                    <a href="index.php?view=list" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span>  Назад</a>
                    <a href="controller.php?action=confirm&res_id=<?php echo $cur->reservation_id; ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span>  Потвърди</a>
					<?php 
                        } elseif ($stat == 'Confirmed'){
					?>
                    <a href="index.php?view=list" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span>  Назад</a>
                    <a href="controller.php?action=cancel&res_id=<?php echo $cur->reservation_id; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-plus-sign"></span>  Откажи</a>
                    <?php
                        } else {
					?>
                    <a href="index.php?view=list" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span>  Назад</a>
                    <?php
                        }
                    ?>
                </td>
            </tr>
        </table>
    </div>
</div>