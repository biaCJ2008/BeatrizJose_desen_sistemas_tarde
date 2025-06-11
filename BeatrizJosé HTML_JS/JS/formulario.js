//EXECUTAR MASCARAS

function mascara(o, f) { //DEFINE O OBJETO E CHAMA FUNCAO
    objeto=o
    funcao=f
    setTimeout("executaMascara()",1)
}

function executaMasca() {
    objeto.value=funcao(objeto.value)
}

//MASCARAS


//Mascara do Telefone

function telefone(variavel) {
    variavel=variavel.replace (/\D/g,"") //Remove tudo que não é digito

    // A LINHA ABAIXO É RESPONSAVEL DE ADICIONAR PARENTESES EM VOLTA DOS DOIS PRIMEIROS DIGITOS
    variavel=variavel.replace (/^(\d\d)(\d)/g,"($1) $2")
    
    //A LINHA ABAIXO É RESPONSAVEL DE ADICIONAR O HIFEM ENTRE O QUARTO E O QUINTO DIGITO
    variavel=variavel.replace (/(\d{4})(\d)/,"$1-$2") //Coloca a segunda barra
    return variavel
}

//Mascara do RG e CPF
function RGeCPF(variavel){
    variavel=variavel.replace (/\D/g,"") //Remove tudo o que não é número

    //Coloca um ponto após o terceiro dígito e o quarto
    variavel=variavel.replace (/(\d{3})(\d)/,"$1.$2")

    //Coloca um ponto após o sexto digito e o sétimo digito
    variavel=variavel.replace (/(\d{3})(\d)/,"$1.$2")


    //Coloca um HIFEM após o sétimo digito e permite apenas 2 digitos após o HIFEM
    variavel=variavel.replace (/(\d{3})(\d{1,2})$/,"$1-$2")
}

//Mascara do CEP
function cep(variavel) {
    variavel=variavel.replace (/\D/g,"") //Remove tudo o que não é digito
    

    variavel=variavel.replace (/(\d{2})(\d)/,"$1.$2") //Coloca a segunda barra

    variavel=variavel.replace (/(\d{3})(\d{1,3})$/,"$1.$2")
    return variavel
}

//Mascara DATA
function data(variavel){
    variavel=variavel.replace(/\D/g,"") //Remove tudo o que não é dígito
    variavel=variavel.replace(/(\d{2})(\d)/,"$1/$2") //Coloca a primeira barra
    variavel=variavel.replace(/(\d{2})(\d)/,"$1/$2")
    return variavel
}
