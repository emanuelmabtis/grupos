<?php
require 'vendor/autoload.php'; // Mercado Pago SDK

// === CONFIGURAÇÕES ===
// Chave Pix
$pixKey = '86318823565';

// Access Token do Mercado Pago
MercadoPago\SDK::setAccessToken('SEU_ACCESS_TOKEN'); // Substitua por seu token

// === FUNÇÃO: Compra de seguidores via API ===
function adicionarSeguidores($quantidade, $link) {
    // Aqui você chama sua API de seguidores (exemplo com CURL ou SDK próprio)
    echo "Você comprou $quantidade seguidores para o link: $link<br>";
}

// === GERANDO LINK DO MERCADO PAGO ===
$preference = new MercadoPago\Preference();
$item = new MercadoPago\Item();
$item->title = 'Serviço de Seguidores';
$item->quantity = 1;
$item->unit_price = 100.00; // Preço (R$)
$preference->items = array($item);
$preference->back_urls = array(
    "success" => "https://seusite.com/success.php",
    "failure" => "https://seusite.com/failure.php",
    "pending" => "https://seusite.com/pending.php"
);
$preference->auto_return = "approved";
$preference->save();
$mercadoPagoLink = $preference->init_point;

// === MOSTRANDO LINKS DE PAGAMENTO ===
echo "<h3>Formas de Pagamento:</h3>";
echo "1. <a href=\"$mercadoPagoLink\">Pagar com Mercado Pago</a><br><br>";
echo "2. <a href=\"pix://$pixKey\">Pagar com Pix (Copia e Cola)</a><br><br>";

// === SIMULAÇÃO: Cliente pagou e saldo foi adicionado ===
$clienteSaldo = 100.00; // Saldo após o pagamento (simulado)

// === AUTOMAÇÃO: Compra de seguidores após o pagamento ===
if ($clienteSaldo >= 100.00) {
    echo "Saldo disponível: R$$clienteSaldo<br>";
    $quantidadeDeSeguidores = 100;
    $linkInstagram = 'http://instagram.com/seuusuario'; // Substituir pelo link real do cliente
    adicionarSeguidores($quantidadeDeSeguidores, $linkInstagram);
} else {
    echo "Saldo insuficiente para comprar seguidores.";
}
?>
