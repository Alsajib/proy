<?php
class Autorizacion
{
    
    private $CABEZERAS = array();
    private $CURL_=null;
    private $RESPUESTA=null;
    private $ID=null;
    
    private $URL = array(
        "delegacion"=>'http://api.gobiernoabierto.gob.sv/delegations',
        "delegacion_info"=> 'http://api.gobiernoabierto.gob.sv/delegation_infos',
        "comunitario"=>'http://api.gobiernoabierto.gob.sv/food_establishment_health_communities',
        "salud"=>'http://api.gobiernoabierto.gob.sv/health_establishment_types',
        "salud_medicina"=>'http://api.gobiernoabierto.gob.sv/medicine_categories',
        "salud_establecimiento"=>'http://api.gobiernoabierto.gob.sv/health_establishments',
        "albergue"=>'http://api.gobiernoabierto.gob.sv/health_establishments',
        "hidrocarburos"=>'http://api.gobiernoabierto.gob.sv/hydro_prices',
        "hidrocarburos_referencia"=>'http://api.gobiernoabierto.gob.sv/hydro_references',
    );
    
    private function Load($ext_param = null)
    {
        
        $this->CURL_ = curl_init();
        
        if ($ext_param != null) {
            curl_setopt($this->CURL_, CURLOPT_URL, $ext_param);
        } else {
            curl_setopt($this->CURL_, CURLOPT_URL, $this->URL[$this->ID]);
        }

        curl_setopt($this->CURL_, CURLOPT_POST, 1);
        curl_setopt( $this->CURL_, CURLOPT_HTTPHEADER, array( 'Authorization: Token token=' . 'd535ad0b9c2227cf05713d9864d6b4ba') );
        curl_setopt($this->CURL_, CURLOPT_RETURNTRANSFER, 1);
        $this->RESPUESTA = curl_exec($this->CURL_);
        curl_close($this->CURL_);
    }
    
    public function __construct($IDENTIFICADOR) 
    {
        $this->ID = $IDENTIFICADOR;
        $this->Load();
    }
    
    public function Set_Filtro($PARAMETRO)
    {
        $extP =$this->URL[$this->ID] . $PARAMETRO;
        $this->load($extP);
    }
    
    
    public function Get_Respuesta_Jason()
    {
        return $this->RESPUESTA;
    }
    
    public function Get_Respuesta_JasonDecode($assoc = false)
    {
        return json_decode($this->RESPUESTA , $assoc);
    }
}
?>
