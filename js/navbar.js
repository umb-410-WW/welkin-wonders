
let navItems = [
    ["Dream Collection", "index.html"],
    ["Characters", "index.html"],
    ["Gallery", "index.html"],
    ["Cast", "index.html"]
];

function formatNavButton(list) {
    return `<a href='${list[1]}'>${list[0]}</a>`;
}

function writeNavbar(container, list) {
    for (let i = 0; i < navItems.length; i++) {
        container.insertAdjacentHTML('beforeend', formatNavButton(list[i]));
    }
}