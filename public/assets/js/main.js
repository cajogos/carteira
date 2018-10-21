var WALLETS = [];

$(document).ready(function ()
{
    loadWallets();
});

function loadWallets()
{
    $.ajax({
        method: 'GET',
        url: '/api/getWallets'
    }).done(function (data)
    {
        if (data.status === 'success')
        {
            var wallets = data.result.wallets;
            for (var i = 0; i < wallets.length; i++)
            {
                var w = wallets[i];
                switch (w.type)
                {
                    case 'bitcoin-core':
                        loadBitcoinCoreWallet(w.id);
                        break;
                }
            }
        }
    });
}

function loadBitcoinCoreWallet(walletID)
{
    $.ajax({
        method: 'GET',
        url: '/api/getWallet',
        data: {
            id: walletID
        }
    }).done(function (data)
    {
        if (data.status === 'success')
        {
            var payload = data.result;
            WALLETS[walletID] = new BitcoinCoreWallet(payload);
            drawBitcoinCoreWallet(WALLETS[walletID]);
        }
    });
}

function drawBitcoinCoreWallet(wallet)
{
    var template = getBitcoinCoreWalletTemplate();
    var context = {
        id: wallet.getID(),
        name: wallet.getName(),
        type: wallet.getType(),
        balance: CarteiraUtils.formatDecimals(wallet.getBalance(), 8),
        unconfirmedBalance: CarteiraUtils.formatDecimals(wallet.getUnconfirmedBalance(), 8),
        immatureBalance: CarteiraUtils.formatDecimals(wallet.getImmatureBalance(), 8)
    };

    var walletElement = $(template(context));

    $('.wallets-zone').append(walletElement);
}

var TEMPLATE_BITCOIN_CORE_WALLET = null;

function getBitcoinCoreWalletTemplate()
{
    if (TEMPLATE_BITCOIN_CORE_WALLET === null)
    {
        var source = document.getElementById('wallet_bitcoin-core').innerHTML;
        TEMPLATE_BITCOIN_CORE_WALLET = Handlebars.compile(source);
    }
    return TEMPLATE_BITCOIN_CORE_WALLET;
}