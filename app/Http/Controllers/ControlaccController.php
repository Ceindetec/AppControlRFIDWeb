<?php

namespace accesorfid\Http\Controllers;

use Illuminate\Http\Request;

use accesorfid\Http\Requests;
use accesorfid\Http\Controllers\Controller;
use accesorfid\moduloModel;
use accesorfid\autorizacionModel;
use accesorfid\fucionarioModel;
use DB;
use Auth;

class ControlaccController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $modulo;

    private $claveMochila = array(335916, 428891, 866985, 2139945, 4385521, 8713045, 17162809, 34033702);

    public function index()
    {
        return view('coordinador.controlacc.index');
    }

    public function gridcontrolaccRFID(){
        $query = moduloModel::where('mod_estado', 1)->get();
        return json_encode(['data'=> $query]);
    }

    public function modaldetalleaccmod(Request $request){
        $query = moduloModel::find($request->id);
        return view('coordinador.controlacc.modaldetalleaccmod', compact('query'));
    }

    public function gridDetalleaccmodRFID(Request $request){
        $query = autorizacionModel::where('aut_modulo_id', $request->mod_id)->where('aut_estado_id',1)->where("aut_tautorizacion_id",1)->get();
        foreach ($query as $qu) {
            $qu->getfuncionario->tdocumento;
        }
        return ['data'=>$query];
    }

    public function configuraraccmoduloRFID($id){
        try
        {
             $query = moduloModel::find($id);
             if(isset($query)){
                return view('coordinador.controlacc.configuraraccmodulo', compact('query'));
             }else{
               return redirect()->back();
             }
        }
        catch(\Exception $e)
        {
            return view('coordinador.controlacc.index');
        }
    }

    public function gridnoautorizadosRFID(Request $request){
        $this->modulo = $request->mod_id;
        $query = fucionarioModel::where('func_estado_id', 1)
        ->where("func_tfuncionario_id",1)
        ->whereNotIn('func_id',function($query){
            $query->select('aut_funcionario_id')
            ->from('autorizacion')
            ->where('autorizacion.aut_modulo_id', $this->modulo)
            ->where('autorizacion.aut_tautorizacion_id',1)
            ->where('autorizacion.aut_estado_id',1);
        })->get();
        foreach ($query as $qu) {
            $qu->tdocumento;
        }
        return ['data'=>$query];
    }

    public function gridautorizadosRFID(Request $request){
        $this->modulo = $request->mod_id;
        $query = fucionarioModel::where('func_estado_id', 1)
        ->where('func_tfuncionario_id',1)
        ->whereIn('func_id',function($query){
            $query->select('aut_funcionario_id')
            ->from('autorizacion')
            ->where('autorizacion.aut_modulo_id', $this->modulo)
            ->where('autorizacion.aut_tautorizacion_id',1)
            ->where('autorizacion.aut_estado_id',1);
        })->get();
        foreach ($query as $qu) {
            $qu->tdocumento;
        }
        return ['data'=>$query];
    }

    public function agregarfuncionariomoduloRFID(Request $request){
        $exite = 0;
        $result="";
        try{
            $existe = autorizacionModel::where('aut_funcionario_id', $request->func_id)->where('aut_modulo_id', $request->mod_id)->where('aut_estado_id',2)->count();
            if($existe == 0){
                $datos = new autorizacionModel();
                $datos->aut_funcionario_id = $request->func_id;
                $datos->aut_modulo_id = $request->mod_id;
                $datos->aut_usuario_id = Auth::user()->usu_id;
                $datos->aut_tautorizacion_id = 1;
                $datos->aut_estado_id=1;
                $datos->save();
                $query = fucionarioModel::find($request->func_id);
                $query2 = moduloModel::find($request->mod_id);
            }else{
                $query = autorizacionModel::select('aut_id')->where('aut_funcionario_id', $request->func_id)->where('aut_modulo_id', $request->mod_id)->where('aut_estado_id',2)->get();
                $datos = autorizacionModel::find($query[0]->aut_id);
                $datos->aut_estado_id=1;
                $datos->save();
                $query = fucionarioModel::find($request->func_id);
                $query2 = moduloModel::find($request->mod_id);
            }
            $dataResult["dispositivo"] = "PC";
            $dataResult["accion"] = "INS";
            $dataResult["data"] = ["modulo"=>$query2->mod_codigo, "tarjeta"=>$query->func_tarjeta];
            return $this->encrypt(json_encode($dataResult));
        }catch(Exception $e){

        }
    }


    public function eliminarfuncionariomoduloRFID(Request $request){
        $result="";
        $query = autorizacionModel::select('aut_id')->where('aut_funcionario_id', $request->func_id)->where('aut_modulo_id', $request->mod_id)->where('aut_estado_id',1)->get();
        //dd();
        $datos = autorizacionModel::find($query[0]->aut_id);
        $datos->aut_estado_id=2;
        $datos->save();

        $query = fucionarioModel::find($request->func_id);
        $query2 = moduloModel::find($request->mod_id);
        $dataResult["dispositivo"] = "PC";
        $dataResult["accion"] = "DEL";
        $dataResult["data"] = ["modulo"=>$query2->mod_codigo, "tarjeta"=>$query->func_tarjeta];
        return $this->encrypt(json_encode($dataResult));
    }

    public function actualizartodomoduloRFID(Request $request){
        $query = autorizacionModel::select('aut_funcionario_id', 'aut_modulo_id')->where('aut_modulo_id',$request->modulo)->where('aut_estado_id',1)->get();
        foreach($query as $qu){
            $qu->getfuncionario->func_tarjeta;
            $qu->getmodulo->mod_codigo;
        }

        $dataResult["dispositivo"] = "PC";
        $dataResult["accion"] = "UPD";
        $array;
        for($i=0;$i<count($query);$i++){
            $array[$i]=$query[$i]->getfuncionario->func_tarjeta;
        }
         $dataResult["data"] = ["modulo"=>$query[0]->getmodulo->mod_codigo, "data"=>$array];
        return $this->encrypt(json_encode($dataResult));

    }

    public function confirmacionRFID(){

        $result["dispositivo"] = "PC";
        $result["accion"] = "permiso";
        $result["data"] = "";
        $mensaje = $this->encrypt(json_encode($result));
        return $this->encrypt(json_encode($result));
    }



    private function encrypt($mensaje){

        $mensajeOriginal = trim(utf8_decode($mensaje));
        $mensajeFraccionado = str_split($mensajeOriginal);
        $mensajeBinarioCompletoExplain ="";
        $mensajeMochilaExplain="";
        for ($i = 0; $i < count($mensajeFraccionado); $i++) {

            /*EXPLAIN ####################################################################################################*/



            //Cadena para la explicacion de la conversion a ASCII del mensaje
            $mensajeBinarioCompletoExplain = $mensajeBinarioCompletoExplain . " " . substr("00000000", 0, 8 - strlen(decbin(ord($mensajeFraccionado[$i])))) . decbin(ord($mensajeFraccionado[$i]));

            /*FIN EXPLAIN ################################################################################################*/

            $caracterBinarioCompleto = substr("00000000", 0, 8 - strlen(decbin(ord($mensajeFraccionado[$i])))) . decbin(ord($mensajeFraccionado[$i]));

            //Division de la cadena de 8 bits para el procesamiento de mochilas
            $auxiliarCaracterBinarioCompleto = str_split($caracterBinarioCompleto);

            //Declaracion del auxiliar para el procesamiento de mochilas
            $auxiliarCaracterEncriptado = 0;

            //Recorrido del vector y la mochila de 8 bits
            for ($j = 0; $j < count($auxiliarCaracterBinarioCompleto); $j++) {
                $auxiliarCaracterEncriptado = $this->claveMochila[$j] * $auxiliarCaracterBinarioCompleto[$j] + $auxiliarCaracterEncriptado;
            }

            //encadenamiento para el muestreo del Mensaje cifrado
            $mensajeMochilaExplain = $auxiliarCaracterEncriptado ." ".$mensajeMochilaExplain;

        }

        return  $mensajeMochilaExplain;

    }

    private function desencrypt($mensaje){

        $mensajeDecodeadoExplain = $mensaje;

        $mensajeCifrado = explode(" ", $mensajeDecodeadoExplain);

        $mensajeDescifrado="";


         //Recorre todo el mensaje para validarlo y decodificarlo
        for ($i = 0; $i < count($mensajeCifrado) - 1; $i++) {

        //Toma el valor actual del mensaje para verificar la validez del mensaje
            $auxiliarComprobacion = $mensajeCifrado[$i];

        //Reinicia el valor del auxiliar Binario
            $auxiliarBinario = "";

        //Recorre la mochila para la decodificacion del mensaje
            for ($j = count($this->claveMochila) - 1; $j >= 0; $j--) {

                if ($auxiliarComprobacion > 0) {

                    if ($auxiliarComprobacion >= $this->claveMochila[$j]) {

                        $auxiliarComprobacion = $auxiliarComprobacion - $this->claveMochila[$j];

                        $auxiliarBinario = "1" . $auxiliarBinario;


                    } else {

                        $auxiliarBinario = "0" . $auxiliarBinario;

                    }

                }

            }

            if ($auxiliarComprobacion === 0) {

                $caracterBinarioDecimal = bindec($auxiliarBinario);
                $caracterDecimalAscii = chr($caracterBinarioDecimal);

                $mensajeDescifrado = $caracterDecimalAscii.$mensajeDescifrado;

            } else {

                $TAG_ERROR = "ERROR";
                $mensajeDescifrado = $TAG_ERROR;

                break;
            }

        }
        return $mensajeDescifrado;
    }



}
