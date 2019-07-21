<?php
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Боженишки урвич</title>
        <link href="<?php echo WEB_ROOT; ?>admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo WEB_ROOT; ?>admin/css/dataTables.bootstrap.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT; ?>admin/css/jquery.dataTables.css">
        <link href="<?php echo WEB_ROOT; ?>admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
        <script type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>admin/js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>admin/js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>admin/js/bootstrap.min.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo WEB_ROOT; ?>admin/js/bootstrap-modal.js"></script>
        <script type="text/javascript" src="<?php echo WEB_ROOT; ?>admin/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="<?php echo WEB_ROOT; ?>admin/js/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>
    </head>
    <script type="text/javascript">
        $(document).ready(function(){
			$('.cls_btn').click(function(){

				var id = $(this).attr('id');
				console.log($(this).attr('id'));
				
				$.ajax({
				  type: "POST",
				  url: "some.php",
				  data: { id:id,name:"somebody" }
				});
			});
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
        	$('.toggle-modal').click(function(){
        		$('#logout').modal('toggle');
        	}); 
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
        	$('.toggle-modal-reserve').click(function(){
        		$('#reservation').modal('toggle');
        	}); 
        });
    </script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function(){
            var datatable = $('#example').DataTable({
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 1
                }],                
                "scrollY":        "400px",
                "scrollCollapse": true,
                "order": [[ 2, 'asc' ]]
            });
         
            datatable.on( 'order.dt search.dt', function (){
                datatable.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i){
                    cell.innerHTML = i + 1;
                });
            }).draw();
        }); 
    </script>
    <link href="<?php echo WEB_ROOT; ?>admin/css/offcanvas.css" rel="stylesheet">
    <?php
        admin_confirm_logged_in();
	?>
    <body>
        <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo WEB_ROOT; ?>admin/index.php">Боженишки урвич</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">						
                        <li class="<?php echo (currentpage() == 'index.php') ? "active" : false;?>"><a href="<?php echo WEB_ROOT; ?>admin/index.php" >Начало</a></li>
						<li class="<?php echo (currentpage() == 'mod_reservation') ? "active" : false;?>"><a href="<?php echo WEB_ROOT; ?>admin/mod_reservation/index.php">Резервации</a></li>
                        <li class="<?php echo (currentpage() == 'mod_room') ? "active" : false;?>"><a href="<?php echo WEB_ROOT; ?>admin/mod_room/index.php">Стаи</a></li>
                        <li class="<?php echo (currentpage() == 'mod_roomtype') ? "active" : false;?>"><a href="<?php echo WEB_ROOT; ?>admin/mod_roomtype/index.php">Тип стаи</a></li>                        
                        <li class="<?php echo (currentpage() == 'mod_amenities') ? "active" : false;?>"><a href="<?php echo WEB_ROOT; ?>admin/mod_amenities/index.php">Удобства</a></li>
                        <li class="<?php echo (currentpage() == 'logout.php') ? "active" : false;?>"><a class="toggle-modal" href="#logout">Изход</a></li>
                    </ul>
                </div>
            </div>
        </div>
              
        <div class="container">
            <?php check_message(); ?>
            <?php require_once $content;?>
            <hr>
            <footer>
                <p>&copy; Стани Мир </p>
                <script>
					function checkall(selector) {
						if (document.getElementById('chkall').checked == true) {
							var chkelement = document.getElementsByName(selector);
							for (var i = 0; i < chkelement.length; i++) {
								chkelement.item(i).checked = true;
							}
						} else {
							var chkelement = document.getElementsByName(selector);
							for (var i = 0; i < chkelement.length; i++) {
								chkelement.item(i).checked = false;
							}
						}
					}

					function checkNumber(textBox) {
						while (textBox.value.length > 0 && isNaN(textBox.value)) {
							textBox.value = textBox.value.substring(0, textBox.value.length - 1)
						}
						textBox.value = trim(textBox.value);
					}

					function checkText(textBox) {
						var alphaExp = /^[a-zA-Z]+$/;
						while (textBox.value.length > 0 && !textBox.value.match(alphaExp)) {
							textBox.value = textBox.value.substring(0, textBox.value.length - 1)
						}
						textBox.value = trim(textBox.value);
					}
                </script>			
            </footer>
        </div>
    </body>
</html>
<script type="text/javascript">
	$('.start').datetimepicker({
    language: 'bg',
    weekStart: 1,
    todayBtn: 1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
$('.end').datetimepicker({
    language: 'bg',
    weekStart: 1,
    todayBtn: 1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
</script>