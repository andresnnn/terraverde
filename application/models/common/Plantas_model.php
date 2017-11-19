<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Plantas_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
         $this->load->model('common/Especies_model');
        $this->load->model('common/Umbraculos_model');
    }
    
    /*
     * Get planta by idPlanta
     */
    function get_planta($idPlanta)
    {
        return $this->db->get_where('planta',array('idPlanta'=>$idPlanta))->row_array();
    }

    function get_planta_especie($idPlanta)
    {
        $query = "SELECT especie.luzMax,especie.luzMin,especie.humedadMax,especie.humedadMax,especie.temperaturaMax,especie.temperaturaMin FROM `planta` JOIN especie ON planta.idEspecie=especie.idEspecie";
        return $this->db->query($query)->result_array();
    }
    
    /*ESTA FUNCION ARROJARA COMO RESULTADO UN ARRAY QUE CONTIENE LA INFORMACION
    DE LAS PLANTAS CON LA RESPECTIVA INFORMACIÓN DE SU ESPECIE, PARA REALIZAR LA COMPARACION DE CONDICIONES A LA HORA DE AGREGAR UNA PLANTA ADENTRO*/
    function obtener_plantas_especies()
    {
        $query = "SELECT especie.luzMax,especie.luzMin,especie.humedadMax,especie.humedadMin,especie.temperaturaMax,especie.temperaturaMin,especie.nombreEspecie,planta.idPlanta,planta.nombrePlanta,planta.unidadEspacioPlanta_m2,planta.active FROM `planta` JOIN especie ON planta.idEspecie=especie.idEspecie";
        return $this->db->query($query)->result_array();
    }
    
    /*esta funcion es para cargar solo las plantas aptas a cada umbraculo*/
    function obtener_plantas_especies_select($params)
    {
        $query = "SELECT * FROM `planta` JOIN especie ON planta.idEspecie=especie.idEspecie WHERE (luzMax >=".$params['luzUmbraculo']."  AND luzMin <=".$params['luzUmbraculo']." AND humedadMax >=".$params['humedadUmbraculo']." AND humedadMin <=".$params['humedadUmbraculo']." AND temperaturaMax >=".$params['temperaturaUmbraculo']." AND temperaturaMin <=".$params['temperaturaUmbraculo'].")";
        return $this->db->query($query)->result_array();
    }
    /**/
    
    /**
     * Reotorna la informacion de la planta, junto con la de su respectiva especie
     * @param  [type] $idPlanta [description]
     * @return [type]           [description]
     */
    function info_planta_especie($idPlanta)
    {

        $query="SELECT * 
                FROM planta 
                JOIN especie ON planta.idEspecie = especie.idEspecie
                WHERE planta.idPlanta =".$idPlanta;
        return $this->db->query($query)->row_array();

    }

    /*
     * Get all plantas
     */
    function get_all_plantas()
    {
        $this->db->order_by('idPlanta', 'desc');
        return $this->db->get('planta')->result_array();
    }
        
    /*
     * function to add new planta
     */
    function add_planta($params)
    {
        $this->db->insert('planta',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update planta
     */
    function update_planta($idPlanta,$params)
    {
        $this->db->where('idPlanta',$idPlanta);
        return $this->db->update('planta',$params);
    }
    
    /*
     * function to delete planta
     */
    function delete_planta($idPlanta)
    {
        return $this->db->delete('planta',array('idPlanta'=>$idPlanta));
    }

    /**
     * Desactiva una planta, para que ya no pueda ser utilizada, por 'x' motivo
     * @param  [type] $idInsumo [description]
     * @return [type]           [description]
     */
    function desactivar_planta($idPlanta)
      {
        $query="UPDATE `planta` SET `active`=0 WHERE `planta`.`idPlanta`=".$idPlanta;
        $this->db->query($query);
      }

    /**
    * ACTIVAR UN INSUMO QUE NO ESTÉ SIENDO UTILIZADO.
    */
        function activar_planta($idPlanta)
        {
          $query="UPDATE `planta` SET `active`=1 WHERE `planta`.`idPlanta`=".$idPlanta;
          $this->db->query($query);
        }
}