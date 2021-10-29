<?php include 'layout/header.php'; ?>
<main>
    <section class="my-md-5 text-center">
        <h1 class="display-4 lead">Lista dos veículos</h1>
    </section>
    <div class="card shadow-sm my-xl-5">
        <div class="card-header">
            <div class="row align-items-center justify-content-end">
                <div class="col-sm-5">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Pesquisar" aria-label="Search field" name="search" id="search" aria-describedby="button-search">
                            <button class="btn btn-outline-primary" type="submit" id="button-search">
                                Pesquisar
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-2">
                    <div class="row">
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                            <button class="btn btn-outline-primary" name="add_vehicle" id="add_vehicle">
                                Adicionar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-vehicle" class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Marca do veículo</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Ano</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Remover</th>
                        </tr>
                    </thead>
                    <tbody id="vehicle_data"></tbody>
                </table>
            </div>
            <?php 
                include 'components/vehicle_form_dialog.php'; 
                include 'components/action_alert.php';
                include 'components/delete_confirmation.php';
            ?>
        </div>
    </div>
</main>
<?php include 'layout/footer.php'; ?>
