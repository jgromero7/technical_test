<?php
namespace App\Search;

class ValidNameFormatGateway implements ValidNameFormat
{
   
    public function __construct()
    {
        //
    }
    /**
     * Creates a new Transaction using Placetopay PSE
     *
     * @param $searchName
     * @param $baseName
     * @return boolean
     * @throws \Exception
     */
    public function ValidName ($searchName, $baseName)
    {
         // Convertimos el Strig $searchName en un Array
         $searchNameExp = explode(" ",$searchName);
         asort($searchNameExp); // ordenamos el Array
 
         // Convertimos el Strig $baseName en un Array
         $baseNameExp = explode(" ",$baseName);
         asort($baseNameExp);  // ordenamos el Array
 
         // Validamos la longitud de los String convertidos a Array
         if (!count($searchNameExp) === count($baseNameExp)) {
             return false;
         }
 
         // Convertimos los array en String con la funcióin implode()
         $searchNameImp = implode(" ",$searchNameExp);
         $baseNameImp = implode(" ",$baseNameExp);
 
         // Verificamos pronunciación semejantes en el texto, Por ejemplo: Jose debe se igual a Joze o Joce
         if (metaphone($searchNameImp) == metaphone($baseNameImp))
         {
             // Asignamos el valor de pronunciación igual a $o2 correspondiente a la variable $o1
             $searchNameImp = $baseNameImp;
         }
 
         // Una vez ordenados, Realizamos la compración de nombres
         return $searchNameImp == $baseNameImp ? true : false;
    }
    
    public function compareData ($dictionary = array(), $searchName = null, $percentage = null) {
        // En names_array agregaremos los valores encontrado segun el porcentaje de entrada $percentage
        $names_array = array();

        // Asignación de valor 
        $names = $searchName;

        // Recorremos el diccionario 
        foreach( $dictionary as $item ) 
        {
            // Validar formato Nombre Apellido y Apellido Nombre
            if ( $this->ValidName($names, $item->nombre) )
            {
                // Asignamos el nombre 
                $names =  $item->nombre;
            }            
            else // En caso de que el nombre ya tenga formato Nombre Apellido Verificamos su pronunciación
            {
                // Verificar pronunciación semejentes en el texto, Por ejemplo: Jose debe se igual a Joze o Joce
                if (metaphone($item->nombre) == metaphone($names))
                {
                    // Asignamos el valor de pronunciación igual de $item->nombre correspondiente a la variable $names
                    $names = $item->nombre;
                }
            }            
            
            // obtenemos el procentaje de conincidencia en el texto de $names y $item->nombre con similar_text
            similar_text($names, $item->nombre, $percent);

            // Validamos si el porcentaje de comparación es mayor igual al porcentaje proporcionado
            if ($percent >= $percentage)
            {
                // Agregando resultados encontrados
                array_push($names_array, array(
                    'nombre_buscado' => $searchName,
                    'porcentaje_buscado' => $percentage, 
                    'nombre_encontrado' =>  $item->nombre,
                    'porcentaje_encontrado' => $percent,
                    'estado_ejecucion' => 'registros encontrados',
                    'otros_campos' => $item
                ));

            }    
        }

        return $names_array;

    }
    
}