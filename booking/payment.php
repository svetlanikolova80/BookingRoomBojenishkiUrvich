<?php
    $arival = $_SESSION['from']; 
    $departure = $_SESSION['to'];
    $name = $_SESSION['name']; 
    $last = $_SESSION['last'];    
    $city  = $_SESSION['city'] ;
    $address = $_SESSION['address'];    
    $phone = $_SESSION['phone'];
    $email = $_SESSION['email'];    
    $roomid = $_SESSION['roomid'];
    $_SESSION['pending'] = 'pending';
    $stat = $_SESSION['pending'];
    $days = dateDiff($arival,$departure);
    
    if(isset($_POST['btnsubmitbooking'])){
    	$message = $_POST['message'];
    }
    
    function createRandomPassword() {
    
    	$chars = "abcdefghijkmnopqrstuvwxyz023456789";
    	srand((double)microtime()*1000000);
    	$i = 0;
    	$pass = '';
    	
    	while ($i <= 7) {
    		$num = rand() % 33;
    		$tmp = substr($chars, $num, 1);
    		$pass = $pass . $tmp;
    		$i++;
    	}
    
    	return $pass;
    }
    
    $confirmation = createRandomPassword();
    $_SESSION['confirmation'] = $confirmation;
    $mydb->setQuery("select * from room where roomNo={$roomid}");
    
    $rmprice = $mydb->executeQuery();
    
    while($row = mysql_fetch_assoc($rmprice)){
    	$rate = $row['price']; 
    }  
    
    $payable= $rate * $days;
    $_SESSION['pay'] = $payable;
    
    $mydb->setQuery("select * from  guest where  `phone` ='{$phone}' or email='{$email}'");
    
    $cur = $mydb->executeQuery();
    $row_count = $mydb->num_rows($cur);
    if ($row_count >= 1) {
    
    	$rows = $mydb->fetch_array($cur);
    	$lastguest= $rows['guest_id'];
    
    	$mydb->setQuery("update guest set firstname='$name', lastname='$last', city='$city', address='$address', phone='$phone', email='$email' 
    					  where guest_id='$lastguest'");
    	$res = $mydb->executeQuery();
    } else {
    	$mydb->setQuery("insert into guest (firstname, lastname, city, address, phone, email)
						values ('$name','$last', '$city','$address','$phone','$email')");
    	$res = $mydb->executeQuery();
    	$lastguest = mysql_insert_id(); 	   
    }
    
    $mydb->setQuery("insert into reservation (roomNo, guest_id, arrival, departure, payable, status, confirmation)
					values ('$roomid','$lastguest','$arival','$departure', '$payable', '$stat', '$confirmation')");
    $res = $mydb->executeQuery();
    $lastreserv = mysql_insert_id(); 
   
	message("Успешно създаден: [". $name ."]", "success");
    
    redirect("index.php?view=detail");
    ?>
<div class="container">
    <?php include'../sidebar.php';?>
    <div class="col-xs-12 col-sm-9">
        <div class="jumbotron">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <td valign="top" class="body" style="padding-bottom:10px;">
                            <form action="index.php?view=payment" method="post"  name="personal" >
                                <fieldset >
									<legend>
										<h2>Детайли за заплащане</h2>
									</legend>
									<p>
										<strong>Име:</strong> <?php echo $name;?> <br/>
										<strong>Фамилия:</strong> <?php echo $last;?><br/>
										<strong>Държава:</strong> <?php echo $country;?><br/>
										<strong>Град:</strong> <?php  echo $city;?><br/>
										<strong>Адрес:</strong> <?php echo $address;?><br/>
										<strong>Пощенски код:</strong> <?php echo $zip; ?><br/>
										<strong>Телефон:</strong> <?php echo $phone;?><br/>
										<strong>Email:</strong> <?php echo $email;?><br/>
									</p>
									<table class="table table-hover">
										<thead>
											<tr  bgcolor="#999999">
												<th width="10">#</th>
												<th align="center" width="120">Тип стая</th>
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
												$mydb->setQuery("select *, typeName from room ro, roomtype rt where ro.typeID = rt.typeID and roomNo =". $_SESSION['roomid']);
												$cur = $mydb->loadResultList();
												
												foreach ($cur as $result) {
													echo '<tr>'; 
													echo '<td></td>';
													echo '<td>'. $result->typeName.'</td>';
													echo '<td>'.$arival.'</td>';
													echo '<td>'.$departure.'</td>';
													echo '<td>'.$days.'</td>';
													echo '<td >Цена '. $result->price.'</td>';
													echo '<td >1</td>';
													echo '<td >Цена '. $result->price.'</td>';
													echo '</tr>';
												} 

												$payable= $result->price *$days;
												$_SESSION['pay']= $payable;
											?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="6"></td>
												<td align="right">
													<h5><b>Тотал: </b></h5>
												<td align="left">
													<h5><b> <?php echo 'Php '.$payable= $days*$result->price; ?></b></h5>
												</td>
											</tr>
											<tr>
											</tr>
										</tfoot>
									</table>									
									<div class="form-group">
										<div class="col-md-12">
											<div class="col-md-10">
												<button type="submit" class="btn btn-primary" align="right" name="btnsubmitbooking">Резервирай</button>
											</div>
										</div>
									</div>
								</fieldset>	
							</form>	
						</td>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>