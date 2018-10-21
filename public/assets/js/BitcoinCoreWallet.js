class BitcoinCoreWallet extends Wallet
{
    constructor(payload)
    {
        super(payload);
        this.balances = payload.balances;
    }

    getBalance()
    {
        return this.balances.balance;
    }

    getUnconfirmedBalance()
    {
        return this.balances.unconfirmed;
    }

    getImmatureBalance()
    {
        return this.balances.immature;
    }

    getTemplate()
    {

    }
}