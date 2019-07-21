<?php
    $arrival = $_SESSION['from']; 
    $departure = $_SESSION['to'];
	
	if (!isset($_SESSION['roomid'])){
    	redirect(WEB_ROOT);
    }
	if (isset($_POST['clear'])){
		unset($_SESSION['roomid']);
		redirect(WEB_ROOT);
	}

?>
<div class="container">
    <?php include'../sidebar.php';?>
    <div class="col-xs-12 col-sm-9">
        <div class="jumbotron">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="" method="POST">
                            <h3 align="center">Вашата резервация</h3>
                            <table class="table table-hover">
                                <thead>
                                    <tr  bgcolor="#999999">
                                        <th width="10">#</th>
                                        <th align="center" width="120">Тип</th>
                                        <th align="center" width="120">От</th>
                                        <th align="center" width="120">До</th>
                                        <th align="center" width="120">Нощувки</th>
                                        <th  width="120">Цена</th>
                                        <th align="center" width="120">Стая</th>
                                        <th align="center" width="90">Сума</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $aрrival   = $_SESSION['from']; 
										$departure = $_SESSION['to']; 
										$days = dateDiff($arrival,$departure);
										$mydb->setQuery("select *, typeName from room ro, roomtype rt WHERE ro.typeID = rt.typeID and roomNo =". $_SESSION['roomid']);
										$cur = $mydb->loadResultList();
                                        
                                        foreach ($cur as $result) {
											echo '<tr>'; 
											echo '<td></td>';
											echo '<td>'. $result->typeName.'</td>';
											echo '<td>'.$arrival.'</td>';
											echo '<td>'.$departure.'</td>';
											echo '<td>'.$days.'</td>';
											echo '<td > Цена '. $result->price.'</td>';
											echo '<td >1</td>';
											echo '</tr>';
                                        } 
                                        $payable= $result->price * $days;
                                        $_SESSION['pay'] = $payable;
									?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <h5><b>Тотал: <?php echo $_SESSION['pay'];?></b></h5>
                                        </td>
                                        <td colspan="5">
                                            <div class="col-xs-12 col-sm-12" align="right">
                                                <button type="submit" class="btn btn-primary" align="right"name="clear">Изчисти</button>
                                                <?php
                                                    if (isset($_SESSION['guest_id'])){
											    ?>
                                                <a href="<?php echo WEB_ROOT; ?>booking/index.php?view=payment" class="btn btn-primary" align="right"name="continue">Продължи</a>
                                                <?php 
                                                    } else { 
												?>
                                                <a href="<?php echo WEB_ROOT; ?>booking/index.php?view=info"class="btn btn-primary" align="right"name="continue">Продължи</a>
                                                <?php
                                                    }
												?>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>