<?php

namespace accesorfid\Http\Controllers;

use Illuminate\Http\Request;

use accesorfid\Http\Requests;
use accesorfid\Http\Controllers\Controller;
use accesorfid\accesoModel;
use accesorfid\moduloModel;
use accesorfid\fucionarioModel;
use  Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;


class reporteController extends Controller
{
	private $DataSet;

	public function reporteIngresoPorModulo()
	{
		return view('coordinador.reportes.reporteIngresoPorModulo');
	}

	public function dataReporteIngresoPorModulo(Request $request)
	{
		try 
		{
			if ($request->modulo) 
			{
				if (date("Y-m-d", strtotime($request->fecha_desde)) <= date("Y-m-d", strtotime($request->fecha_hasta))) 
				{
					if ($request->hora_desde!="" || $request->hora_hasta!="")
					{

						$query = accesoModel::whereBetween('acc_fecha', [date("Y-m-d", strtotime($request->fecha_desde)), date("Y-m-d", strtotime($request->fecha_hasta))])
						->whereBetween('acc_hora', [date("H:i",strtotime($request->hora_desde)), date("H:i",strtotime($request->hora_hasta))])
						->where('acc_modulo_id',$request->modulo)
						->get();

						foreach($query as $value)
						{
							$value->funcionario->tdocumento;
						}

						$result['estado']=true;
						$result['mensaje']='Carga finalizada.';

						$result['data']=$query;


					} 
					else 
					{

						$query = accesoModel::whereBetween('acc_fecha', [$request->fecha_desde, $request->fecha_hasta])
						->where('acc_modulo_id',$request->modulo)
						->get();

						foreach($query as $value) 
						{
							/*TO DO: agregar columna tdocumento*/
							$value->funcionario->tdocumento;
						}

						$result['estado']=true;
						$result['mensaje']='Carga finalizada.';

							// return json_encode($query);	
						$result['data']=$query;

					}
				}
				else  
				{
					$result['estado']=false;
					$result['mensaje']='Debes seleccionar una fecha inicial menor a la fecha final.';
				}
			}
			else  
			{
				$result['estado']=false;
				$result['mensaje']='Debes seleccionar una sección para generar el reporte.';
			}

		}
		catch(Exception $e)
		{
			$result['estado']=false;
			$result['mensaje']='Ocurrio un error durante la carga de datos del reporte';
		}

		return json_encode($result);

	}

	public function reporteIngresoPorFuncionario() {
		return view('coordinador.reportes.reporteIngresoPorFuncionario');
	}

	public function dataReporteIngresoPorFuncionario(Request $request) {

		try 
		{
			if ($request->funcionario) 
			{
				if ($request->modulo) 
				{
					if ($request->fecha_desde && $request->fecha_hasta) 
					{
						if (date("Y-m-d", strtotime($request->fecha_desde)) <= date("Y-m-d", strtotime($request->fecha_hasta))) 
						{
							if ($request->hora_desde!="" || $request->hora_hasta!="")
							{

									//REPORTE CON FUNCIONARIO - MODULO - FECHA - HORA

								$query = accesoModel::whereBetween('acc_fecha', [date("Y-m-d", strtotime($request->fecha_desde)), date("Y-m-d", strtotime($request->fecha_hasta))])
								->whereBetween('acc_hora', [date("H:i",strtotime($request->hora_desde)), date("H:i",strtotime($request->hora_hasta))])
								->where('acc_modulo_id',$request->modulo)
								->where('acc_funcionario_id',$request->funcionario)
								->get();

								foreach($query as $value)
								{
									$value->funcionario->tdocumento;
								}

								$result['estado']=true;
								$result['mensaje']='Carga finalizada.';

								$result['data']=$query;

							} 
							else 
							{
									//REPORTE CON FUNCIONARIO - MODULO - FECHA

								$query = accesoModel::whereBetween('acc_fecha', [$request->fecha_desde, $request->fecha_hasta])
								->where('acc_modulo_id',$request->modulo)
								->where('acc_funcionario_id',$request->funcionario)
								->get();

								foreach($query as $value) 
								{
									$value->funcionario->tdocumento;
								}

								$result['estado']=true;
								$result['mensaje']='Carga finalizada.';

								$result['data']=$query;

							}
						}
						else  
						{
							$result['estado']=false;
							$result['mensaje']='Debes seleccionar una fecha inicial menor a la fecha final.';
						}
					}
					else  
					{							
							//REPORTE CON FUNCIONARIO - MODULO - HORA

						if ($request->hora_desde!="" || $request->hora_hasta!="")
						{						
							$query = accesoModel::whereBetween('acc_hora', [date("H:i",strtotime($request->hora_desde)), date("H:i",strtotime($request->hora_hasta))])
							->where('acc_modulo_id',$request->modulo)
							->where('acc_funcionario_id',$request->funcionario)
							->get();

							foreach($query as $value)
							{
								$value->funcionario->tdocumento;
							}

							$result['estado']=true;
							$result['mensaje']='Carga finalizada.';

							$result['data']=$query;

						} 
						else 
						{

								//REPORTE CON FUNCIONARIO - MODULO

							$query = accesoModel::where('acc_modulo_id',$request->modulo)
							->where('acc_funcionario_id',$request->funcionario)
							->get();

							foreach($query as $value) 
							{
								$value->funcionario->tdocumento;
							}

							$result['estado']=true;
							$result['mensaje']='Carga finalizada.';

							$result['data']=$query;

						}
					}
				}
				else  
				{
					if ($request->fecha_desde && $request->fecha_hasta) 
					{
						if (date("Y-m-d", strtotime($request->fecha_desde)) <= date("Y-m-d", strtotime($request->fecha_hasta))) 
						{
							if ($request->hora_desde!="" || $request->hora_hasta!="")
							{

									//REPORTE CON FUNCIONARIO - FECHA - HORA

								$query = accesoModel::whereBetween('acc_fecha', [date("Y-m-d", strtotime($request->fecha_desde)), date("Y-m-d", strtotime($request->fecha_hasta))])
								->whereBetween('acc_hora', [date("H:i",strtotime($request->hora_desde)), date("H:i",strtotime($request->hora_hasta))])									
								->where('acc_funcionario_id',$request->funcionario)
								->get();

								foreach($query as $value)
								{
									$value->funcionario->tdocumento;
								}

								$result['estado']=true;
								$result['mensaje']='Carga finalizada.';

								$result['data']=$query;

							} 
							else 
							{
									//REPORTE CON FUNCIONARIO - FECHA

								$query = accesoModel::whereBetween('acc_fecha', [$request->fecha_desde, $request->fecha_hasta])									
								->where('acc_funcionario_id',$request->funcionario)
								->get();

								foreach($query as $value) 
								{
									$value->funcionario->tdocumento;
								}

								$result['estado']=true;
								$result['mensaje']='Carga finalizada.';

								$result['data']=$query;

							}
						}
						else  
						{
							$result['estado']=false;
							$result['mensaje']='Debes seleccionar una fecha inicial menor a la fecha final.';
						}
					}
					else  
					{

							//REPORTE CON FUNCIONARIO - HORA

						if ($request->hora_desde!="" || $request->hora_hasta!="")
						{						
							$query = accesoModel::whereBetween('acc_hora', [date("H:i",strtotime($request->hora_desde)), date("H:i",strtotime($request->hora_hasta))])								
							->where('acc_funcionario_id',$request->funcionario)
							->get();

							foreach($query as $value)
							{
								$value->funcionario->tdocumento;
							}

							$result['estado']=true;
							$result['mensaje']='Carga finalizada.';

							$result['data']=$query;

						} 
						else 
						{

								//REPORTE CON FUNCIONARIO

							$query = accesoModel::where('acc_funcionario_id',$request->funcionario)
							->get();

							foreach($query as $value) 
							{
								$value->funcionario->tdocumento;
							}

							$result['estado']=true;
							$result['mensaje']='Carga finalizada.';

							$result['data']=$query;

						}
					}
				}
			}
			else  
			{
				$result['estado']=false;
				$result['mensaje']='Debes seleccionar un funcionario para generar el mensaje.';
			}
		}
		catch(Exception $e)
		{
			$result['estado']=false;
			$result['mensaje']='Ocurrio un error durante la carga de datos del reporte';
		}

		return json_encode($result);

	}

	public function getModulosDisponibles(){
		$query = moduloModel::select('mod_id','mod_nombre')->where('mod_estado', 1)->get();
		return $query;
	}

	public function getFuncionarioDisponibles(){
		$query = fucionarioModel::select('func_id','func_nombres','func_apellidos')->where('func_tfuncionario_id',1)->get();
		foreach($query as $value)
		{
			$value['func_nombres']=$value['func_nombres'].' '.$value['func_apellidos'];
		}
		return $query;
	}

	public function obtenerReporteIngresoPorModulo(Request $request)
	{
		
		for($i=0;$i<count($request->data);$i++){
			$this->DataSet[$i]["Tipo_documento"] = $request->data[$i]['funcionario']['tdocumento']['tdoc_sigla'];
			$this->DataSet[$i]["Documento"] = $request->data[$i]['funcionario']['func_documento'];
			$this->DataSet[$i]["Nombres"] = $request->data[$i]['funcionario']['func_nombres']." ".$request->data[$i]['funcionario']['func_apellidos'];
			$this->DataSet[$i]["Fecha"] = $request->data[$i]['acc_fecha'];
			$this->DataSet[$i]["Hora"] = $request->data[$i]['acc_hora'];
		}
		Excel::create('Reporte ingreso por modulo', function($excel) {
			$excel->sheet('Reporte', function($sheet) {
				$sheet->fromArray($this->DataSet);

			});
		})->store('xls');
	}

	public function getreportemoduloxls(){
		$contents = Storage::disk('local')->get('Reporte ingreso por modulo.xls');
 
		return (new Response($contents, 200))
              ->header('Content-Type', 'application/vnd.ms-excel');
	}


}														