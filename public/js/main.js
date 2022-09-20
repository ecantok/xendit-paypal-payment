new TomSelect("#location-form", {
    create: false,
    sorfField: {
        field: "text",
        direction: "asc",
    },
});

const dropdownTitle = document.querySelector("#dropdown-title");
const dropdownLists = document.querySelectorAll(
    "#dropdown-localization .dropdown-item"
);

function setTitleLocalization(title, list) {
    if (!localStorage.getItem("localization")) {
        dropdownTitle.innerHTML = "Indonesian - Rupiah";
    } else {
        dropdownTitle.innerHTML = localStorage.getItem("localization");
    }

    Array.from(list).forEach(function (href) {
        href.onclick = () => {
            title.innerText = href.innerText;
            localStorage.setItem("localization", href.innerText);
        };
    });
}

setTitleLocalization(dropdownTitle, dropdownLists);
