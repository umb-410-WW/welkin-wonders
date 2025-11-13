const container_product = document.querySelector("#products");

let products = [
    {
        name: "Test0",
        price: "$9999.99",
<<<<<<<< HEAD:pre-laravel-layout/js/shop.js
        img: "img/shop_img/dark_gray_black_stone_labradorite.jpg",
========
        img: "/assets/img/genie_ai_2.png",
>>>>>>>> laravel-frontend-integration:resources/js/shop.js
        desc: "Description Text Here",
        page: "URL"
    },
    {
        name: "Test1",
        price: "$0.99",
<<<<<<<< HEAD:pre-laravel-layout/js/shop.js
        img: "img/shop_img/rose_quartz_sachi.jpg",
========
        img: "/assets/img/gem_ai.jpg",
>>>>>>>> laravel-frontend-integration:resources/js/shop.js
        desc: "Description Text Here",
        page: "URL ALSO"
    },
    {
        name: "Test0",
        price: "$9999.99",
<<<<<<<< HEAD:pre-laravel-layout/js/shop.js
        img: "img/shop_img/dark_gray_black_stone_labradorite.jpg",
========
        img: "/assets/img/genie_ai_2.png",
>>>>>>>> laravel-frontend-integration:resources/js/shop.js
        desc: "Description Text Here",
        page: "URL"
    },
    {
        name: "Test1",
        price: "$0.99",
<<<<<<<< HEAD:pre-laravel-layout/js/shop.js
        img: "img/shop_img/rose_quartz_sachi.jpg",
========
        img: "/assets/img/gem_ai.jpg",
>>>>>>>> laravel-frontend-integration:resources/js/shop.js
        desc: "Description Text Here",
        page: "URL ALSO"
    },
    {
        name: "Test0",
        price: "$9999.99",
<<<<<<<< HEAD:pre-laravel-layout/js/shop.js
        img: "img/shop_img/dark_gray_black_stone_labradorite.jpg",
========
        img: "/assets/img/genie_ai_2.png",
>>>>>>>> laravel-frontend-integration:resources/js/shop.js
        desc: "Description Text Here",
        page: "URL"
    },
    {
        name: "Test1",
        price: "$0.99",
<<<<<<<< HEAD:pre-laravel-layout/js/shop.js
        img: "img/shop_img/rose_quartz_sachi.jpg",
========
        img: "/assets/img/gem_ai.jpg",
>>>>>>>> laravel-frontend-integration:resources/js/shop.js
        desc: "Description Text Here",
        page: "URL ALSO"
    },
    {
        name: "Test0",
        price: "$9999.99",
<<<<<<<< HEAD:pre-laravel-layout/js/shop.js
        img: "img/shop_img/dark_gray_black_stone_labradorite.jpg",
========
        img: "/assets/img/genie_ai_2.png",
>>>>>>>> laravel-frontend-integration:resources/js/shop.js
        desc: "Description Text Here",
        page: "URL"
    },
    {
        name: "Test1",
        price: "$0.99",
<<<<<<<< HEAD:pre-laravel-layout/js/shop.js
        img: "img/shop_img/rose_quartz_sachi.jpg",
========
        img: "/assets/img/gem_ai.jpg",
>>>>>>>> laravel-frontend-integration:resources/js/shop.js
        desc: "Description Text Here",
        page: "URL ALSO"
    },
    {
        name: "Test0",
        price: "$9999.99",
<<<<<<<< HEAD:pre-laravel-layout/js/shop.js
        img: "img/shop_img/dark_gray_black_stone_labradorite.jpg",
========
        img: "/assets/img/genie_ai_2.png",
>>>>>>>> laravel-frontend-integration:resources/js/shop.js
        desc: "Description Text Here",
        page: "URL"
    },
    {
        name: "Test1",
        price: "$0.99",
<<<<<<<< HEAD:pre-laravel-layout/js/shop.js
        img: "img/shop_img/rose_quartz_sachi.jpg",
========
        img: "/assets/img/gem_ai.jpg",
        desc: "Description Text Here",
        page: "URL ALSO"
    },
    {
        name: "Test0",
        price: "$9999.99",
        img: "/assets/img/genie_ai_2.png",
        desc: "Description Text Here",
        page: "URL"
    },
    {
        name: "Test1",
        price: "$0.99",
        img: "/assets/img/gem_ai.jpg",
        desc: "Description Text Here",
        page: "URL ALSO"
    },
    {
        name: "Test0",
        price: "$9999.99",
        img: "/assets/img/genie_ai_2.png",
        desc: "Description Text Here",
        page: "URL"
    },
    {
        name: "Test1",
        price: "$0.99",
        img: "/assets/img/gem_ai.jpg",
        desc: "Description Text Here",
        page: "URL ALSO"
    },
    {
        name: "Test0",
        price: "$9999.99",
        img: "/assets/img/genie_ai_2.png",
        desc: "Description Text Here",
        page: "URL"
    },
    {
        name: "Test1",
        price: "$0.99",
        img: "/assets/img/gem_ai.jpg",
        desc: "Description Text Here",
        page: "URL ALSO"
    },
    {
        name: "Test0",
        price: "$9999.99",
        img: "/assets/img/genie_ai_2.png",
        desc: "Description Text Here",
        page: "URL"
    },
    {
        name: "Test1",
        price: "$0.99",
        img: "/assets/img/gem_ai.jpg",
>>>>>>>> laravel-frontend-integration:resources/js/shop.js
        desc: "Description Text Here",
        page: "URL ALSO"
    }
]

function formatCard(name, price, img, desc, page) {
    return `
    <div class="product-card" style="background-image: url(${img});">
        <div class="product-desc">
            <div class="product-title">
                <h3>${name}</h3>
                <p class="product-price">${price}</p>
            </div>
            <p>${desc}</p>
            <a href="${page}">Product Page</a>
        </div>
        <a class="product-cart">Cart</a>
    </div>
    `
}

document.addEventListener("DOMContentLoaded", () => {
    for (let i = 0; i < products.length; i++) {
        product = products[i];
        container_product.insertAdjacentHTML("beforeend", formatCard(product.name, product.price, product.img, product.desc, product.page));
    }
    console.log("Hi!");
});
