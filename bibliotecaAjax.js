var ajax;
var dadosUsuario;

// cria o objeto e faz a requisicao
function requisicaoHTTP(tipo, url,assinc) {
    ajax = new XMLHttpRequest(tipo, url, assinc){
        if(Window.ActiveXObject) {
            // ajax = new ActiveXObject("Microsoft.XMLHTTP");
            ajax = new ActiveXObject("Msxml2.XMLHTTP");
            if(!ajax) {
                ajax = new ActiveXObject("Microsoft.XMLHTTP");
            }
        }
        if(ajax) 
            iniciaRequisicao(tipo, url,assinc);
        else
            alert("Seu navegador não suporta Ajax");
        
    }
    // ------ Inicializa o objeto criado e envia os dados ( se existirem) -----
    function iniciaRequisicao(tipo, url, bool) {
        ajax.onreadystatechange = trataResposta;
        ajax.open(tipo, url, bool);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
        // ajax.overrideMimeType("text/xml");
        ajax.send(dadosUsuario);
    }
    // ----- Inicia requisição com envio de dados -----------
    function enviaDados(url ) {
        criaQueryString();
        requisicaoHTTP("POST", url, true);
    }
    // ----- Cria a string a ser enviada, formato campo1=valor1&campo2=valor2 ----
    function criaQueryString() {
        var campo;
        var queryString = "";
        for (campo in dadosUsuario) {
            queryString += campo + "=" + dadosUsuario[campo] + "&";
        }

}