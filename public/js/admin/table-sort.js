// Click-to-sort on any admin/client list table. Purely client-side (sorts
// the rows currently on the page — pagination/search still happen server-side).
(function () {
    function cellText(row, index) {
        var cell = row.cells[index];
        return cell ? cell.innerText.trim() : '';
    }

    function sortRows(table, index, asc) {
        var tbody = table.tBodies[0];
        var rows = Array.prototype.slice.call(tbody.rows);
        var collator = new Intl.Collator(undefined, { numeric: true, sensitivity: 'base' });

        rows.sort(function (a, b) {
            return collator.compare(cellText(a, index), cellText(b, index)) * (asc ? 1 : -1);
        });

        rows.forEach(function (row) { tbody.appendChild(row); });
    }

    function initTable(table) {
        if (!table.tHead || !table.tBodies.length) return;
        var headerRow = table.tHead.rows[0];
        if (!headerRow) return;

        Array.prototype.forEach.call(headerRow.cells, function (th, index) {
            var label = th.textContent.trim();
            if (!label || th.classList.contains('no-sort')) return;

            th.setAttribute('title', 'Sort by ' + label);
            th.addEventListener('click', function () {
                var asc = th.getAttribute('data-sort-dir') !== 'asc';
                Array.prototype.forEach.call(headerRow.cells, function (other) {
                    other.removeAttribute('data-sort-dir');
                });
                th.setAttribute('data-sort-dir', asc ? 'asc' : 'desc');
                sortRows(table, index, asc);
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('table.table').forEach(initTable);
    });
})();
