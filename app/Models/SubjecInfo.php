<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjecInfo extends Model
{
    use HasFactory;
    
    private static $path;


    public function __constructor()
    {}

    public static function getRequestPath()
    {
        if (self::$path === null) {
			self::$path = 'http://wwwinfo.mfcr.cz/cgi-bin/ares/darv_bas.cgi?ico=';
		}
		return self::$path;
    }


    public static function getCompanyInfo($ico)
    {

        $id = intval($ico);
        
        $file = @file_get_contents( self::getRequestPath() . $id);


        if ($file) $xml = @simplexml_load_string($file);

        $record = [];
        if ($xml) {
            $ns = $xml->getDocNamespaces();
            $data = $xml->children($ns['are']);
            $el = $data->children($ns['D'])->VBAS;
            if (strval($el->ICO) == $ico) {
                $record['id']         = strval($el->ICO);
                $record['tax_id']     = strval($el->DIC);
                $record['company']    = strval($el->OF);
                $record['street']     = strval($el->AA->NU) . ' ' . strval($el->AA->CO);
                $record['village']    = strval($el->AA->N);
                $record['zip_code']   = strval($el->AA->PSC);
                $record['status']     = 1;
                $record['message']    = __('Company record was successfully found');
            } else {
                $record['message']    = __('Company registration number not found');
                $record['status']     = 0;
            }
        } else {
            $record['message']        = __('ARES database not available');
            $record['status']         = 0;
        }
        return $record;
    }
}
