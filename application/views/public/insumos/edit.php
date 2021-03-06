<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>      



            <div class="wrapper">
                <section id="main-content" class="content-header">
                 <h3 class="box-title">Administración Insumos</h3>
                 
                    <div class="row">
                        <div class="col-md-12">
                    </div>

                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Bienvenido</h3>
                                </div>
                                <div class="box-body">
                                <!-- COMIENZA FORMULARIO -->
                                    <?php echo form_open('user/insumos_pla/edit/'.$insumo['idInsumo'],array("class"=>"form-horizontal")); ?>
                                        <div class="form-group">
                                            <label for="nombreInsumo" class="col-md-3 control-label">NombreInsumo</label>
                                            <div class="col-md-8">
                                                <input type="text" name="nombreInsumo" value="<?php echo ($this->input->post('nombreInsumo') ? $this->input->post('nombreInsumo') : $insumo['nombreInsumo']); ?>" class="form-control" id="nombreInsumo" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="descripcionInsumo" class="col-md-3 control-label">DescripcionInsumo</label>
                                            <div class="col-md-8">
                                                <input class="form-control" id="descripcionInsumo" type="text" name="descripcionInsumo" value="<?php echo ($this->input->post('descripcionInsumo') ? $this->input->post('descripcionInsumo') : $insumo['descripcionInsumo']); ?>"  />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cantidad" class="col-md-3 control-label">Cantidad</label>
                                            <div class="col-md-8">
                                                <input type="number" name="cantidad" value="<?php echo ($this->input->post('cantidad') ? $this->input->post('cantidad') : $insumo['cantidad']); ?>" class="form-control" id="cantidad" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="puntoDePedido" class="col-md-3 control-label">PuntoDePedido</label>
                                            <div class="col-md-8">
                                                <input type="text" name="puntoDePedido" value="<?php echo ($this->input->post('puntoDePedido') ? $this->input->post('puntoDePedido') : $insumo['puntoDePedido']); ?>" class="form-control" id="puntoDePedido" />
                                            </div>
                                        </div>

                                      <div class="box-footer">
                                          <button type="submit" class="btn btn-primary btn-flat">Guardar</button>
                                          <a href="<?php echo site_url('user/insumos_pla'); ?>" class="btn btn-default btn-flat">Cancelar</a>
                                      </div>
                                    <?php echo form_close(); ?>
                                    <!--TERMINA FORMULARIO-->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>