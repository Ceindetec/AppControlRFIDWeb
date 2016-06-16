<?php

namespace accesorfid\Http\Controllers;

use accesorfid\moduloModel;

use Illuminate\Http\Request;

use accesorfid\Http\Requests;
use accesorfid\Http\Controllers\Controller;
use Auth;
use accesorfid\Http\Requests\insermoduloRQ;
use accesorfid\Http\Requests\upmoduloRQ;



class muduloRfidConroller extends Controller
{
    /**
     * Visualiza la pagina principal del registro de modulos.
     *
     * @return la vista administracion.modulorfid.index
     */
    public function index()
    {
        return view('administracion.modulorfid.index');
    }

    /**
     * [editarmoduloRFID regresa el modal que permite editar la informacion de un modulo especifico]
     * @param  Request $request [en este caso trae el id correspondiente al modulo que se quiere editar]
     * @return [view]           [administracion.modulorfid.modaleditarmodulo ]
     */
    public function modaleditarmoduloRFID(Request $request){
        $id = $request->input('id');
        $query = moduloModel::select('mod_id','mod_nombre')->where('mod_id', $id)->get();
        $data = $query[0];
        return view('administracion.modulorfid.modaleditarmodulo', compact('data'));
    }


    public function pmodaleditarmoduloRFID(upmoduloRQ $request){
        $resul;
        try{
            $datos = moduloModel::find($request->input('anterior'));
            $anterior = $request->input('anterior');
            $nuevo = $request->input('mod_id');
            $existe = 0;
            if($anterior != $nuevo){
                $existe = moduloModel::where('mod_id',$nuevo)->count();
            }
            if($existe == 0){
                $datos->mod_id = $request->input('mod_id');
                $datos->mod_nombre = $request->input('mod_nombre');
                $datos->mod_usuario_id = Auth::User()->usu_id;
                $datos->save();
                $resul['estado']=true;
                $resul['mensaje']='Actualizado modulo correctamente.';
            }else{
                $resul['estado']=false;
                $resul['mensaje']='Esta id modulo ya ha sido registrado.';
            }
            return json_encode($resul);
        }
        catch (Exception $e) {
            $resul['estado']=false;
            $resul['mensaje']='Ocurrio un error durante la actualizacion.';
            return json_encode($resul);
        }
        
    }


    public function pregistrarmoduloRFID(insermoduloRQ $request){
        $resul;
        try{
            $datos = new moduloModel();
            $datos->mod_id = $request->input('mod_id');
            $datos->mod_nombre = $request->input('mod_nombre');
            $datos->mod_usuario_id = Auth::User()->usu_id;
            $datos->mod_fecha = date('yyyy-MM-dd');
            $datos->save();
            $resul['estado']=true;
            $resul['mensaje']='Registrado modulo correctamente.';
            return json_encode($resul);
        }
        catch(Exception $e){
            $resul['estado']=false;
            $resul['mensaje']='Ocurrio un error durante el registro.';
            return json_encode($resul);
        }
    }

    public function peliminarmoduloRFID(Request $request){
        $dato = moduloModel::find($request->input('mod_id'));
        $dato->mod_estado = 2;
        $dato->save();
        $resul['estado']=true;
        $resul['mensaje']='Modulo eliminado correctamente.';
        return json_encode($resul);
    }

    /**
     * [registrarmoduloRFID regresa el modal que permite registrar nuevos modulos rfid]
     * @return [view] [administracion.modulorfid.modalregistrarmodulo]
     */
    public function registrarmoduloRFID(){
        return view('administracion.modulorfid.modalregistrarmodulo');
    }

    /**
     * [gridmodulosRFID obtiene la data que sera cargada en la grid que visualiza la lista de modulos existen]
     * @return [json] [data con la lista de modulos]
     */
    function gridmodulosRFID(){
        $query = moduloModel::where('mod_estado', 1)->get();
        foreach ($query as $qu) {
            $qu->user;
        }
        return json_encode(['data'=> $query]);
    }
}
