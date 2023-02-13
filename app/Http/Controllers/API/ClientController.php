<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Verifica se o cpf informado é válido
        if (! $this->validateCpf($request->cpf)) {
            return response()->json(['error' => 'CPF Inválido'], 400);
        }

        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'cpf' => 'required',
            'car_plate' => 'required',
        ]);

        $client = Client::create($validated);

        return response()->json($client, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $number
     * @return \Illuminate\Http\Response
     */
    public function showPlate($number)
    {
        /**
         * Consulta todos os clientes, onde
         * o último número da placa é igual
         * o número informado.
         */
        $clients = Client::whereRaw('SUBSTRING(car_plate, -1) = ?', [$number])->get();

        return response()->json($clients, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showClient($id)
    {

        //Retorna um cliente específico
        $client = Client::findOrFail($id);

        return response()->json($client, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Verifica se o cpf informado é válido
        if (! $this->validateCpf($request->cpf)) {
            return response()->json(['error' => 'CPF Inválido'], 400);
        }

        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'cpf' => 'required',
            'car_plate' => 'required',
        ]);

        $client = Client::findOrFail($id);
        $client->update($validated);

        return response()->json($client, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(null, 204);
    }

    public function validateCpf($cpf)
    {
        // Remove os caractéres que não são dígitos do CPF
        $cpf = preg_replace('/\D/', '', $cpf);

        // Verifica se o cpf tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se o CPF tem digitos repetidos
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Calcula o primeiro dígito de verificação
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += $cpf[$i] * (10 - $i);
        }

        $check1 = ($sum * 10) % 11;
        if ($check1 == 10) {
            $check1 = 0;
        }

        // Calcula o segundo dígito de verificação
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += $cpf[$i] * (11 - $i);
        }

        $sum += $check1 * 2;

        $check2 = ($sum * 10) % 11;
        if ($check2 == 10) {
            $check2 = 0;
        }

        //Verifica se os dígitos de verificação combinam com os do CPF
        return $check1 == $cpf[9] && $check2 == $cpf[10];
    }
}
