function statusCheck(message) {
    console.log(`Status Check | ${message}`)
}

function main(offset = 0) {

    // Path Offset
    let pathOffset = "";
    for (let i = 0; i < offset; i++) pathOffset += "../";
    statusCheck(`Path Offset: ${offset} (${pathOffset})`);

    // Header (Navigation Bar)
    writeNavbar(document.querySelector("#nav-menu"), navItems);
    statusCheck("Navbar Loaded");

    // Footer

}