<?php
	$name = $_SESSION['name']; 
	$last = $_SESSION['last'];
	$city = $_SESSION['city'] ;
	$address = $_SESSION['address'];
	$phone = $_SESSION['phone'];
	$email = $_SESSION['email'];
	$stat = $_SESSION['pending'];
?>

<div class="container">
	<?php include'../sidebar.php';?>

    <div class="col-xs-12 col-sm-9">
		<div class="jumbotron">
			<div class="">
				<div class="panel panel-default">
					<div class="panel-body">  
					
						<td valign="top" class="body" style="padding-bottom:10px;">

							<form action="index.php?view=payment" method="post"  name="" >
								<span id="printout">
									<fieldset >
										<legend><h2>Детайли за резервация</h2></legend>
										<p>
											
											<? print(Date("l F d, Y")); ?>
											<br/><br/>											
											Поздрави от почивна станция Урвич<br/><br/>
											Това са вашите детайли:<br/><br/>
											<strong>ИМЕ: </strong><?php echo $name.' '.$last;?>, <br/>
											<strong>АДРЕС: </strong><?php echo $address;?><br/>
											<strong>ТЕЛЕФОН: </strong><?php echo $phone;?> <br/>
											<strong>ИМЕЙЛ: </strong><?php echo $email;?><br/><br/>											
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
													$arival   = $_SESSION['from']; 
													$departure = $_SESSION['to']; 
													$days = dateDiff($arival,$departure);
													$mydb->setQuery("select *, typeName from room ro, roomtype rt where ro.typeID = rt.typeID and roomNo =". $_SESSION['roomid']);
													$cur = $mydb->loadResultList();

													foreach ($cur as $result) {
														echo '<tr>'; 
														echo '<td></td>';
														echo '<td>'. $result->typeName.'</td>';
														echo '<td>'.$arival.'</td>';
														echo '<td>'.$departure.'</td>';
														echo '<td>'.$days.'</td>';
														echo '<td >'. $result->price.'</td>';
														echo '<td >1</td>';
														echo '<td >'. $result->price.'</td>';
														echo '</tr>';
													} 
													$payable= $result->price * $days;
													$_SESSION['pay']= $payable;
												?>
											</tbody>

											<tfoot>
												<tr>
													<td colspan="6"></td>
													<td align="left">
														<h3><b>Тотал: <?php echo $payable= $days * $result->price; ?></b></h3>
													</td>
												</tr>
											</tfoot>  
										</table>
										
										<p>Вашият номер на ресервацията е: <b><?php echo $_SESSION['confirmation']?>:</b><br/></p>	
										Благодарим, че избрахте Почивна база Боженишки урвич
										
									</fieldset >
								</span>
								<div id="divButtons" name="divButtons">
									<input type="button" value="Принтирай" onclick="tablePrint();" class="btn btn-primary">
								</div>
							</form>
						</td>
					</div>
				</div>  
			</div>
		</div>
	</div>
  
<script>
	function tablePrint(){ 
		document.all.divButtons.style.visibility = 'hidden';  
		var display_setting="toolbar=no,location=no,directories=no,menubar=no,";  
		display_setting+="scrollbars=no,width=500, height=500, left=100, top=25";  
		var content_innerhtml = document.getElementById("printout").innerHTML;  
		var document_print=window.open("","",display_setting);  
		document_print.document.open();  
		document_print.document.write('<body style="font-family:verdana; font-size:12px;" onLoad="self.print();self.close();" >');  
		document_print.document.write(content_innerhtml);  
		document_print.document.write('</body></html>');  
		document_print.print();  
		document_print.document.close(); 

		return false;  
	}
	
	$(document).ready(function() {
		oTable = jQuery('#list').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
	});   
</script>