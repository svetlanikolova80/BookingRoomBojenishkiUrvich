<?php
    $_SESSION['id']=$_GET['id'];
    $rm = new Room();
    $result = $rm->single_room($_SESSION['id']);
?>
<form class="form-horizontal well span6" action="controller.php?action=edit" enctype="multipart/form-data" method="POST">
    <fieldset>
        <legend>Промяна на стая</legend>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="name">Стая:</label>
                <div class="col-md-8">
                    <input name="rmNo" type="hidden" value="<?php echo $result->roomNo; ?>">
                    <input class="form-control input-sm" id="name" name="name" placeholder="Стая" type="text" value="<?php echo $result->roomName; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="rmtype">Тип:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="rmtype" id="rmtype">
                        <option value="None">Празно</option>
                        <?php
                            $rm = new Roomtype();
                            $cur= $rm->listOfroomtype();
                            foreach ($cur  as $rmtype) {
                            	echo '<option value='.$rmtype->typeID.'>'.$rmtype->typename.'</option>';
                            }                            
						?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="price">Цена:</label>
                <div class="col-md-8"> 
                    <input class="form-control input-sm" id="price" name="price" placeholder="Цена" type="text" value="<?php echo $result->price; ?>" onkeyup="javascript:checkNumber(this);">
                </div>
            </div>
        </div>        
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="idno"></label>
                <div class="col-md-8">
                    <button class="btn btn-primary" name="save" type="submit" >Запази</button>
                </div>
            </div>
        </div>
    </fieldset>
</form>