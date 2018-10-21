class Wallet
{
    constructor(payload)
    {
        this.id = payload.id;
        this.name = payload.name;
        this.type = payload.type;
    }

    getID()
    {
        return this.id;
    }

    getName()
    {
        return this.name;
    }

    getType()
    {
        return this.type;
    }
}