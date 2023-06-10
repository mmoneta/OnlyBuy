function addCell(row, value) {
    const cell = document.createElement('td');

    if (typeof value === 'string') {
        cell.innerText = value;
        row.appendChild(cell);
        return;
    }

    cell.appendChild(value);
    row.appendChild(cell);
}