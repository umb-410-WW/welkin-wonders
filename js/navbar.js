
let navItems = [
    ["Shop", "index.html"],
    ["About", "index.html"],
    ["Contact Us", "index.html"]
];

function formatNavButton(list) {
    return `<a href='${list[1]}'>${list[0]}</a>`;
}

function writeNavbar(container, list) {
    for (let i = 0; i < navItems.length; i++) {
        container.insertAdjacentHTML('beforeend', formatNavButton(list[i]));
    }
}