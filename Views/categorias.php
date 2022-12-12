<?php include("includes/header.php");
include ('../Database/Database.php');
include("../Model/CategoriasModel.php");
$categoriasClase = new GestionCategorias();


if(isset($_POST['nombre-categoria'])){
    $nombrecategoria = $_POST['nombre-categoria'];
    $descripcioncategoria = $_POST['descripcion-categoria'];
    $idusuario = $_SESSION['idusuario'];
    $categoriasClase->agregar_categoria($nombrecategoria,$descripcioncategoria,$idusuario);

}

if(isset($_POST['idproducto'])){
    $idcategoria = $_POST['idproducto'];
    $categoriasClase->eliminar_categoria($idcategoria);
}

if(isset($_POST['editnombre-categoria'])){
    $idcate = $_POST['edit_id'];
    $editnombre = $_POST['editnombre-categoria'];
    $editDesc = $_POST['editdescripcion-categoria'];
    $categoriasClase->editar_categoria($idcate,$editnombre,$editDesc);
}
?>

<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <br>
                <div class="row">
                    <div class="col-sm-6">
						<h2>Gestionar Categorías</h2>
					</div>
					<div class="col-sm-6 text-right">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Agregar Categoría</span></a>
					</div>
                </div>
                <br>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
						
						</th>
                        <th>ID</th>
                        <th>Nombre Categoría</th>
						<th>Descripción</th>
                        <th>Usuario Creador</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                <?php 
                $categories = $categoriasClase->selectCategorias();
                foreach($categories as $results => $row){
                    echo " <tr>
                    <td>
                    </td>
                    <td>" . $row['id_categoria'] .  "</td>
                    <td>" .  $row['nombre_categoria'] . "</td>
                    <td>" . $row['descripcion_categoria'] . "</td>
                    <td>" . $row['usuario_creador'] . " </td>
                    <td>
                        <a href='#editEmployeeModal" . $row['id_categoria'] . "' class='edit' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>
                        <a href='#deleteEmployeeModal" . $row['id_categoria'] . "' class='delete' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>
                    </td>
                    <div id='deleteEmployeeModal" . $row['id_categoria'] . "' class='modal fade'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <form method='POST'>
                                    <input type='hidden' id='idproducto' name='idproducto' value='" . $row['id_categoria'] . "'>
                                        <div class='modal-header'>						
                                            <h4 class='modal-title'>Eliminar Categoria</h4>
                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                        </div>
                                        <div class='modal-body'>					
                                            <p>¿Esta seguro de eliminar esta categoria?</p>
                        
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='button' class='btn btn-default' data-dismiss='modal' value='Cancelar'>
                                            <input type='submit' class='btn btn-danger' value='Eliminar'>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal HTML -->
                        <div id='editEmployeeModal" . $row['id_categoria'] . "' class='modal fade'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <form method='post'>
                                        <input type='hidden' id='edit_id' name='edit_id' value='" . $row['id_categoria'] . "'>
                                        <div class='modal-header'>						
                                            <h4 class='modal-title'>Editar categoría</h4>
                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                        </div>
                                        <div class='modal-body'>					
                                        <div class='form-group'>
                                        <label>Nombre de Categoria</label>
                                        <input type='text' id='editnombre-categoria' name='editnombre-categoria' class='form-control' value='" . $row['nombre_categoria'] . "' required>
                                        </div>
                                        <div class='form-group'>
                                            <label>Descripcion</label>
                                            <input type='text' class='form-control' id='editdescripcion-categoria' name='editdescripcion-categoria' value='" . $row['descripcion_categoria'] . "' required>
                                        </div>	
                                        </div>
                                        <div class='modal-footer'>
                                            <input type='button' class='btn btn-default' data-dismiss='modal' value='Cancel'>
                                            <input type='submit' class='btn btn-info' value='Editar'>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </tr>
                                      
                ";
                }
                ?>

                   

                </tbody>
            </table>
			<!-- <div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div> -->
        </div>
    </div>
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST">
					<div class="modal-header">						
						<h4 class="modal-title">Agregar categoria</h4>
						<button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Nombre de Categoria</label>
							<input type="text" id="nombre-categoria" name="nombre-categoria" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Descripcion</label>
							<input type="text" class="form-control" id="descripcion-categoria" name="descripcion-categoria" required>
						</div>				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Agregar">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	


<?php include("includes/footer.php")?>