<div class="row row-offcanvas row-offcanvas-right">
	<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
		<div class="sidebar-nav">
			<div class="panel panel-primary">
	   
				<div class="panel-heading">Резервации</div>
		
				<div class="panel-body">	
					 <form  method="POST" action="#.php">
						<div class="col-xs-12 col-sm-12">
							<div class="form-group">
								<div class="row">
									<div class="col-xs-12 col-sm-12">
										<label class="control-label" for="from">От</label>
						 
										<input class="form-control from" size="11" value="<?php echo (isset($_SESSION['from'])) ? $_SESSION['from'] : ''; ?>" data-date="" data-date-format="dd-mm-yyyy" data-link-field="any" data-link-format="dd-mm-yyyy" type="text" value=""  name="from" id="from">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-xs-12 col-sm-12">
										<label class="control-label" for="to">До</label>
										
										<input class="form-control to" size="11" type="text" value="<?php echo (isset($_SESSION['to'])) ? $_SESSION['to'] : ''; ?>"  name="to" id="to" data-date="" data-date-format="dd-mm-yyyy" data-link-field="any" data-link-format="dd-mm-yyyy">
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-xs-12 col-sm-12">
										<button type="submit" class="btn btn-primary" align="right"name="avail">Провери</button>
									 </div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>				
			
			<form name="clock">
				<input  class="form-control" id="trans" type="label"  name="face" value="">
			</form>
		<hr>
	</div>
</div>
