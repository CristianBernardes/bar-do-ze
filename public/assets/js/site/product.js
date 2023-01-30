const crud = new CRUD('/product', '/product', '/product', '/product', '/product');

produtos();

function produtos() {
    crud.all()
        .then(response => {
            if (response.length === 0) {

                const html = `
                        <tr>
                            <td colspan="3"> Nenhum produto cadastrado</td>
                        </tr>
                    `
                document.querySelector(`#products`).innerHTML += html;
            } else {

                for (const product of response) {
                    const html = `
                        <tr id="product-${product.id}">
                            <td>${product.name}</td>
                            <td>${product.description}</td>
                            <td>${formatCurrency(product.price)}</td>
                        </tr>
                    `
                    document.querySelector(`#products`).innerHTML += html;
                }
            }
        })
        .catch(error => {
            console.log(error);

            const html = `
                        <tr>
                            <td colspan="3"> Estamos com problemas para trazer os produtos cadastrados</td>
                        </tr>
                    `
            document.querySelector(`#products`).innerHTML += html;
        });
}
