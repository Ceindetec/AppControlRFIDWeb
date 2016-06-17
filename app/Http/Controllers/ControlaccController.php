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
        $query = autorizacionModel::where('aut_modulo_id', $request->mod_id)->where('aut_estado_id',1)->get();
        foreach ($query as $qu) {
            $qu->getfuncionario->tdocumento;
        }
        return ['data'=>$query];
    }

    public function configuraraccmoduloRFID($id){

        $query = moduloModel::find($id);
        return view('coordinador.controlacc.configuraraccmodulo', compact('query'));
    }

    public function gridnoautorizadosRFID(Request $request){
        $this->modulo = $request->mod_id;
        $query = fucionarioModel::where('func_estado_id', 1)
        ->whereNotIn('func_id',function($query){
            $query->select('aut_funcionario_id')
            ->from('autorizacion')
            ->where('autorizacion.aut_modulo_id', $this->modulo)
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
        ->whereIn('func_id',function($query){
            $query->select('aut_funcionario_id')
            ->from('autorizacion')
            ->where('autorizacion.aut_modulo_id', $this->modulo)
            ->where('autorizacion.aut_estado_id',1);
        })->get();
        foreach ($query as $qu) {
            $qu->tdocumento;
        }
        return ['data'=>$query];
    }

    public function agregarfuncionariomoduloRFID(Request $request){
        $exite = 0;
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
            }else{
                $query = autorizacionModel::select('aut_id')->where('aut_funcionario_id', $request->func_id)->where('aut_modulo_id', $request->mod_id)->where('aut_estado_id',2)->get();
                $datos = autorizacionModel::find($query[0]->aut_id);
                $datos->aut_estado_id=1;
                $datos->save();
            }
        }catch(Exception $e){

        }
    }


    public function eliminarfuncionariomoduloRFID(Request $request){
        $query = autorizacionModel::select('aut_id')->where('aut_funcionario_id', $request->func_id)->where('aut_modulo_id', $request->mod_id)->where('aut_estado_id',1)->get();
        //dd();
        $datos = autorizacionModel::find($query[0]->aut_id);
        $datos->aut_estado_id=2;
        $datos->save();
    }

    public function prueba(Request $request){
        dd($request->name);
    }
}
