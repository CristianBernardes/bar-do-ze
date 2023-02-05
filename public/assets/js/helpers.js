/**
 * @param  {} value
 */
function formatCurrency(value) {
    return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(value);
}

/**
 * @param mixed dateStr
 *
 * @return [type]
 */
function formatDate(dateStr) {
    const dateArr = dateStr.split("-");
    return dateArr[2] + "/" + dateArr[1] + "/" + dateArr[0];
}
