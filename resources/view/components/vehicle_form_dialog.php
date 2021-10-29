<div id="vehicle_table_dialog" class="ui-widget-content" title="Adicionar veículo">
    <form method="POST" id="vehicle_form">
        <div class="form-group mt-3">
            <label for="brand">Marca do veículo</label>
            <input type="text" name="brand" id="brand" class="form-control">
            <span class="text-danger" id="error_brand"></span>
        </div>
        <div class="form-group mt-3">
            <label for="model">Modelo do veículo</label>
            <input type="text" name="model" id="model" class="form-control">
            <span class="text-danger" id="error_model"></span>
        </div>
        <div class="form-group mt-3">
            <label for="year">Ano do veículo</label>
            <input type="number" name="year" id="year" min="1997" max="<?= date('Y'); ?>" class="form-control">
            <span class="text-danger" id="error_year"></span>
        </div>
        <div class="form-group mt-3" align="right">
            <input type="hidden" name="action" id="action" value="save" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" value="Adicionar" name="btn_save" id="btn_save" class="btn btn-primary btn-md">
            <input type="button" value="Cancelar" name="btn_cancel" id="btn_cancel" class="btn btn-danger btn-md">
        </div>
    </form>
</div>