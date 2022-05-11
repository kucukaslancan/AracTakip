<?php

class ArventoAPI {
    public $username;
    public $PIN1;
    public $PIN2;
    public $soap;
    public $log;

    function __construct($val) 
    {
    
        $this->username = $val['Username'];
        $this->PIN1     = $val['PIN1'];
        $this->PIN2     = $val['PIN2'];
        $this->log      = $val;
        $param = array(
            'soap_version'=>SOAP_1_1,
            'exceptions'=>false,
            'trace'=>1,
            'cache_wsdl'=>WSDL_CACHE_NONE,
        );
        $this->soap     = new SoapClient('http://ws.arvento.com/v1/report.asmx?wsdl',$param);
    }

    function getCarInfo($plaka)
    {
        try {
            $carInfo = array();
            $rap = $this->soap->GetVehicleStatus($this->log)->GetVehicleStatusResult->any;
            $array = array(json_decode(json_encode($rap),true));
            $xml = simplexml_load_string($array['0'], 'SimpleXMLElement');
            $arrayXML = json_decode(json_encode($xml),true);
            foreach($arrayXML['tblVehicleStatus']['dtVehicleStatus'] as $civiler){
                
                $this->log["LicensePlate"] = $plaka;
                $result = $this->soap->GetNodeFromLicensePlate($this->log)->GetNodeFromLicensePlateResult;
                $x = array(json_decode(json_encode($result),true));
                if($x[0] == $civiler['Cihaz_x0020_No'])
                {
                    $carInfo = array( 
                        'cihaz' => $civiler['Cihaz_x0020_No'], 
                        'plaka' =>  $plaka,
                        'tarih' =>  date('d.m.Y H:i:s', strtotime('+4 hour',strtotime($civiler['GMT_x0020_Tarih_x002F_Saat']))),
                        'enlem' => $civiler['Enlem'],
                        'boylam' =>  $civiler['Boylam'],
                        'hiz' =>  $civiler['Hız'],
                        'adres' =>  $civiler['Adres']
                     );
                }
              
            }
            echo json_encode( $carInfo );
        }catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function myCars()
    {
        try {
            $carInfo = array();
            $rap = $this->soap->GetVehicleStatus($this->log)->GetVehicleStatusResult->any;
            $array = array(json_decode(json_encode($rap),true));
            $xml = simplexml_load_string($array['0'], 'SimpleXMLElement');
            $arrayXML = json_decode(json_encode($xml),true);
            foreach($arrayXML['tblVehicleStatus']['dtVehicleStatus'] as $civiler){
                $this->log["Node"] = $civiler['Cihaz_x0020_No'];
                $result = $this->soap->GetLicensePlateFromNode($this->log)->GetLicensePlateFromNodeResult;	
                $x = array(json_decode(json_encode($result),true));
                $carInfo[] = array( 'cihaz' => $civiler['Cihaz_x0020_No'], 'plaka' =>  $x[0] );

            }
         return json_encode($carInfo);
        }catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}