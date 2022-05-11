<?php

namespace App\Http\Controllers;
use PagSeguro;
use App\Http\Requests\PagamentoRequest;
use App\Models\Pagamento;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    public function index() {
        $pagamentos = Pagamento::all();

        return view('pagamento.index', compact("pagamentos"));
    }

    public function store(PagamentoRequest $request) {

        $pagamento = new Pagamento();
        $pagamento->valor = $request->valor;
        $pagamento->status_transacao= false;
        $pagamento->hash_pagamento = $request->senderHash;
        $pagamento->investidor_id = auth()->user()->investidor->id;
        $pagamento->save();

        $pagseguro = PagSeguro::setReference($pagamento->id)
            ->setSenderInfo([
                'senderName' => auth()->user()->name, //Deve conter nome e sobrenome
                'senderPhone' => '(99) 9999-9999', //Código de área enviado junto com o telefone
                'senderEmail' => auth()->user()->email,
                'senderHash' => $pagamento->hash_pagamento,
                'senderCPF' => auth()->user()->cpf //Ou CNPJ se for Pessoa Júridica
            ])
            ->setCreditCardHolder([
                'creditCardHolderBirthDate' =>'20/10/1998',
            ])
            ->setShippingAddress([
                'shippingAddressStreet' => 'Aluisio Pinto',
                'shippingAddressNumber' => '428',
                'shippingAddressDistrict' => 'Magano',
                'shippingAddressPostalCode' => '55294-902',
                'shippingAddressCity' => 'Garanhuns',
                'shippingAddressState' => 'PE'
            ])
            ->setItems([
                [
                    'itemId' => $pagamento->id,
                    'itemDescription' => 'AnjoCoins',
                    'itemAmount' =>  $pagamento->valor, //Valor unitário
                    'itemQuantity' => '1', // Quantidade de itens
                ]
            ])
            ->send([
                'paymentMethod' => 'creditCard',
                'creditCardToken' => $request->token_cartao,
                'installmentQuantity' => '1',
                'installmentValue' => $pagamento->valor,
            ]
        );
        

        return $request;
    }

    public function create() {

      return view('pagamento.create');
    }


}
