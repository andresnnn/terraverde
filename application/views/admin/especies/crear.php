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
                    <div class="box-header with-border">
                        <h3 class="box-title">Nueva especie</h3>
                    </div>
                                <div class="box-body">
            <?php echo form_open('common/especies/crear'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="nombreEspecie" class="control-label"><span class="text-danger">*</span>NombreEspecie</label>
						<div class="form-group">
							<input type="text" name="nombreEspecie" value="<?php echo $this->input->post('nombreEspecie'); ?>" class="form-control" id="nombreEspecie" />
							<span class="text-danger"><?php echo form_error('nombreEspecie');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="nombreCientificoEspecie" class="control-label"><span class="text-danger">*</span>NombreCientificoEspecie</label>
						<div class="form-group">
							<input type="text" name="nombreCientificoEspecie" value="<?php echo $this->input->post('nombreCientificoEspecie'); ?>" class="form-control" id="nombreCientificoEspecie" />
							<span class="text-danger"><?php echo form_error('nombreCientificoEspecie');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="luzMax" class="control-label"><span class="text-danger">*</span>LuzMax</label>
						<div class="form-group">
							<input type="text" name="luzMax" value="<?php echo $this->input->post('luzMax'); ?>" class="form-control" id="luzMax" />
							<span class="text-danger"><?php echo form_error('luzMax');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="luzMin" class="control-label"><span class="text-danger">*</span>LuzMin</label>
						<div class="form-group">
							<input type="text" name="luzMin" value="<?php echo $this->input->post('luzMin'); ?>" class="form-control" id="luzMin" />
							<span class="text-danger"><?php echo form_error('luzMin');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="humedadMax" class="control-label"><span class="text-danger">*</span>HumedadMax</label>
						<div class="form-group">
							<input type="text" name="humedadMax" value="<?php echo $this->input->post('humedadMax'); ?>" class="form-control" id="humedadMax" />
							<span class="text-danger"><?php echo form_error('humedadMax');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="humedadMin" class="control-label"><span class="text-danger">*</span>HumedadMin</label>
						<div class="form-group">
							<input type="text" name="humedadMin" value="<?php echo $this->input->post('humedadMin'); ?>" class="form-control" id="humedadMin" />
							<span class="text-danger"><?php echo form_error('humedadMin');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="temperaturaMax" class="control-label"><span class="text-danger">*</span>TemperaturaMax</label>
						<div class="form-group">
							<input type="text" name="temperaturaMax" value="<?php echo $this->input->post('temperaturaMax'); ?>" class="form-control" id="temperaturaMax" />
							<span class="text-danger"><?php echo form_error('temperaturaMax');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="temperaturaMin" class="control-label"><span class="text-danger">*</span>TemperaturaMin</label>
						<div class="form-group">
							<input type="text" name="temperaturaMin" value="<?php echo $this->input->post('temperaturaMin'); ?>" class="form-control" id="temperaturaMin" />
							<span class="text-danger"><?php echo form_error('temperaturaMin');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="descripcionCuidados" class="control-label"><span class="text-danger">*</span>DescripcionCuidados</label>
						<div class="form-group">
							<textarea name="descripcionCuidados" class="form-control" id="descripcionCuidados"><?php echo $this->input->post('descripcionCuidados'); ?></textarea>
							<span class="text-danger"><?php echo form_error('descripcionCuidados');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="descripcionSustrato" class="control-label">DescripcionSustrato</label>
						<div class="form-group">
							<textarea name="descripcionSustrato" class="form-control" id="descripcionSustrato"><?php echo $this->input->post('descripcionSustrato'); ?></textarea>
							<span class="text-danger"><?php echo form_error('descripcionSustrato');?></span>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
            <?php echo form_close(); ?>
                         </div>
                    </div>
                </section>
            </div>