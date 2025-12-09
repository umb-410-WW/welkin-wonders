const container_product = document.querySelector("#products");
document.addEventListener("DOMContentLoaded", () => {
    for (let i = 0; i < products.length; i++) {
        product = products[i];
        container_product.insertAdjacentHTML("beforeend", formatCard(product.name, product.price, product.img, product.desc, product.page));
    }
    console.log("Hi!");
});
