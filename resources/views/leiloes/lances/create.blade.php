<x-app-layout>
    <div class="container"
        style="margin-top: 50px;">
        <div class="row">
            @if(session('message'))
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                </svg>

                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                        {{session('message')}}
                    </div>
                </div>
            @elseif(session('error'))
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                      </symbol>
                </svg>

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                        {{session('error')}}
                    </div>
                </div>
            @endif
        </div>
        <div class="card card-feature">
            <div class="card-body bg-azul px-0 pt-1 flex flex-wrap">
                <div class="w-full flex justify-end">
                    <div class="w-1/4 flex justify-center">
                        <button type="button" id="menu">
                            <img src="{{ asset('img/menu.svg') }}"
                                alt="botao">
                        </button>
                    </div>
                </div>
                <div id="formulario" class="mb-9 mt-2 px-0 bg-fundo md:w-3/4 w-full">
                    <form action="{{route('leiloes.lances.store', ['leilao' => $leilao])}}" method="POST">
                        @csrf
                        <div class="mx-10 mt-12 pt-3">
                            <h2>Fazendo um lance para o leilão do produto {{ $leilao->proposta->startup->nome }}</h2>
                            <div class="grid justify-items-end">
                                <label>
                                    <span class="text-red">*</span>
                                    Campo obrigatório
                                </label>
                            </div>
                            <div class="bg-[#FFD6D6] text-center py-3 text-[#2F0E0E]">
                                Faça um lance maior que R$ {{ number_format($leilao->valor_corte(), 2, ',', '.') }} para conseguir o produto
                            </div>
                            <div class="flex mt-3">
                                <div class="w-1/2 bg-[#DADADA] mr-2 text-center py-3">
                                    Valor na carteira: <span class="text-[#03A000]">R$
                                        {{ number_format(auth()->user->investidor->carteira, 2, ',', '.') }}</span>
                                </div>
                                <div class="w-1/2 bg-[#DADADA] ml-2 text-center py-3">
                                    Lance mínimo: <span class="text-red">R$ {{ number_format($leilao->valor_minimo, 2, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="grid justify-items-center">
                                <div class="justify-items-start mt-10">
                                    <div>
                                        <label for="valor">Valor do lance <span class="text-red">*</span></label>
                                    </div>
                                    <div>
                                        <img src=" {{ asset('img/dolar.svg') }} "
                                            alt="icone de dinheiro"
                                            class="h-10">
                                        <input max="{{ auth()->user()->investidor->carteira }}"
                                            type="text"
                                            name="valor"
                                            id="valor"
                                            value="{{ old('valor', number_format($leilao->valor_minimo, 2, ',', '.')) }}"
                                            class="bg-fundo border-x-0 border-t-0 border-b-2 mb-2">
                                    </div>
                                    @if ($leilao->valor_minimo > auth()->user()->investidor->carteira)
                                        <div class="mx-2 text-left text-red w-72">
                                            Você não possui o valor mínimo na carteira para fazer um lance.
                                            <a href="#">Compre mais AnjoCoins aqui</a>
                                        </div>
                                    @endif
                                </div>
                                <button id="salvar" type="submit"
                                    class="mt-12 mb-3 btn btn-primary btn-padding border bg-verde w-80">Fazer
                                    lance
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="collapseExample" class="pt-0 px-0 md:w-1/4 w-full">
                    <div class="grid justify-center">
                        <div>
                            <h6 class="text-white text-center font-bold mt-3">Investidores contemplados no momento</h6>
                            <div>
                                @foreach ($leilao->lances as $lance)
                                    <div class="flex flex-wrap text-xs">
                                        <div class="w-full flex justify-center mr-12">
                                            <img src="{{asset('img/logo.png')}}" class="w-32" alt="logo">
                                            <img class="rounded-full w-8 h-8 -ml-[80px] mt-[34px]" src="{{ $lance->investidor->user->profile_photo_url }}" alt="foto de {{ $lance->investidor->user->name }}">
                                        </div>
                                        <div class="w-full -mt-5">
                                            <div class="flex justify-end text-white">
                                                <div class="w-1/2">
                                                    <p class="my-0 font-bold">
                                                        {{$lance->investidor->user->name}}
                                                    </p>
                                                    <p class="my-0">
                                                        R$ {{number_format($lance->valor, 2,",",".")}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#valor').mask('#.##0,00', {
                reverse: true
            });
            $('#menu').click(function() {
                $('#collapseExample').toggleClass('hidden');
                $('#formulario').toggleClass('md:w-3/4');
            });
        });
    </script>
</x-app-layout>
