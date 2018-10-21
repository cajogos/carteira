var CarteiraUtils = {};

CarteiraUtils.formatDecimals = function(number, decimals)
{
    return Number(number).toLocaleString(undefined, {minimumFractionDigits: decimals});
};