<?php
    $_SESSION['id']=$_GET['id'];
    $amen = new Amenities();
    $result = $amen->single_amenities($_SESSION['id']);
?>
<form class="form-horizontal well span6" action="controller.php?action=edit" enctype="multipart/form-data" method="POST">
    <fieldset>
        <legend>Промени удобство</legend>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="name">Име:</label>
                <div class="col-md-8">
                    <input name="amen_id" type="hidden" value="<?php echo $result->amen_id; ?>">
                    <input class="form-control input-sm" id="name" name="name" placeholder="Име" type="text" value="<?php echo $result->amen_name; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="description">Описание:</label>
                <div class="col-md-8">
                    <input name="" type="hidden" value="">
                    <Textarea class="form-control input-sm" id="description" name="description">
                    <?php echo $result->amen_desp; ?>
                    </textarea>	
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
