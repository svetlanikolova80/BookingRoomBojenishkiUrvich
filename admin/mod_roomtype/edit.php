<?php
    $_SESSION['id']=$_GET['id'];
    $rm = new Roomtype();
    $result = $rm->single_roomtype($_SESSION['id']);
    
    ?>
<form class="form-horizontal well span6" action="controller.php?action=edit" method="POST">
    <fieldset>
        <legend>Промяна на типа стая</legend>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="name">Име на тип:</label>
                <div class="col-md-8">
                    <input name="rmtype_id" type="hidden" value="<?php echo $result->typeID; ?>">
                    <input class="form-control input-sm" id="name" name="name" placeholder="Име на тип" type="text" value="<?php echo $result->typename; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="description">Описание:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" id="description" name="description" placeholder="Описание" type="text" value="<?php echo $result->Desp; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="idno"></label>
                <div class="col-md-8">
                    <button class="btn btn-primary" name="save" type="submit">Запази</button>
                </div>
            </div>
        </div>
    </fieldset>
</form>