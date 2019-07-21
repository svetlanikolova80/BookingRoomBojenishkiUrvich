<div class="container">
    <h3>Административен панел: Добре дошъл, <?php echo $_SESSION['admin_ACCOUNT_NAME'];?></h3>
    <div class="panel-group" id="accordion">
		<div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
						Резервации
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <a href="mod_reservation/index.php">Кликни</a>
                </div>
            </div>
        </div>
		
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
						Стаи
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">					
                    <a href="mod_room/index.php">Кликни</a>
                </div>
            </div>
        </div>
		
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
						Тип стаи
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    <a href="mod_roomtype/index.php">Кликни</a>  
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
						Удобства
                    </a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
                <div class="panel-body">
                    <a href="mod_amenities/index.php">Кликни</a>     
                </div>
            </div>
        </div>                
    </div>
</div>