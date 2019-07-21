<div class="container">
    <?php
        check_message();        	
	?>
    <div class="panel panel-primary">
        <div class="panel-body">
            <h3 align="left">Лист със стаи</h3>
            <form action="controller.php?action=delete" Method="POST">
                <table id="example" class="table table-striped" cellspacing="0">
                    <thead>
                        <tr  >
                            <th>No.</th>
                            <th align="left"  width="120">
                                <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"></input> 
                                Стая
                            </th>
                            <th align="left"  width="200">Картинка</th>
                            <th align="left" width="120">Тип стая</th>
                            <th align="left" width="120">Цена</th>                            
                            <th align="left"  width="200">Описание</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $mydb->setQuery("select *, typeName from room ro, roomtype rt where ro.typeID = rt.typeID");
                            $cur = $mydb->loadResultList();
                            
                            foreach ($cur as $result) {
								echo '<tr>';
								echo '<td width="5%" align="center"></td>';
								echo '<td align="left"  width="120"><input type="checkbox" name="selector[]" id="selector[]" value="'.$result->roomNo. '"/>
										<a  href="index.php?view=edit&id='.$result->roomNo.'">  <span class="glyphicon glyphicon-pencil">
										<a href="index.php?view=view&id='.$result->roomNo.'">' . ' '.$result->roomName.'</a></td>';
								echo '<td><a href="index.php?view=editpic&id='.$result->roomNo.'"" title="Промени картинка"><img src="'. $result->roomImage.'" width="60" height="60" title="<?php echo $roomName; ?>"/></a></td>';
								echo '
								<td>'. $result->typeName.'</td>
								';
								echo '
								<td>'. $result->price.'</td>
								';								
								echo '
								<td>'. $result->Desp.'</td>
								';
								echo '</tr>';
							} 
                        ?>
                    </tbody>
                </table>
                <div class="btn-group">
                    <a href="index.php?view=add" class="btn btn-default">Нова</a>
                    <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span>Изтрий</button>
                </div>
            </form>
        </div>       
    </div>    
</div>
