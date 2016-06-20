<?php

namespace accesorfid\Http\Controllers;

use Illuminate\Http\Request;

use accesorfid\Http\Requests;
use accesorfid\Http\Controllers\Controller;

use accesorfid\fucionarioModel;
use accesorfid\tipodocumentoModel;
use accesorfid\Http\Requests\updfuncionarioRQ;
use accesorfid\Http\Requests\insfuncionarioRQ;
use accesorfid\autorizacionModel;
use DB;

class funcionarioRfidController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       return view('administracion.funcionarioRFID.index');
   }

   public function gridfuncionariosRFID(Request $request)
   {

    $query = fucionarioModel::where('func_estado_id', 1)->get();
    foreach ($query as $qu) {
        $qu->tdocumento;
    }    
    return json_encode(['data'=> $query]);

}

public function modaleditarfuncionarioRFID(Request $request){

    $id = $request->input('id');
    $query = fucionarioModel::select()->where('func_id', $id)->get();
    $data = $query[0];
    return view('administracion.funcionarioRFID.modaleditarfuncionario', compact('data'));
}

public function drodtdocumentoRFID(){
    $query = tipodocumentoModel::select('tdoc_id','tdoc_nombre')->where('tdoc_estado_id', 1)->get();
    return $query;
}

public function pmodaleditarfuncionarioRFID(updfuncionarioRQ $request){
    $resul= "";
    $existedo = 0;
    $existetar = 0;
    try{
        $dato = fucionarioModel::find($request->input('func_id'));
        if($dato->func_tdocumento_id == $request->func_tdocumento_id){
            if($dato->func_documento != $request->func_documento){
                $existe = fucionarioModel::where('func_documento',$request->func_documento)->count();
            }
        }
        if($dato->func_tarjeta != $request->func_tarjeta){
            $existetar = fucionarioModel::where('func_tarjeta', $request->func_tarjeta)->count();
        }
        if($existedo==0){
            if($existetar==0){
                $dato->func_tdocumento_id = $request->input('func_tdocumento_id');
                $dato->func_documento = $request->input('func_documento');
                $dato->func_nombres = $request->input('func_nombres');
                $dato->func_apellidos = $request->input('func_apellidos');
                $dato->func_tarjeta = $request->input('func_tarjeta');
                $dato->save();
                $resul['estado']=true;
                $resul['mensaje']='Se actualizo el funcionario conrrectamente.';
            }else{
                $resul['estado']=false;
                $resul['mensaje']='Ya hay un registro con este codigo de tarjeta.';
            }
        }else{
            $resul['estado']=false;
            $resul['mensaje']='Ya hay un funcionario con este numero de documento.';
        }
    }
    catch(Exception $e){
        $resul['estado']=false;
        $resul['mensaje']='Ocurrio un error durante la actualizacion.';
    }
    return json_encode($resul);
}


public function registrarfuncionarioRFID(){
    return view('administracion.funcionarioRFID.modalregistrarfuncionario');
}

public function pregistrarfuncionarioRFID(insfuncionarioRQ $request){


    $datos = new fucionarioModel();
    $datos->func_tdocumento_id = $request->func_tdocumento_id;
    $datos->func_documento = $request->func_documento;
    $datos->func_nombres = $request->func_nombres;
    $datos->func_apellidos = $request->func_apellidos;
    $datos->func_tarjeta = $request->func_tarjeta;
    $datos->func_estado_id = 1;
    $datos->save();
    $resul['estado']=true;
    $resul['mensaje']='Se registro el funcionario correctamente.';

    return json_encode($resul);

}

public function peliminarfuncionarioRFID(Request $request)
{
    DB::beginTransaction();
    try
    {

        $dato = fucionarioModel::find($request->func_id);
        $dato->func_estado_id = 2;
        $dato->save();

        $query = autorizacionModel::where('aut_funcionario_id',$request->func_id)->get();

        foreach ($query as $qu) {
           $upd = autorizacionModel::find($qu->aut_id);
           $upd->aut_estado_id = 2;
           $upd->save();
       }
       $resul['estado']=true;
       $resul['mensaje']='Funcionario eliminado correctamente.';
   }
   catch(Exception $e)
   {
        $resul['estado']=false;
        $resul['mensaje']='Ocurrio un error durante la eliminación del funcionario';
        DB::rollBack();
    }

DB::commit();
return json_encode($resul);
}


}
