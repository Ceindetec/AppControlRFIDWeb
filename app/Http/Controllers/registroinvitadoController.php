<?php

namespace accesorfid\Http\Controllers;

use Illuminate\Http\Request;

use accesorfid\Http\Requests;
use accesorfid\Http\Controllers\Controller;
use accesorfid\moduloModel;
use accesorfid\fucionarioModel;
use accesorfid\autorizacionModel;
use accesorfid\Http\Requests\insInvitado;
use DB;
use Auth;

class registroinvitadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("coordinador.registroinvitados.index");
    }

    public function drodmdulo(){
        $query = moduloModel::where('mod_estado',1)->get();
        return $query;
    }

    public function getdocumento(Request $request){
        //$request->filter["filters"][0]["value"];
        $query = fucionarioModel::select("func_documento")
        ->where('func_documento','like',"%".$request->filter["filters"][0]["value"]."%")
        ->where('func_tfuncionario_id',2)
        ->get();
        return $query;
    }

    public function pregistroinvitados(insInvitado $request){

        $exitefunc = fucionarioModel::where('func_documento', $request->func_documento)
        ->where('func_tdocumento_id', $request->func_tdocumento_id)
        ->where('func_tfuncionario_id',1)
        ->count();

        if($exitefunc==0){
            $exiteinv = fucionarioModel::where('func_documento', $request->func_documento)
            ->where('func_tdocumento_id', $request->func_tdocumento_id)
            ->where('func_tfuncionario_id',2)
            ->count();

            $querytar = fucionarioModel::where('func_tarjeta', $request->func_tarjeta)
            ->where('func_estado_id',1)
            ->where('func_tfuncionario_id',1)
            ->get(); 
            if(count($querytar)== 0){
                DB::beginTransaction();
                try{
                    if($exiteinv==0){
                        $nuevoinvitado = new fucionarioModel();
                        $nuevoinvitado->func_tdocumento_id = $request->func_tdocumento_id;
                        $nuevoinvitado->func_documento = $request->func_documento;
                        $nuevoinvitado->func_tfuncionario_id = 2;
                        $nuevoinvitado->func_nombres = $request->func_nombres;
                        $nuevoinvitado->func_apellidos = $request->func_apellidos;
                        $nuevoinvitado->func_tarjeta = $request->func_tarjeta;
                        $nuevoinvitado->func_estado_id = 1;
                        $nuevoinvitado->save();

                        $nuevoaccesos = new autorizacionModel();
                        $nuevoaccesos->aut_funcionario_id = $nuevoinvitado->func_id;
                        $nuevoaccesos->aut_modulo_id = $request->mod_id;
                        $nuevoaccesos->aut_usuario_id = Auth::User()->usu_id;
                        $nuevoaccesos->aut_tautorizacion_id = 2;
                        $nuevoaccesos->aut_fecha_registro = date('Y-m-d');
                        $nuevoaccesos->aut_estado_id = 1;
                        $nuevoaccesos->save();
                    }else{

                        $funcid = fucionarioModel::select('func_id')
                        ->where('func_documento', $request->func_documento)
                        ->where('func_tdocumento_id',$request->func_tdocumento_id)
                        ->get();
                        $invitado = fucionarioModel::find($funcid[0]->func_id);
                        $invitado->func_tarjeta = $request->func_tarjeta;
                        $invitado->func_nombres = $request->func_nombres;
                        $invitado->func_apellidos = $request->func_apellidos;
                        $invitado->save();

                        $autid = autorizacionModel::select('aut_id')->where('aut_funcionario_id', $funcid[0]->func_id)->get();
                        $autupd = autorizacionModel::find($autid[0]->aut_id);
                        $autupd->aut_modulo_id = $request->mod_id;
                        $autupd->aut_estado_id = 1;
                        $autupd->aut_fecha_registro = date('Y-m-d');
                        $autupd->save();

                    }

                    DB::commit();

                    $result["estado"]=true;
                    $result["mensaje"]="Invitado registrado correctamente.";
                    $result["result"]="";
                    return $result;

                }catch(\Exception $e){
                    DB::rollBack();
                    $result["estado"]=false;
                    $result["mensaje"]="Ocurrio un errror durante el registro";
                    $result["result"]="";
                    return $result;
                }
            }else{
                $result["estado"]=false;
                $result["mensaje"]="ya exite un funcionario con este codigo de tarjeta.";
                $result["result"] ="";
                return $result;
            }
        }else{
            $result["estado"]=false;
            $result["mensaje"]="Este usario ya se encuantra registrado como funcionario";
            $result["result"] ="";
            return $result;
        }
    }

    public function buscarinvitado(Request $request){
        $query = fucionarioModel::where('func_tdocumento_id', $request->tdocumento)->where('func_documento', $request->documento)->get();
        if(count($query)>0){
            $result["estado"]=true;
            $result["result"] = $query[0];
        }else{
            $result["estado"]=false;
        }
        return $result;
    }

    public function controlinvitados(){
        return view('coordinador.registroinvitados.controlinvitados');
    }

    public function gridinvitadosRFID(){
        $query = fucionarioModel::join('autorizacion', 'autorizacion.aut_funcionario_id', '=','funcionario.func_id')
        ->join('modulo','modulo.mod_id','=','autorizacion.aut_modulo_id')
        ->where('funcionario.func_estado_id', 1)
        ->where("funcionario.func_tfuncionario_id", 2)
        ->where("autorizacion.aut_estado_id", 1)
        ->where('autorizacion.aut_fecha_registro', date('Y-m-d'))->get();
        foreach ($query as $qu) {
            $qu->tdocumento;
        }    
        return json_encode(['data'=> $query]);
    }

    public function salidainvitado(Request $request){
        $autorizacion = autorizacionModel::find($request->aut_id);
        $autorizacion->aut_estado_id=2;
        $autorizacion->save();
        $invitado = fucionarioModel::find($request->func_id);
        $invitado->func_tarjeta = null;
        $invitado->save();
        $result['estado']=true;
        $result['mensaje'] ="Se dio de alta al invitado.";
        return $result;
    }    
}
