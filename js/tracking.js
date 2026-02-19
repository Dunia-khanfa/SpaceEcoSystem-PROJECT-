$(document).ready(function () {
    loadTableData();
});

function loadTableData() {
    // Key changed to 'wasteData' to match the Log Waste submission
    let wasteList = JSON.parse(localStorage.getItem('wasteData')) || [];
    let tableBody = $('#wasteTableBody');
    let emptyMsg = $('#emptyMessage');

    tableBody.empty();

    if (wasteList.length === 0) {
        if (emptyMsg.length) emptyMsg.show();
        return;
    } else {
        if (emptyMsg.length) emptyMsg.hide();
    }

    wasteList.forEach(function (item, index) {
        let weightClass = item.weight > 20 ? 'text-danger fw-bold' : 'text-dark';

        let row = `
            <tr>
                <td>${item.date}</td>
                <td class="text-capitalize">${item.type}</td>
                <td class="${weightClass}">
                    ${item.weight} kg
                </td>
                <td>${item.notes || '<span class="text-muted">-</span>'}</td>
                <td>
                    <button onclick="deleteItem(${index})" class="btn btn-sm btn-warning text-white">
                        <i class="fas fa-trash-alt"></i> Remove
                    </button>
                </td>
            </tr>
        `;

        tableBody.append(row);
    });
}

window.deleteItem = function (index) {
    let wasteList = JSON.parse(localStorage.getItem('wasteData')) || [];
    wasteList.splice(index, 1);
    localStorage.setItem('wasteData', JSON.stringify(wasteList));
    loadTableData();
};

window.clearHistory = function () {
    if (confirm("Are you sure you want to delete all records?")) {
        localStorage.removeItem('wasteData');
        loadTableData();
    }
};