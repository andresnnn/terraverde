<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Plantas extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
                /* Load :: Common */
        $this->lang->load('admin/plantas');
        /* Title Page :: Common */
        $this->page_title->push(lang('menu_plantas'));
        $this->data['pagetitle'] = $this->page_title->show();
        /* CARGA LA BASE DE DATOS O MODELO*/
        $this->load->model('common/Plantas_model');
    }


    /*
     INDEX, LISTAR LAS PLANTAS
     */
        public function index()
        {
            if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
            {
                redirect('auth/login', 'refresh');
            }
            else
            {
                /* Breadcrumbs */
                $this->data['breadcrumb'] = $this->breadcrumbs->show();
                /* CARGO EL LISTADO DE UMBRACULOS*/

                $this->data['plantas'] = $this->Plantas_model->get_all_plantas();


                /* Load Template */
                $this->template->admin_render('admin/plantas/index', $this->data);
            }
        }

    /*
     REGISTRAR UNA NUEVA PLANTA AL SISTEMA
     */
    function crear()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {

                /* Breadcrumbs */
                $this->data['breadcrumb'] = $this->breadcrumbs->show();
                $this->load->library('form_validation');

        		$this->form_validation->set_rules('unidadEspacioPlanta_m2','UnidadEspacioPlanta M2','required|is_natural');
        		$this->form_validation->set_rules('descripcionPlanta','DescripcionPlanta','required|max_length[255]|min_length[5]');
        		$this->form_validation->set_rules('nombreCientificoPlanta','NombreCientificoPlanta','required|max_length[50]|min_length[4]');
        		$this->form_validation->set_rules('nombrePlanta','NombrePlanta','required|max_length[50]|min_length[4]');

        		if($this->form_validation->run())
                {
                    $params = array(
        				'idEspecie' => $this->input->post('idEspecie'),
        				'unidadEspacioPlanta_m2' => $this->input->post('unidadEspacioPlanta_m2'),
        				'descripcionPlanta' => $this->input->post('descripcionPlanta'),
        				'nombreCientificoPlanta' => $this->input->post('nombreCientificoPlanta'),
        				'nombrePlanta' => $this->input->post('nombrePlanta'),
                    );

                    $planta_id = $this->Plantas_model->add_planta($params);
                    redirect('common/plantas/index');
                }
                else
                {
        			$this->load->model('common/Especies_model');
        			$this->data['all_especies'] = $this->Especies_model->get_all_especies();
                    $this->template->admin_render('admin/plantas/crear', $this->data);
                }
        }
    }

    /*
     EDITAR UN PLANTA YA REGISTRADA
     */
    function editar($idPlanta)
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
                /* Breadcrumbs */
                $this->data['breadcrumb'] = $this->breadcrumbs->show();
                // check if the planta exists before trying to edit it
                $this->data['planta'] = $this->Plantas_model->get_planta($idPlanta);
                if($this->Plantas_model->no_existe_planta_umbraculo($idPlanta)){
                  /*chekea la planta si existe*/
                if(isset($this->data['planta']['idPlanta']))
                {
                    $this->load->library('form_validation');

        			$this->form_validation->set_rules('unidadEspacioPlanta_m2','UnidadEspacioPlanta M2','required|is_natural');
        			$this->form_validation->set_rules('descripcionPlanta','DescripcionPlanta','required|max_length[255]|min_length[5]');
        			$this->form_validation->set_rules('nombreCientificoPlanta','NombreCientificoPlanta','required|max_length[50]|min_length[4]');
        			$this->form_validation->set_rules('nombrePlanta','NombrePlanta','required|max_length[50]|min_length[4]');

        			if($this->form_validation->run())
                    {
                        $params = array(

        					'unidadEspacioPlanta_m2' => $this->input->post('unidadEspacioPlanta_m2'),
        					'descripcionPlanta' => $this->input->post('descripcionPlanta'),
        					'nombreCientificoPlanta' => $this->input->post('nombreCientificoPlanta'),
        					'nombrePlanta' => $this->input->post('nombrePlanta'),
                        );

                        $this->Plantas_model->update_planta($idPlanta,$params);
                        redirect('common/plantas/index');
                    }
                    else
                    {
        				$this->load->model('common/Especies_model');
        				$this->data['all_especies'] = $this->Especies_model->get_all_especies();
                        /*CARGA LA PLANTILLA CON EL FOIRMULARIO DE EDITAR */
                        $this->template->admin_render('admin/plantas/editar', $this->data);
                    }
                }
                /*fin checkeo de campo planta*/
                else
                    show_error('La planta que usted está tratando de editar no existe.');
                  }
                  #fin chekeo no existe planta en umbraculos
                  else{
                    show_error('No se puede editar una planta ubicada en un umbraculo.');
                  }

        }
    }

    /**
     * Desactiva la planta, para que esta no pueda utilizarse utilizarse en cualquier otro modulo.
     * Ej.- 'Ya no se trabaja con dicha planta'
     * @param  [type] $idPlanta
     * @return [type]           [description]
     * @author SAKZEDMK
     */
    function borrado_logico ($idPlanta)
    {
       $no_existe = $this->Plantas_model->no_existe_planta_umbraculo($idPlanta);
       if($no_existe){
        $this->Plantas_model->desactivar_planta($idPlanta);}
        redirect('common/plantas/index');
    }

    /**
     * Activa la planta, para que pueda utilizarse en cualquier otro modulo.
     * @param  [type] $idPlanta [description]
     * @return [type]           [description]
     * @author SAKZEDMK
     */
    function activado_logico($idPlanta)
    {

        $this->Plantas_model->activar_planta($idPlanta);
        redirect('common/plantas/index');
    }

    /*
     * Deleting planta
     */
    function remove($idPlanta)
    {
        $planta = $this->Plantas_model->get_planta($idPlanta);

        // check if the planta exists before trying to delete it
        if(isset($planta['idPlanta']))
        {
            $this->Plantas_model->delete_planta($idPlanta);
            redirect('plantas/index');
        }
        else
            show_error('The planta you are trying to delete does not exist.');
    }

    /**
     * Para ver lo detalles de la planta junto con los de las especie a la que pertenece.
     * @param  [type] $idPlanta [description]
     * @return [type]           [description]
     * @author SAKZEDMK
     */
    function ver ($idPlanta)
    {
        /*info_planta_especie($idPlanta)*/
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['detalles'] = $this->Plantas_model->info_planta_especie($idPlanta);
            $this->template->admin_render('admin/plantas/ver', $this->data);
        }
    }
}
