@extends($activeTemplate . 'layouts.' . $layout)


<!-- Dentro do modal -->
<div class="modal fade" id="numberTypeModal" tabindex="-1" aria-labelledby="numberTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="numberTypeModalLabel">Escolha o Tipo de Jogo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" onchange="atualizarEstiloTeclado()">
                <p>Por favor, escolha o tipo de jogo:</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="numberType" id="group" value="group">
                    <label class="form-check-label" for="group">
                        Grupo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="numberType" id="autoNumber" value="auto" checked>
                    <label class="form-check-label" for="autoNumber">
                        Número Automático
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="numberType" id="thousand" value="thousand">
                    <label class="form-check-label" for="thousand">
                        Milhar
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="numberType" id="thousandHundred" value="thousandHundred">
                    <label class="form-check-label" for="thousandHundred">
                        Milhar e Centena
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="numberType" id="hundred" value="hundred">
                    <label class="form-check-label" for="hundred">
                        Centena
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="numberType" id="combinedHundred" value="combinedHundred">
                    <label class="form-check-label" for="combinedHundred">
                        Centena Combinada
                    </label>
                </div>
            </div>
<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="continueToPurchase">Continuar</button>
            </div>
        </div>
    </div>
</div>





@section('content')
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                   
                  
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12">

                    @if ($phase->available)
                        @auth
                            <form class="submit-form" method="post" action="{{ route('user.buy.ticket') }}">
                                @csrf
                                <input name="lottery_id" type="hidden" value="{{ $phase->lottery->id }}">
                                <input name="phase_id" type="hidden" value="{{ $phase->id }}">

                                <div class="lottery-details-body">
                                    <div class="top-part">
                                        <div class="left">
                                            <h4>@lang('Available Ticket'): {{ __($phase->available) }}</h4>
                                            <h4 class="mt-2">@lang('Price'):
                                                {{ __($general->cur_sym) }}{{ __(showAmount($phase->lottery->price)) }}
                                            </h4>
                                        </div>
                                        <div class="middle">
                                            <div class="balance">@lang('Balance'):
                                                {{ __($general->cur_sym) }}{{ showAmount(auth()->user()->balance) }}
                                            </div>
                                        </div>
                                        <div class="right">
                                            <button class="btn btn-md btn-outline--base addMore" type="button"><i
                                                    class="la la-plus"></i> @lang('Add New')</button>
                                        </div>
                                    </div>
                                    <div class="body-part">
                                        <div class="row gy-4" id="tickets">

                                            <div class="col-xl-4 col-md-6">
                                                <div class="ticket-card">
                                                    <div class="ticket-card__header">
                                                        <h4>@lang('Your Ticket Number')</h4>
                                                    </div>
                                                    <div class="ticket-card__body elements">
                                                        <input class="numVal" name="number[]" type="hidden">
                                                        <div class="numbers uniqueNumbers mb-4">
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                        </div>
                                                        <button class="btn btn-md btn--base w-100 generate"
                                                            type="button">@lang('Generate')</button>
                                                    </div>
                                                </div><!-- ticket-card end -->
                                            </div>
                                        </div>
                                    </div>

           


                                        
                                        
<div class="selected-number mb-4 mt-4 d-flex align-items-center justify-content-center ">
    <span class="selected-number-label">Número selecionado:   </span>
    <span class="selected-number-value text-2xl"></span>
</div>


    @include('templates.basic.layouts.numeric-keypad')

<<div class="numero-buttons">
    <?php for ($i = 1; $i <= 25; $i++) : ?>
        <button class="btn btn-number" data-number="<?= $i ?>">
            <div class="image-container">
                <img src="/assets/images/bicho/img-bicho-<?= $i ?>.jpg" alt="Imagem <?= $i ?>">
                <div class="overlay">
                    <div class="top-text">Nome do animal</div>
                    <div class="middle-text"><?= sprintf("%02d", $i) ?></div>
                    <div class="bottom-text">
                        <?php for ($j = $i; $j <= $i + 3; $j++) : ?>
                            <?= sprintf("%02d", $j) ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </button>
    <?php endfor; ?>
</div>
 <!-- Botão para limpar a seleção atual -->
<div class="numeric-row mt-3 d-flex justify-content-center">
    <button type="button" class="btn btn-md btn-outline--base clear-selection">Limpar Seleção</button>
</div>
                                    <div class="footer-part gap-3">
                                        <div class="left">
                                            <p>@lang('1 sorteio com') <span class="qnt">1</span> @lang('ingresso') :
                                                <span class="qnt">1</span> x 
                                                {{ __($general->cur_sym) }}{{ __(showAmount($phase->lottery->price)) }}</p>
                                            <p class="mt-2">@lang('Total Amount') : <span class="tam">{{ __($general->cur_sym) }}{{ __(showAmount($phase->lottery->price)) }}</span>
                                                
                                            </p>
                                        </div>
                                        <div class="right">
                                            @auth
                                                <button class="btn btn-md btn-outline--base buyBtn"
                                                    type="button"><i class="la la-shopping-bag"></i> @lang('Buy Now')</button>
                                            @endauth
                                        </div>
                                    </div>
                                </div><!-- lottery-details-body end -->
                            </form>
                        @else
                            <div class="lottery-details-body">
                                <div class="top-part">
                                    <div class="left">
                                        <h4>@lang('Available Ticket'): {{ __($phase->available) }}</h4>
                                        <h4 class="mt-2">@lang('Price'):
                                            {{ __($general->cur_sym) }}{{ __(showAmount($phase->lottery->price)) }}
                                        </h4>
                                    </div>
                                </div>
                                <div class="footer-part gap-3">
                                    <div class="middle">
                                        <h4>@lang('Please log in to purchase lottery tickets')</h4>
                                    </div>
                                    <div class="right">
                                        <a href="{{ route('user.login') }}"><button
                                                class="btn btn-md btn-outline--base" type="button"><i
                                                    class="la la-user"></i> @lang('Login')</button></a>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    @else
                        <div class="lottery-details-body">
                            <div class="top-part">
                                <div class="w-100">
                                    <h4> @lang('All Tickets are sold') </h4>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="lottery-details-instruction mt-5">
                        <ul class="nav nav-tabs cumtom--nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active px-4" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">@lang('Instruction')</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link px-4" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">@lang('Win Bonuses')</button>
                            </li>
                            @auth
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-4" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#history" type="button" role="tab" aria-controls="history"
                                        aria-selected="false">@lang('Purchased Tickets')</button>
                                </li>
                            @endauth
                        </ul>
                        <div class="tab-content mt-4" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="d-block">
                                    <h3 class="mb-3">@lang('Introduction')</h3>
                                    @php echo $phase->lottery->instruction @endphp
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="table-responsive--md">
                                    <table class="level-table custom--table table">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase">@lang('Winners')</th>
                                                <th class="text-uppercase">@lang('Win Bonus')</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($phase->lottery->bonuses as $bonus)
                                                <tr>
                                                    <td class="text-white">@lang('Winner')- {{ $bonus->level }}</td>
                                                    <td class="text-white">{{ $bonus->amount }}
                                                        {{ __($general->cur_text) }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @auth
                                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                                    <div class="table-responsive--md">
                                        <table class="level-table custom--table table">
                                            <thead>
                                                <tr>
                                                    <th>@lang('S.N.')</th>
                                                    <th>@lang('Phase Number')</th>
                                                    <th>@lang('Ticket')</th>
                                                    <th>@lang('Result')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse(@$tickets as $ticket)
                                                    <tr>
                                                        <td>{{ $tickets->firstItem() + $loop->index }}</td>
                                                        <td>@lang('Phase ' . $ticket->phase->phase_number)</td>
                                                        <td> {{ $ticket->ticket_number }}</td>
                                                        <td>
                                                            @php
                                                                echo $ticket->statusBadge;
                                                            @endphp
                                                        </td>
                                                    @empty
                                                        <td class="text-center rounded-bottom" colspan="100%">{{ __($emptyMessage) }}</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center mt-3">
                                            @if ($tickets->hasPages())
                                                {{ paginateLinks($tickets) }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endauth

                        </div>
                    </div>
                </div>
            </div><!-- row end -->
        </div>
    </section>


    <!-- Modal -->
    @include($activeTemplate . 'partials.ticket_confirmation_modal')

    <!-- lottery details section end -->
@endsection

@push('script')


@push('style-lib')
    <link href="{{ asset('assets/css/keno.css') }}" rel="stylesheet">
@endpush

<style>
.image-container {
    position: relative;
    width: 190px; /* Largura da imagem */
    height: 120px; /* Altura da imagem */
    overflow: hidden;
    margin-bottom: 10px; /* Espaçamento entre as imagens */
}

.image-container img {
    width: 100%; /* Garante que a imagem ocupe toda a largura do container */
    height: auto; /* Altura automática para manter a proporção da imagem */
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Cor de fundo semi-transparente */
    color: #fff; /* Cor do texto */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    padding: 5px;
    box-sizing: border-box;
}

.top-text, .bottom-text {
    font-size: 20px; /* Tamanho do texto */
    text-align: center;
}

.middle-text {
    font-size: 30px; /* Tamanho do texto */
    font-weight: bold; /* Negrito */
}
</style>

    <script

    
    
    type="text/javascript">
        (function($) {
            "use strict";
            $(window).on('load', function() {
                var element = $('.elements').length;
                addMoreBtn(element);
            });

            $('.addMore').click(function() {
                var element = $('.elements').length + 1

                var html = `
                        <div class="col-xl-4 col-md-6 elem">
                            <div class="ticket-card">
                                <button type="button" class="ticket-card-del removeBtn"><i class="las la-times"></i></button>
                                <div class="ticket-card__header">
                                    <h4>@lang('Your Ticket Number')</h4>
                                </div>
                                <div class="ticket-card__body elements">
                                    <input type="hidden" class="numVal" name="number[]">
                                    <div class="numbers uniqueNumbers mb-4">
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                    </div>
                                    <button type="button" class="btn btn-md btn--base w-100 generate">@lang('Generate Number')</button>
                                </div>
                            </div>
                        </div>
                	`;
                $('#tickets').append(html);
                $('.qnt').html(element);
                $('.tam').html(element * {{ $phase->lottery->price }});
                $('input[name=ticket_quantity]').val(element);
                $('input[name=total_price]').val(element * {{ $phase->lottery->price }});
                randomTicketGenerate();
                remove();
                addMoreBtn(element);
            });

            function remove() {
                $('.removeBtn').click(function() {
                    $(this).parents('.elem').remove();
                    var elem = $('.elements').length;
                    addMoreBtn(elem);
                    $('.qnt').html(elem);
                    $('.tam').html(elem * {{ $phase->lottery->price }});
                    $('input[name=ticket_quantity]').val(elem);
                    $('input[name=total_price]').val(elem * {{ $phase->lottery->price }});
                });
            }

            function addMoreBtn(count) {
                if (count >= {{ $phase->available }}) {
                    $('.addMore').addClass('d-none');
                } else {
                    $('.addMore').removeClass('d-none');
                }
            }

            function randomTicketGenerate() {
                $('.generate').click(function() {
                    var randomNum = Math.floor(1000000000 + Math.random() * 9000000000);
                    var array = randomNum.toString().split('');
                    var newArray = [];

                    $.each(array, function(index, value) {
                        newArray[index] = `<span>${value}</span>`;
                    });

                    $(this).parents('.elements').children('.numbers').html(newArray);
                    $(this).parents('.elements').children('.numbers').addClass('active');
                    $(this).parents('.elements').children('.numbers').removeClass('op-0-3');
                    $(this).parents('.elements').children('.numVal').val(randomNum);
                });
            }

            $('.generate').click(function() {
                var tendigitrandom = Math.floor(1000000000 + Math.random() * 9000000000);
                var array = tendigitrandom.toString().split('');
                var newArray = [];

                $.each(array, function(index, value) {
                    newArray[index] = `<span>${value}</span>`;
                });

                $(this).parents('.elements').children('.numbers').html(newArray);

                $(this).parents('.elements').children('.numbers').addClass('active');
                $(this).parents('.elements').children('.numbers').removeClass('op-0-3');
                $(this).parents('.elements').children('.numVal').val(tendigitrandom);
            });
            
            
// Função para selecionar números ao escolher a opção "Centena"
    function selectCentenaNumber(number) {
        var currentNumbers = $('.numVal').val();
        if (currentNumbers.length < 3) {
            $('.numVal').val(currentNumbers + number);
            $('.selected-number-value').text(currentNumbers + number);
            console.log('Número selecionado:', $('.numVal').val());
        }
    }


    // Função para selecionar números ao escolher a opção "Centena Combinada"
    function selectCentenaCombinadaNumber(number) {
        var currentNumbers = $('.numVal').val();
        if (currentNumbers.length < 3) {
            $('.numVal').val(currentNumbers + number);
            $('.selected-number-value').text(currentNumbers + number);
            console.log('Número selecionado:', $('.numVal').val());
        }
    }
            
            


// Função para selecionar números ao escolher a opção "Milhar"
function selectMilharNumber(number) {
    var currentNumbers = $('.numVal').val();
    if (currentNumbers.length < 4) {
        $('.numVal').val(currentNumbers + number);
        // Atualize visualmente o número selecionado
        $('.selected-number-value').text(currentNumbers + number);
        console.log('Número selecionado:', $('.numVal').val()); // Registro de log do número selecionado
    }
}

// Função para selecionar números ao escolher a opção "Milhar"
function selectGrupoNumber(number) {
    var currentNumbers = $('.numVal').val();
    if (currentNumbers.length < 4) {
        $('.numVal').val(currentNumbers + number);
        // Atualize visualmente o número selecionado
        $('.selected-number-value').text(currentNumbers + number);
        console.log('Número selecionado:', $('.numVal').val()); // Registro de log do número selecionado
    }
}


$(document).ready(function() {
    // Atualize o evento de clique nos botões numéricos para chamar a função apropriada com base na opção selecionada
$(document).on('click', '.numeric-key', function() {
    var numberType = $('input[name="numberType"]:checked').val();
    if (numberType === 'thousand') {
        selectMilharNumber($(this).text());
    } else if (numberType === 'hundred') {
        selectCentenaNumber($(this).text());
    } else if (numberType === 'thousandHundred') {
        selectMilharNumber($(this).text());
    } else if (numberType === 'grupo') {
        selectGrupoNumber($(this).text());
    } else if (numberType === 'combinedHundred') {
        selectCentenaCombinadaNumber($(this).text());
    } else {
        var selectedNumber = $(this).text();
        console.log('Número selecionado:', selectedNumber); // Registro de log do número selecionado
        var currentNumbers = $('.numVal').val();
        // Adicione a lógica para permitir que o usuário selecione apenas números de 1 a 9
        if (currentNumbers && currentNumbers.length < 4 && selectedNumber >= 1 && selectedNumber <= 9) {
            $('.numVal').val(currentNumbers + selectedNumber);
        }
    }
});
});
            // Função para adicionar o modal de inicialização
            $(document).ready(function() {
                // Função para mostrar ou ocultar a parte do código que gera o número do bilhete
                function toggleTicketGeneration(visible) {
                    if (visible) {
                        $('.ticket-card').removeClass('d-none');
                    } else {
                        $('.ticket-card').addClass('d-none');
                    }
                }

        // Função para mostrar o teclado numérico
function showNumericKeypad() {
    var keypadHtml = '';
    for (var i = 1; i <= 9; i++) {
        keypadHtml += '<button type="button" class="btn btn-primary numeric-key">' + i + '</button>';
    }
    $('.numeric-keypad').html(keypadHtml);
    $('.numeric-keypad').removeClass('d-none');
}

// Função para exibir o teclado numérico específico para a opção "Centena Combinada"
function showCombinedHundredKeypad() {
    var combinedHundredHtml = '';
    for (var i = 0; i <= 9; i++) {
        for (var j = 0; j <= 9; j++) {
            combinedHundredHtml += '<button type="button" class="btn btn-primary numeric-key">' + i +  '</button>';
        }
    }
    $('.numeric-keypad').html(combinedHundredHtml);
    $('.numeric-keypad').removeClass('d-none');
}

                // Exibir o modal quando a página é carregada
                $('#numberTypeModal').modal('show');

                // Lidar com o clique no botão de continuar no modal
               $('#continueToPurchase').click(function() {
    var numberType = $('input[name="numberType"]:checked').val();

    // Verificar se o tipo selecionado é "Número Automático"
    if (numberType === 'auto') {
        toggleTicketGeneration(true); // Mostrar a parte do código que gera o número do bilhete
    } else {
        toggleTicketGeneration(false); // Ocultar a parte do código que gera o número do bilhete
    }

    // Verificar se o tipo selecionado é "Milhar" ou "Milhar e Centena" ou "Centena"
    if (numberType === 'thousand' || numberType === 'thousandHundred' || numberType === 'hundred' ||  numberType === 'combinedHundred') {
        showNumericKeypad(); // Mostrar o teclado numérico para seleção de milhar
    } else {
        $('.numeric-keypad').addClass('d-none'); // Ocultar o teclado numérico
    }

    // Fechar o modal após a escolha do usuário
    $('#numberTypeModal').modal('hide');
});
            });

         $('.buyBtn').on('click', function() {
    console.log('Botão "Comprar Agora" clicado');
    
    let emptyValueCheck = false;
    $.each($('#tickets').find('.numVal'), function(i, val) {
        if (!val.value) {
            emptyValueCheck = true;
        }
    });
    if (emptyValueCheck) {
        console.log('Campo de número do bilhete vazio!');
        notify('error', 'Campo de número do bilhete é obrigatório!');
        return;
    } else {
        console.log('Enviando formulário...');
        $('.submit-form').find('.buyBtn').html('<i class="la la-shopping-bag fa-spin"></i> Comprar Agora');
        
        var modal = $('#exampleModal');
        console.log('Exibindo modal de confirmação');
        modal.modal('show');
        $('.buyTicketConfirmation').on('click', function() {
            console.log('Confirmação de compra clicada');
            $('.submit-form').submit();
            console.log('Exibindo modal de confirmação');
            modal.modal('show');
        });
    }
});
        })(jQuery);
        
         // Espera até que o documento esteja completamente carregado
    document.addEventListener("DOMContentLoaded", function() {
        // Seleciona o botão "Limpar Seleção" pelo seletor de classe
        var clearButton = document.querySelector('.clear-selection');
        
        // Adiciona um evento de clique ao botão "Limpar Seleção"
        clearButton.addEventListener('click', function() {
            // Selecione o elemento de entrada onde o número selecionado é exibido
            var selectedNumberElement = document.querySelector('.selected-number-value');
            
            // Limpe o valor do número selecionado
            selectedNumberElement.textContent = '';
            
            // Limpe o valor do número armazenado na entrada oculta
            var numValInput = document.querySelector('.numVal');
            numValInput.value = '';
            
            // Log para confirmar que a limpeza foi realizada
            console.log('Seleção Limpa');
        });
    });
    
    // Função para atualizar o estilo do teclado numérico
function atualizarEstiloTeclado() {
    var tipoJogo = document.getElementById("tipoJogo").value; // Esta linha está causando o erro
    var teclado = document.getElementById("numeric-keypad");

    // Reiniciar estilos do teclado numérico
    teclado.classList.remove("tipo1", "tipo2");

    // Aplicar o estilo correspondente ao tipo de jogo selecionado
    if (tipoJogo === "tipo1") {
        teclado.classList.add("tipo1");
    } else if (tipoJogo === "tipo2") {
        teclado.classList.add("tipo2");
    }
}


    </script>
   
     <script type="text/javascript">
     var numerosSelecionados = [];
     
        // Função para selecionar números ao escolher a opção "Grupo"
function selectGroupNumber(number) {
    var currentNumbers = $('.numVal').val();
    if (currentNumbers.length < 3) {
        // Armazenar o número selecionado na variável
        numerosSelecionados.push(number);
        $('.numVal').val(currentNumbers + number);
        $('.selected-number-value').text(currentNumbers + number);
        console.log('Número selecionado:', $('.numVal').val());
    }
}
// Função para realizar a compra
function realizarCompra() {
    // Verificar se algum número foi selecionado
    if (numerosSelecionados.length === 0) {
        console.log('Nenhum número selecionado. Selecione pelo menos um número antes de comprar.');
        return;
    }

    // Realizar a lógica de compra aqui, utilizando os números armazenados em numerosSelecionados
    console.log('Compra realizada com sucesso! Números selecionados:', numerosSelecionados);

    // Limpar os números selecionados após a compra
    numerosSelecionados = [];
}
        // Evento de clique nos botões numerados
        $(document).on('click', '.btn-number', function() {
            selectGroupNumber($(this).attr('data-number'));
        });
        
        // Função para carregar imagens de fundo para cada botão numerado
        function carregarImagensDeFundo() {
    var buttons = document.querySelectorAll('.btn-number');
    buttons.forEach(function(button) {
        var numero = button.getAttribute('data-number');
        // Definir o fundo do botão como a imagem correspondente do servidor
        
    });
}

        // Chame a função ao carregar a página
        document.addEventListener('DOMContentLoaded', function() {
            carregarImagensDeFundo();
        });
        
// Mapeamento de número para nome de animal
var animalNames = {
   "01": "Avestruz",
    "02": "Águia",
    "03": "Burro",
    "04": "Borboleta",
    "05": "Cachorro",
    "06": "Cabra",
    "07": "Carneiro",
    "08": "Camelo",
    "09": "Cobra",
    "10": "Coelho",
    "11": "Cavalo",
    "12": "Elefante",
    "13": "Galo",
    "14": "Gato",
    "15": "Jacaré",
    "16": "Leão",
    "17": "Macaco",
    "18": "Porco",
    "19": "Pavão",
    "20": "Peru",
    "21": "Touro",
    "22": "Tigre",
    "23": "Urso",
    "24": "Veado",
    "25": "Vaca"
};

document.addEventListener("DOMContentLoaded", function() {
    var imageContainers = document.querySelectorAll('.image-container');
    imageContainers.forEach(function(container, index) {
        var numeroImagem = pad(index + 1, 2); // Formata o número da imagem com zero à esquerda (ex: 01, 02, ..., 10)
        container.querySelector('.top-text').textContent = animalNames[numeroImagem];
        container.querySelector('.middle-text').textContent = numeroImagem;
        container.querySelector('.bottom-text').textContent = generateSequence(numeroImagem, 4);
    });
});

// Função para gerar sequência de números consecutivos a partir de um número base
function generateSequence(base, count) {
    var sequence = [];
    var baseNumber = parseInt(base);
    for (var i = baseNumber; i < baseNumber + count; i++) {
        sequence.push(pad(i, 2));
    }
    return sequence.join(' ');
}

// Função para preencher um número com zeros à esquerda até atingir o tamanho desejado
function pad(number, size) {
    var padded = number.toString();
    while (padded.length < size) padded = "0" + padded;
    return padded;
}



// Ouvinte de eventos para o botão "Comprar Agora"
$('.buyBtn').on('click', function() {
    console.log('Botão "Comprar Agora" clicado');
    
    // Verifique se algum campo de número do bilhete está vazio
    let emptyValueCheck = false;
    $.each($('#tickets').find('.numVal'), function(i, val) {
        if (!val.value) {
            emptyValueCheck = true;
        }
    });
    
    // Se algum campo de número do bilhete estiver vazio, mostre uma mensagem de erro e retorne
    if (emptyValueCheck) {
        console.log('Campo de número do bilhete vazio!');
        notify('error', 'Campo de número do bilhete é obrigatório!');
        return;
    } else {
        // Se todos os campos de número do bilhete estiverem preenchidos, prossiga com a compra
        console.log('Enviando formulário...');
        $('.submit-form').find('.buyBtn').html('<i class="la la-shopping-bag fa-spin"></i> Comprar Agora');
        
        // Mostrar modal de confirmação
        var modal = $('#exampleModal');
        console.log('Exibindo modal de confirmação');
        modal.modal('show');
        
        // Lidar com o clique de confirmação
        $('.buyTicketConfirmation').on('click', function() {
            console.log('Confirmação de compra clicada');
            $('.submit-form').submit();
            console.log('Exibindo modal de confirmação');
            modal.modal('show');
        });
    }
});
    </script>
@endpush