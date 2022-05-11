<x-app-layout>
    <div class="container" style="margin-top: 50px;">
        <div class="card card-feature">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 div-checks">
                        <div class="row mb-4 mt-4" style="text-align: center;">
                            <div class="col-md-12">
                                <a href="{{route('pagamento.index')}}" class="btn btn-success btn-padding border"><img src="{{asset('img/back.svg')}}" alt="Icone de voltar" style="padding-right: 5px; height: 22px;"> Voltar</a>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="card-title" style="font-size: 22px;">Adicionando créditos a minha carteira</h5>
                        </div>
                    </div>
                    <div class="col-md-8 div-form">
                        <form class="" method="POST" id="pagamentoForm" action="{{route('pagamento.store')}}">
                            @csrf
                            <div class="container" style="margin-top: 15px; margin-bottom: 15px;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2>Adicionando créditos</h2>
                                    </div>
                                </div>
                                <div class="row" style="text-align: right;">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <label><span style="color: red;">*</span> Campo obrigatório</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="valor" class="form-label">Valor<span style="color: red;">*</span></label>
                                        <input class="form-control dinheiro @error('valor') is-invalid @enderror" name="valor" id="valor" type="text" value="{{old("valor")}}">

                                        @error('valor')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="n_cartao" class="form-label">Número do cartão<span style="color: red;">*</span></label>
                                        <input class="form-control cartao @error('n_cartao') is-invalid @enderror" name="n_cartao" id="n_cartao" type="text" value="{{old("n_cartao")}}">

                                        @error('n_cartao')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="nome" class="form-label">Nome do cartão<span style="color: red;">*</span></label>
                                        <input class="form-control @error('nome') is-invalid @enderror" name="nome" id="nome" type="text" value="{{old("nome")}}">

                                        @error('nome')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="data" class="form-label">Data de expiração<span style="color: red;">*</span></label>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control @error('mes') is-invalid @enderror" name="mes" id="mes">
                                            @for ($i=1;$i<=12;$i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                         </select>

                                        @error('mes')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <select class="form-control @error('ano') is-invalid @enderror" name="ano" id="ano">
                                            @for ($i=22;$i<=44;$i++)
                                                <option value="20{{$i}}">20{{$i}}</option>
                                            @endfor
                                         </select>

                                        @error('ano')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="cvv" class="form-label">Código de segurança (CVV)
                                            <span style="color: red;">*</span>
                                        </label>
                                        <input class="form-control cvv @error('cvv') is-invalid @enderror" name="cvv" id="cvv" type="text" value="{{old("cvv")}}">

                                        @error('cvv')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <input name="senderHash" id="senderHash" type="hidden" value="">
                                <input name="band_cartao" id="band_cartao" type="hidden" value="">
                                <input name="token_cartao" id="token_cartao" type="hidden" value="">

                                <div class="row mt-4" style="text-align: center;">
                                    <div class="col-md-12">
                                        <button id="submeter" class="btn btn-success submit-form-btn" type="button" style="width: 40%;">Pagar</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="row" style="text-align: left;">
                    <div class="col-md-4"></div>
                    <div class="col-md-8" style="position: relative; left: -22px; padding-right: -200px;">
                        <div class="bottom-form" class="row mt-3" style="margin-left: 10px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        PagSeguroDirectPayment.setSessionId('{{ PagSeguro::startSession() }}');

        $(document).ready(function(){
            $('.dinheiro').mask('#.##0,00', {reverse: true});
            $('.cvv').mask('000');
            $('.cartao').mask('0000 0000 0000 0000');

            $('#submeter').click(function(){
                $('#senderHash').val(PagSeguroDirectPayment.getSenderHash());
                get_bandeira();
                consultar_token_cartao();
                setTimeout(submeter_form, 3000);
            });
        });

        function submeter_form(){
            $('#pagamentoForm').submit();
        }

        function consultar_token_cartao() {

            var param = {
                cardNumber: $("#n_cartao").val().replace(/\s/g, ''),
                cvv: $("#cvv").val(),
                expirationMonth: $("#mes").val(),
                expirationYear: $("#ano").val(),
                success: function(response) {
                    console.log(response.card.token);
                    $("#token_cartao").val(response.card.token);
                },
                error: function(response) {
                },
                complete: function(response) {
                }
            }

            if($("#band_cartao").val() != '') {
                param.brand = $("#band_cartao").val();
            }
            PagSeguroDirectPayment.createCardToken(param);
        }

        function bin_cartao() {
            var bin = $('#n_cartao').val();
            bin = bin.replace(/\s/g, '');
            bin = bin.slice(0, 6);
            return bin;
        }

        function get_bandeira() {
           PagSeguroDirectPayment.getBrand({
                cardBin: bin_cartao(),
                success: function(response) {
                    $("#band_cartao").val(response.brand.name);
                },
                error: function(response) {
                },
                complete: function(response) {
                }
            });
        }
    </script>
</x-app-layout>
