<form class="form-horizontal well span6" action="controller.php?action=add" enctype="multipart/form-data" method="POST">
    <fieldset>
        <legend>Ново удобство</legend>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="name">Име:</label>
                <div class="col-md-8">
                    <input name="" type="hidden" value="">
                    <input class="form-control input-sm" id="name" name="name" placeholder="Име" type="text" value="">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="description">Описание:</label>
                <div class="col-md-8">
                    <input name="" type="hidden" value="">
                    <textarea class="form-control input-sm" id="description" name="description"></textarea>	
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
                <label class="col-md-4 control-label" for="idno"></label>
                <div class="col-md-8">
                    <button class="btn btn-primary" name="save" type="submit" >Запази</button>
                </div>
            </div>
        </div>
    </fieldset>
</form>