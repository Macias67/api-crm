<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Models\UsuarioTokens;
use App\Http\Requests\Create\TokenRequest;
use App\Http\Requests\Update\TokenUpdateRequest;
use App\Transformers\TokenTransformer;
use Dingo\Api\Routing\Helpers;

class Tokens extends Controller
{
	use Helpers;
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \App\Http\Requests\Create\TokenRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(TokenRequest $request)
	{
		$idUsuario = $request->get('id_usuario');
		$token = $request->get('token');
		
		$usuarioToken = UsuarioTokens::where('token', $token)->get();
		
		if ($usuarioToken->isEmpty())
		{
			$usuarioToken = new UsuarioTokens();
			$usuarioToken->id_usuario = $idUsuario;
			$usuarioToken->token = $token;
			$usuarioToken->save();
			
			return $this->response->item($usuarioToken, new TokenTransformer());
		} else {
			return $this->response->item($usuarioToken->first(), new TokenTransformer());
		}
		
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \App\Http\Requests\Update\TokenUpdateRequest $request
	 *
	 * @return \Illuminate\Http\Response         *
	 */
	public function update(TokenUpdateRequest $request)
	{
		$id = $request->get('id');
		$usuarioToken = UsuarioTokens::find($id);
		$usuarioToken->token = $request->get('token');
		$usuarioToken->save();
		
		return $this->response->item($usuarioToken, new TokenTransformer());
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
