<form class="form-horizontal well span6" action="controller.php?action=add" method="POST">
    <fieldset>
        <legend>Нов тип стая</legend>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="name">Име на тип:</label>
                <div class="col-md-8">
                    <input name="deptid" type="hidden" value="">
                    <input class="form-control input-sm" id="name" name="name" placeholder="Име на тип" type="text" value="">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <label class="col-md-4 control-label" for="description">Описание:</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" id="description" name="description" placeholder="Описание" type="text" value="">
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