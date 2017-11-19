<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>

                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                <div class="box-body">
			<div class="box-header with-border">
             <h3 class="box-title">Agregar tarea a <strong><?php echo $info_umbraculo['nombreUmbraculo']?></strong></h3>
            </div>
            <?php echo form_open('common/tareas/add/'.$id); ?>
          	<div class="box-body">
          		<div>
					<div class="col-md-6">
						<label for="idTipoTarea" class="control-label"><span class="text-danger">*</span>Tipotarea</label>
						<div class="form-group">
							<select name="idTipoTarea" class="form-control">
								<option value="">Seleccionar tipo de tarea</option>
								<?php
								foreach($tipotarea as $tipotarea)
								{
									$selected = ($tipotarea['idTipoTarea'] == $this->input->post('idTipoTarea')) ? ' selected="selected"' : "";

									echo '<option value="'.$tipotarea['idTipoTarea'].'" '.$selected.'>'.$tipotarea['nombreTipoTarea'].'</option>';
								}
								?>
							</select>
							<span class="text-danger"><?php echo form_error('idTipoTarea');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="idEstado" class="control-label">Estado de tarea</label>
						<div class="form-group">
							<?php
							echo $estadoDefecto['nombreEstado'];
							?>
						<input type="hidden" name="idEstado" value="<?php echo $estadoDefecto['idEstado']; ?>" class="has-datepicker form-control" id="idEstado" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="idUserCreador" class="control-label">Usuario creador</label>
						<div class="form-group">
						<?php echo $user_login['firstname']." ".$user_login['lastname']; ?>
						<input type="hidden" name="idUserCreador" value="<?php echo $user_login['id']; ?>" class="has-datepicker form-control" id="idUserCreador" />
						</div>
					</div>

					<div class="col-md-6">
						<label for="idPlanta" class="control-label">Planta</label>
						<div class="form-group">
							<select name="idPlanta" class="form-control">
								<option value="">Seleccionar planta</option>
								<?php
								foreach($umbraculo_plantas as $plantum)
								{
									$selected = ($plantum['idPlanta'] == $this->input->post('idPlanta')) ? ' selected="selected"' : "";

									echo '<option value="'.$plantum['idPlanta'].'" '.$selected.'>'.$plantum['nombrePlanta'].'</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						<input type="hidden" name="idUmbraculo" value="<?php echo $id; ?>" class="has-datepicker form-control" id="idUmbraculo" />
						</div>



					</div>
		<div class="col-md-6">
						<label for="fechaCreacion" class="control-label"><span class="text-danger">*</span>Fecha Creación</label>
           	<div class="form-group">
              <input  readonly type="text" name="fechaActual" value="<?php $hoy = getdate(); $d = $hoy['mday']; $M = $hoy['mon']; $y = $hoy['year'];echo $d."-".$M."-".$y; ?>" class="has-datepicker form-control" id="fechaCreacion" />
							<span class="text-danger"><?php echo form_error('fechaCreacion');?></span>
		</div>

		<div class="form-group">
              <input  type="hidden" name="fechaCreacion" value="<?php $hoy = getdate(); $d = $hoy['mday']; $M = $hoy['mon']; $y = $hoy['year'];echo $y."-".$M."-".$d; ?>" class="has-datepicker form-control" id="fechaCreacion" />
							<span class="text-danger"><?php echo form_error('fechaCreacion');?></span>
						</div>
					</div>

        </div>
                
        <div class="col-md-6">
          <label for="fechaHoraComienzo" class="control-label"><span class="text-danger">*</span>Fecha Prevista para la Tarea</label>
          <div class="form-group">
            <input class="has-datepicker form-control" type="date"  name="fechaComienzo" id="fechaComienzo" value="<?php echo $this->input->post(date('Y-m-d', strtotime('fechaComienzo'))); ?>" min="<?php echo date('Y-m-d');?>"/>
            <span class="text-danger"><?php echo form_error('fechaComienzo');?></span>
          </div>
          <label for="fechaHoraComienzo" class="control-label"><span class="text-danger">*</span>Hora Prevista para la Tarea</label>
          <div class="form-group">
            <input class="has-datepicker form-control"  type="time"   min="08:00" max="19:00" name="horaComienzo" id="horaComienzo" value="<?php echo $this->input->post(('horaComienzo')); ?>"/>
            <span class="text-danger"><?php echo form_error('horaComienzo');?></span>
          </div>
        </div>
				</div>
			</div>
            <div class="box-footer" style="text-align: center;">
                <button type="submit" class="btn btn-primary btn-flat">Agregar</button>
                <a href="<?php echo site_url('common/umbraculos/ver/'.$id); ?>" class="btn btn-default btn-flat">Cancelar</a>
            </div>
            <?php echo form_close(); ?>


                         </div>
                    </div>
                </section>
            </div>
<script>
    function validarFechaMenorActual(){
var hoy             = new Date();
        alert (hoy);
var fechaFormulario = new Date('18-11-2017');
//var fechaFormulario = new Date(document.getElementById("fechaComienzo"));
       // var fecha = new Date();
//document.getElementById("demo").innerHTML = d;
//document.getElementById("fechaComienzo").innerHTML =fecha;

// Comparamos solo las fechas => no las horas!!
hoy.setHours(0,0,0,0);
fechaFormulario.setHours(0,0,0,0); // Lo iniciamos a 00:00 horas

if (hoy <=fechaFormulario) {

  alert("Fecha Valida");
}
else {
  alert("No se puede planificar para fechas anteriores a la actual.");
}
}
    function tiempo(){
        alert("Debe elejir una hora entre las 08 A.M y las 19 P.M");
    }
</script>