//EXECUTAR MASCARAS
function mascara(o, f) {
    objeto = o;
    funcao = f;
    setTimeout("executaMascara()", 1);
}

function executaMascara() {
    objeto.value = funcao(objeto.value);
}

//MASCARAS

//Mascara do CPF
function CPF(variavel) {
    variavel = variavel.replace(/\D/g, "");
    variavel = variavel.replace(/(\d{3})(\d)/, "$1.$2");
    variavel = variavel.replace(/(\d{3})(\d)/, "$1.$2");
    variavel = variavel.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    return variavel
}

function RG(variavel) {
    variavel = variavel.replace(/\D/g, "");
    variavel = variavel.replace(/(\d{2})(\d)/, "$1.$2");
    variavel = variavel.replace(/(\d{3})(\d)/, "$1.$2");
    variavel = variavel.replace(/(\d{3})(\d{1})$/, "$1-$2");
    return variavel;
}

function CEP(variavel) {
    variavel = variavel.replace(/\D/g, "");
    variavel = variavel.replace(/(\d{5})(\d)/, "$1-$2");
    return variavel;
}

//g é a flag de "global", ou seja, ele vai procurar todos os caracteres não numéricos na string, e não só o primeiro.
//"": isso indica que ele vai substituir os caracteres não numéricos por nada — ou seja, vai removê-los.

function NOME(variavel) {
    variavel = variavel.replace(/[^A-Za-zÀ-ÿ\s]/g, "");
    variavel = variavel.trim().replace(/\s+/g, " ");
    variavel = variavel.toLowerCase().replace(/(^\w{1})|(\s+\w{1})/g, letra => letra.toUpperCase());
    return variavel;
}
//trim() é um método do JavaScript usado para remover os espaços em branco do início e do fim de uma string.

function SOBRENOME(variavel) {
    variavel = variavel.replace(/[^A-Za-zÀ-ÿ\s]/g, "");
    variavel = variavel.trim().replace(/\s+/g, " ");
    variavel = variavel.toLowerCase().replace(/(^\w{1})|(\s+\w{1})/g, letra => letra.toUpperCase());
    return variavel;
}

function RUA(variavel) {
    variavel = variavel.replace(/[^A-Za-zÀ-ÿ\s]/g, "");
    variavel = variavel.toLowerCase().replace(/(^\w)|(\s\w)/g, letra => letra.toUpperCase());
    return variavel;
}

function BAIRRO(variavel) {
    variavel = variavel.replace(/[^A-Za-zÀ-ÿ\s]/g, "");
    variavel = variavel.toLowerCase().replace(/(^\w{1})|(\s+\w{1})/g, letra => letra.toUpperCase());
    return variavel;
}

function CIDADE(variavel) {
    variavel = variavel.replace(/[^A-Za-zÀ-ÿ\s]/g, "");
    variavel = variavel.toLowerCase().replace(/(^\w{1})|(\s+\w{1})/g, letra => letra.toUpperCase());
    return variavel;
}

function NUM(variavel) {
    return variavel.replace(/[^0-9a-zA-Z\-]/g, '');
}

function EMAIL(variavel) {
    variavel = variavel.trim();
    variavel = variavel.replace(/[^a-zA-Z0-9@._-]/g, "");
    return variavel;

}

function LOGIN(variavel) {
    variavel = variavel.replace(/[^a-zA-Z0-9._-]/g, "");
    variavel = variavel.trim().replace(/\s+/g, "");
    return variavel;
}

function FONE(variavel){
    variavel = variavel.replace(/\D/g, "");
    variavel = variavel.slice(0, 11);
    return variavel;
}