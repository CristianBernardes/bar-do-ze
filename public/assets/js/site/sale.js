const crud = new CRUD('/sale', '/sale', '/sale', '/sale', '/sale');

sales();

function sales() {
    crud.all()
        .then(response => {
            if (response.length === 0) {

                const html = `
                        <tr>
                            <td colspan="3"> Nenhum venda realizada</td>
                        </tr>
                    `
                document.querySelector(`#sales`).innerHTML += html;
            } else {

                for (const sale of response) {
                    const html = `
                        <tr id="sale-${sale.id}">
                            <td>${sale.identify}</td>
                            <td>${castPaymentMethod(sale.payment_method)}</td>
                            <td>${formatDate(sale.date)}</td>
                            <td>${formatCurrency(sale.total_sale)}</td>
                        </tr>
                    `
                    document.querySelector(`#sales`).innerHTML += html;
                }
            }
        })
        .catch(error => {
            console.log(error);

            const html = `
                        <tr>
                            <td colspan="3"> Estamos com problemas para trazer as vendas realizadas</td>
                        </tr>
                    `
            document.querySelector(`#sales`).innerHTML += html;
        });
}

function castPaymentMethod(paymentMethod) {

    let castPaymentMethod = '';

    switch (paymentMethod) {
        case 'credit_card':
            castPaymentMethod = 'Cartão de crédito';
            break;

        case 'debit_card':
            castPaymentMethod = 'Cartão de débito';
            break;

        case 'cash':
            castPaymentMethod = 'Dinheiro';
            break;
    }

    return castPaymentMethod;
}
