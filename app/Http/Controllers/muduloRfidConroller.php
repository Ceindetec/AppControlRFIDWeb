<?php

namespace accesorfid\Http\Controllers;

use accesorfid\moduloModel;

use Illuminate\Http\Request;

use accesorfid\Http\Requests;
use accesorfid\Http\Controllers\Controller;
use Auth;
use accesorfid\Http\Requests\insermoduloRQ;
use accesorfid\Http\Requests\upmoduloRQ;
use accesorfid\autorizacionModel;
use DB;



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
        $query = moduloModel::select('mod_id','mod_codigo','mod_nombre')->where('mod_id', $id)->get();
        $data = $query[0];
        return view('administracion.modulorfid.modaleditarmodulo', compact('data'));
    }


    public function pmodaleditarmoduloRFID(upmoduloRQ $request){
        $resul;
        $existe = 0;
        try{
            $datos = moduloModel::find($request->mod_id);
            $nuevo = strtolower($request->input('mod_codigo'));

            $existe = moduloModel::where('mod_codigo',$nuevo)->count();

            if($existe == 0){
                $datos->mod_codigo = strtolower($request->mod_codigo);
                $datos->mod_nombre = $request->input('mod_nombre');
                $datos->mod_usuario_id = Auth::User()->usu_id;
                $datos->save();
                $resul['estado']=true;
                $resul['mensaje']='Actualizado modulo correctamente.';
            }else{
                $resul['estado']=false;
                $resul['mensaje']='Este codigo ya ha sido registrado.';
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
            $datos->mod_codigo = strtolower ($request->input('mod_codigo'));
            $datos->mod_nombre = $request->input('mod_nombre');
            $datos->mod_usuario_id = Auth::User()->usu_id;
            $datos->mod_fecha = date('y-m-d');
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

    public function peliminarmoduloRFID(Request $request)
    {
        DB::beginTransaction();
        try{
            $dato = moduloModel::find($request->input('mod_id'));
            $dato->mod_estado = 2;
            $dato->save();

            $query = autorizacionModel::where('aut_modulo_id',$request->mod_id)->get();

            foreach ($query as $qu) {
                 $upd = autorizacionModel::find($qu->aut_id);
                 $upd->aut_estado_id = 2;
                 $upd->save();
             }

             $resul['estado']=true;
             $resul['mensaje']='Modulo eliminado correctamente.';
        }
        catch(Exception $e)
        {
            $resul['estado']=false;
            $resul['mensaje']='Ocurrio un error durante la eliminación del modulo';
            DB::rollBack();
        }
        DB::commit();
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
