{extends file="pages/_inc/master.tpl"}
{block name=head}{/block}

{block name=body}
    <div class="container page-container">
        <h1><i class="fas fa-wallet"></i> Carteira</h1>
        <div class="wallets-zone row"></div>
    </div>
    {include file="includes/cards.handlebars"}
{/block}

{block name=js}{/block}