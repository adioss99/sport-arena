import { currency } from "./helper";

const dateInsert = () => {
    const dateInput = document.querySelector("#dateInput");
    const dateDisplay = document.querySelector("#dateBook");
    dateDisplay.value = dateInput.value; 
    dateInput.addEventListener("change", function () {
        dateDisplay.value = dateInput.value;
    });
};

const checkBox = () => {
    const totalprice = document.querySelector("#totalPrice");
    const checkboxs = document.querySelectorAll(".checkBox:checked");
    const bookList = document.querySelector("#bookList");
    const fieldData = document.querySelector("#fieldData");
    const selected = {};
    let total = 0;

    bookList.innerHTML =
        '<p class="text-sm font-semibold text-red-600">No schedule selected <p/>';

    checkboxs.forEach((checkbox) => {
        bookList.innerHTML = " ";
        fieldData.innerHTML = " ";
        const fieldId = checkbox.getAttribute("data-field");
        const fieldName = checkbox.getAttribute("data-field-name");
        const fieldPrice = checkbox.getAttribute("data-price");

        const time = checkbox.getAttribute("data-time");
        const timeId = checkbox.value;

        total += parseInt(fieldPrice);

        if (selected[fieldId]) {
            // Make sure the time array exists
            if (!Array.isArray(selected[fieldId].time)) {
                selected[fieldId].time = [];
            }
            selected[fieldId].time.push({ time, timeId });
        } else {
            // Create new entry if not exist
            selected[fieldId] = {
                field: { fieldId, fieldName, fieldPrice },
                time: [{ time, timeId }],
            };
        }
    });

    Object.entries(selected).forEach(([k, items]) => {
        let totalHours = 0;
        const fieldPrice = items.field.fieldPrice;
        const fieldName = items.field.fieldName;

        totalHours += parseInt(items.time.length);

        const times = items.time
            .map(
                (item) =>
                    `
                        <span class="font-semibold">(${item.time})</span>
                `
            )
            .join(" ");

        const listItem = `
            <ul class="text-sm">
                <li>
                    Field:
                    <span class="font-semibold">${fieldName}</span>
                            </li>
                            <li>
                            Price:
                            <span class="font-semibold">${currency(
                                fieldPrice
                            )}/h <span class="font-light">(${totalHours})</span></span> 
                </li>
                <li>
                    Time:
                    ${times}
                </li>
            </ul>`;

        const input = document.createElement("input");
        input.type = "hidden";
        input.name = "fields[]"; // important: name as array
        input.value = JSON.stringify(items);
        fieldData.appendChild(input);

        bookList.innerHTML += listItem;
    });

    buttonHandler(total);
    totalprice.innerHTML = `${currency(total)}`;
};

const checkBoxHandler = () => {
    const checkBoxInput = document.querySelectorAll(".checkBox");
    checkBoxInput.forEach((cb) => {
        cb.addEventListener("change", checkBox);
    });
};

const buttonHandler = (total) => {
    const bookButton = document.querySelector("#bookButton");
    if (bookButton) {
        total > 0
            ? (bookButton.disabled = false)
            : (bookButton.disabled = true);
    }
};

checkBoxHandler();
dateInsert();
