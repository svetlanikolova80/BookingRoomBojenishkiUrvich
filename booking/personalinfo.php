
<?php
	if (isset($_POST['submit'])){
		$arrival = $_SESSION['from']; 
		$departure = $_SESSION['to'];		
		$roomid = $_SESSION['roomid'];

		$_SESSION['name'] = $_POST['name'];
		$_SESSION['last'] = $_POST['last'];		
		$_SESSION['city'] = $_POST['city'];
		$_SESSION['address'] = $_POST['address'];		
		$_SESSION['phone'] = $_POST['phone'];
		$_SESSION['email'] = $_POST['email'];
		
		$_SESSION['pending'] = 'pending';

		$name = $_SESSION['name']; 
		$last = $_SESSION['last'];		
		$city = $_SESSION['city'] ;
		$address =$_SESSION['address'];		
		$phone = $_SESSION['phone'];
		$email =  $_SESSION['email'];		

		$days = dateDiff($arrival,$departure);
		redirect('index.php?view=payment');
	}
?>

<div class="container">
  <?php include'../sidebar.php';?>

    <div class="col-xs-12 col-sm-9">
		<div class="jumbotron">
			<div class="">
				<div class="panel panel-default">
					<div class="panel-body">  

						<td valign="top" class="body" style="padding-bottom:10px;">
							<?php
								if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
									echo '<ul class="err">';
									foreach($_SESSION['ERRMSG_ARR'] as $msg) {
										echo '<li>',$msg,'</li>'; 
									}
									echo '</ul>';
									unset($_SESSION['ERRMSG_ARR']);
								}
							?>

							<form class="form-horizontal well span6" action="index.php?view=info" method="post"  name="personal" style="margin-left:20px">
								<fieldset >
									<legend><h2>Лични данни</h2></legend>
	
									<div class="form-group">
										<div class="col-md-8">
											<label class="col-md-4 control-label" for=name"><small>Име:</small></label>
											<div class="col-md-8">
												<br/>
												<input name="" type="hidden" value="">
												<input name="name" type="text" class="form-control input-sm" id="name" />
											</div>
										</div>
									</div>									
									
									<div class="form-group">
										<div class="col-md-8">
											<label class="col-md-4 control-label" for="last"><small>Фамилия:</small></label>
											<div class="col-md-8">
												<br/>
												<input name="last" type="text" class="form-control input-sm" id="last" />
											</div>
										</div>
									</div>								
																		
									<div class="form-group">
										<div class="col-md-8">
											<label class="col-md-4 control-label" for="city"><small>Град:</small></label>
											<div class="col-md-8">
												<br/>
												<input name="city" type="text" class="form-control input-sm" id="city" />
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-md-8">
											<label class="col-md-4 control-label" for="address"><small>Адрес:</small></label>
											<div class="col-md-8">
												</br>
												<input name="address" type="text" class="form-control input-sm" id="address" />
											</div>
										</div>
									</div>									
									
									<div class="form-group">
										<div class="col-md-8">
											<label class="col-md-4 control-label" for="phone"><small>Телефон:</small></label>
											<div class="col-md-8">
												<br/>
												<input name="phone" type="text" class="form-control input-sm" id="phone" />
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="col-md-8">
											<label class="col-md-4 control-label" for="email"><small>Имейл:</small></label>
											<div class="col-md-8">
												<br/>
												<input name="email" type="text" class="form-control input-sm" id="email" />
											</div>
										</div>
									</div>									
																				
									&nbsp; &nbsp;
									<div class="form-group">
										<div class="col-md-6">											
											<br />
											<div class="col-md-4">
												<input name="submit" type="submit" value="Потвърди"  class="btn btn-primary" onclick="return personalInfo();"/>
											</div>
										
										</div>
									</div>																				
								</fieldset>
							</form>
						</div>
					</div>  
				</div>
			</div>
		</div>
	</div>
</div>