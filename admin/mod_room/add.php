<form class="form-horizontal well span6" action="controller.php?action=add" enctype="multipart/form-data" method="POST">
    <fieldset>
        <legend>Нова стая</legend>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="name">Стая:</label>
                <div class="col-md-8">
                    <input name="" type="hidden" value="">
                    <input class="form-control input-sm" id="name" name="name" placeholder="Стая" type="text" value="">
                </div>
            </div>
        </div>		
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="rmtype">Тип на стая:</label>
                <div class="col-md-8">
                    <select class="form-control input-sm" name="rmtype" id="rmtype">
                        <option value="None">Празно</option>
                        <?php
                            $rm = new Roomtype();
                            $cur = $rm->listOfroomtype();
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
                    <input class="form-control input-sm" id="price" name="price" placeholder="Цена" type="text" value="" onkeyup="javascript:checkNumber(this);">
                </div>
            </div>
        </div>        
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="image">Качи снимка:</label>
                <div class="col-md-8">
                    <input type="file" name="image" value="" id="image">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for=
                    "idno"></label>
                <div class="col-md-8">
                    <button class="btn btn-primary" name="save" type="submit" >Запази</button>
                </div>
            </div>
        </div>
    </fieldset>
</form>