<?php
	$arrival= '';
	$departure= '';
	
	if (isset($_SESSION['from'])){
		$arrival = $_SESSION['from']; 
		$departure = $_SESSION['to'];
	}
	
	if(isset($_POST['btnbook'])){

		if (!isset($_SESSION['from']) || !isset($_SESSION['to'])){
			message("Изберете от и до", "error");
			redirect("index.php?page=1");
		}
		if(isset($_POST['roomid'])){
			$_SESSION['roomid']=$_POST['roomid'];
			redirect(WEB_ROOT. 'booking/');
		}
	}		
?>

<div class="container">
	<?php include'sidebar.php';?>

		<div class="col-xs-12 col-sm-9">
			<div class="jumbotron">
				<div class="">
					<div class="panel panel-default">
						<div class="panel-body">	
							<fieldset>
								<p class="bg-warning">
									<?php 
										echo '<div class="alert alert-info" ><strong>От: '.$arrival. ' До: ' .$departure.'</strong>  </div>';
									?>
								</p>					
							
								<legend><h2 class="text-left">Стаи</h2></legend>
								
								<?php 
									$mydb->setQuery("select *, typeName from room ro, roomtype rt where ro.typeID = rt.typeID");
									$cur = $mydb->loadResultList();
				  			
									foreach ($cur as $result) {
										$mydb->setQuery("select STATUS from reservation
													where (('$arrival' >= arrival and  '$arrival' <= departure)
													or ('$departure' >= arrival AND  '$departure' <= departure)
													or (arrival >=  '$arrival' and arrival <=  '$departure'))
													and roomNo =".$result->roomNo);

										$stats = $mydb->executeQuery();
										$rows = mysql_fetch_assoc($stats);

										$image = WEB_ROOT . 'admin/mod_room/'.$result->roomImage;
										echo '<div style="float:left; width:370px; margin-left:10px;">';
										echo '<div style="float:left; width:70px; margin-bottom:10px;">';				
										echo '<img src="'.$image .'" width="180px" height="150px" style="-webkit-border-radius:5px; -moz-border-radius:5px;"title="<?php echo $roomName; ?>"/>';
										echo '</div>';						
										echo '<div style="float:right; height:200px; width:150px; margin:0px; color:#000033;">';										
										echo '<form name="book" method="POST" action="'.WEB_ROOT.'index.php?page=3">';							
										echo '<input type="hidden" name="roomid" value="'.$result->roomNo.'"/>';
										echo '<p><strong>Тип: '.$result->typeName.'<br/> 										
										<strong>Цена: </strong> '. $result->price.' <strong>лв. </strong> </p>';
										echo '
											<div class="form-group">
												<div class="row">
													<div class="col-xs-12 col-sm-12">
														<input type="submit" class="btn btn-primary btn-sm" name="btnbook" onclick="return validateBook();" value="Резервирай"/>
													</div>
												</div>
											</div>';
											
										echo '</form>';
										echo '</div>';
										echo '</div>';
				  	
									}					   
					  	?>
						</fieldset>	
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>

