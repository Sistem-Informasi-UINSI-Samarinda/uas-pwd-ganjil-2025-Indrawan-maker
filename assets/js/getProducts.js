
async function getProducts() {
    try {
        const res = await fetch('../data/products.json')
        const products = await res.json()
        renderCard(products)
    } catch(error) {
        console.log(error)
    }
}

getProducts()
    

// sudah diterjemahkan ke php di products.php

function renderCard(cardData) {
    const container = document.querySelector('.card-product-container')
    let cardHTML = ""
    console.log(cardData)
    cardData.forEach((card, id) => {
        cardHTML += `<div class="card-product">
                    <img src="${card.image}" alt="roti gembung">
                    <div>
                        <h4>${card.name}</h4>
                        <p>${card.description}</p>
                    </div>
                </div>`
                console.log(card.image)
    });
    container.innerHTML = cardHTML
}
