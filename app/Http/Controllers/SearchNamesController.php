<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dictionary;
use App\Exports\DictionaryExport;
use App\Search\ValidNameFormat;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use PDF;

class SearchNamesController extends Controller
{
    public $validNameFormat;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ValidNameFormat $validNameFormat)
    {
        $this->ValidNameFormat = $validNameFormat;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('search-names');
    }

    /**
     * Show the form for search a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // Obtener y Asinar valores de entrada
        $input = $request->all();
        $names = $input['names'];
        $percentage = $input['percentage'];

        // Vaciamos el valor en Cache
        Cache::forget('names');
        Cache::forget('percentage');
        // Escribirmos el valor de $names y $percentage en cache
        Cache::add('names', $names);
        Cache::add('percentage', $percentage);

        // Obtenemos todos los datos de Dictionary correpsondiente a la tabla de Diccionario en la base de datos
        $dictionary = Dictionary::all();

        // Realizamos la compración de los datos recibidos con las datos de la Tabla Dictionary de la base de datos
        $names_array = $this->ValidNameFormat->compareData($dictionary, $names, $percentage);
        
        if (count($names_array) > 0) 
        {
            // Mensajes y status para mostrar en el cliente
            $message = "Consulta exitosa, Con resultados";
            $status = 200;
        }

        // Vertioficamos si no hay resultados, Devolvemos status 400 (Resultados no encontrados)
        if (count($names_array) == 0) 
        {
            // Mensajes y status para mostrar en el cliente
            $message = "Consulta exitosa, Sin resultados";
            $status = 400;
        }

        // Retornamos la respuesta en formato JSON
        return response()->json(['message' => $message, 'status' => $status, 'data' => $names_array]);
    }

    /**
     * Show the form for exporting a new File PDF.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportPDF(Request $request)
    {
        // Obtener y Asinar valores de entrada
        $names = Cache::get('names');
        $percentage = Cache::get('percentage');

        // Obtenemos todos los datos de Dictionary correpsondiente a la tabla de Diccionario en la base de datos
        $dictionary = Dictionary::all();

        // Realizamos la compración de los datos recibidos con las datos de la Tabla Dictionary de la base de datos
        $names_array = $this->ValidNameFormat->compareData($dictionary, $names, $percentage);
        
        // Asignamos los valores obtenidos a un arreglo para enviarlo a la vista
        $data = ['title' => 'Resultados de Nombres Buscados', 'search' => $names_array];
        // Enviamos los datos por medio de $data a la vista
        $pdf = PDF::loadView('export-pdf', $data);
    
        // Exportamos el pdf por medio del metodo download() de PDF
        return $pdf->download('search-names.pdf', array('Content-Type' =>'application/pdf', 'Content-Transfer-Encoding' => 'Binary', 'Content-disposition' => 'attachment'));
    }

}
