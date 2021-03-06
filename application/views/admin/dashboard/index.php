<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">

                <section class="content-header">
                    <h3 class="box-title">Página principal administración</h3>
                </section>

                <section id="main-content" class="content-header" style="background-image: url(<?php echo base_url('upload/loginbg.png'); ?>);">
                  <div class="row">


                      <div class="col-md-12">
                          <div class="box">
                              <div class="box-header with-border">
                                  <h3 class="box-title">Bienvenido Administrador</h3>
                                  <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                  </div>
                              </div>
                              <div class="box-body">
                                TERRAVERDE
                                <p>Es el sistema que la empresa optó por utilizar, para el apoyo en la gestión de los recursos de las instalaciones agronómicas.</p>
                                <p>Mediante su rango de <strong>Administrador</strong> posee acceso a todas las acciones disponibles para gestionar: </p>
                                <ul>
                                    <li><i class="fa fa-hand-o-right"></i>  Los usuarios.</li>
                                    <li><i class="fa fa-hand-o-right"></i>  Los umbráculos y la creación de una tarea asociada.</li>
                                    <li><i class="fa fa-hand-o-right"></i>  Las  tareas.</li>
                                    <li><i class="fa fa-hand-o-right"></i> Las especies y plantas.</li>
                                    <li><i class="fa fa-hand-o-right"></i>  Los insumos.</li>
                                </ul>

                              </div>
                          </div>
                      </div>
                  </div>
                    <div class="row">
                      <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Usuarios Registrados</span>
                                    <span class="info-box-number"><?php echo $count_users; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-shield"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tipos de Usuarios</span>
                                    <span class="info-box-number"><?php echo $count_groups; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-pagelines"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Especies de planta registradas</span>
                                    <span class="info-box-number"><?php echo $count_especies; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-tencent-weibo"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Plantas registradas</span>
                                    <span class="info-box-number"><?php echo $count_planta; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-tree"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Umbráculos Registrados</span>
                                    <span class="info-box-number"><?php echo $count_umbraculo; ?></span>
                                </div>
                            </div>
                        </div>
                      <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-basket"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Insumos Registrados</span>
                                    <span class="info-box-number"><?php echo $count_insumo; ?></span>
                                </div>
                            </div>
                      </div>
                      <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-sign-language"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tipos de tareas registradas</span>
                                    <span class="info-box-number"><?php echo $count_ttarea; ?></span>
                                </div>
                            </div>
                      </div>
                      <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-sign-language"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tareas realizadas</span>
                                    <span class="info-box-number"><?php echo $count_tarea; ?></span>
                                </div>
                            </div>
                      </div>
                    </div>
                </section>
            </div>
