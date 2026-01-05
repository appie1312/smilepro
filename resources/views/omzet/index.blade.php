<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Omzet bekijken</title>

    <style>
        :root{
            --bg: #0b1220;
            --card: rgba(255,255,255,.06);
            --card2: rgba(255,255,255,.10);
            --text: rgba(255,255,255,.92);
            --muted: rgba(255,255,255,.70);
            --line: rgba(255,255,255,.12);
            --shadow: 0 20px 50px rgba(0,0,0,.35);
            --radius: 18px;
            --accent: #7c3aed;  /* paars */
            --accent2:#22c55e;  /* groen */
        }

        *{ box-sizing: border-box; }
        body{
            margin:0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
            color: var(--text);
            background:
                radial-gradient(1000px 600px at 10% 10%, rgba(124,58,237,.25), transparent 55%),
                radial-gradient(800px 500px at 90% 20%, rgba(34,197,94,.20), transparent 55%),
                radial-gradient(1000px 700px at 50% 90%, rgba(59,130,246,.18), transparent 60%),
                var(--bg);
            min-height: 100vh;
        }

        .container{
            max-width: 1100px;
            margin: 0 auto;
            padding: 22px 16px 50px;
        }

        .header{
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
            gap:12px;
            margin-bottom: 18px;
        }

        .title-wrap h1{
            margin:0;
            font-size: clamp(22px, 2.2vw, 34px);
            letter-spacing: .2px;
        }

        .subtitle{
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 14px;
        }

        .actions{
            display:flex;
            gap:10px;
            flex-wrap:wrap;
            justify-content:flex-end;
        }

        .btn{
            border: 1px solid var(--line);
            background: rgba(255,255,255,.06);
            color: var(--text);
            padding: 10px 12px;
            border-radius: 12px;
            text-decoration:none;
            display:inline-flex;
            align-items:center;
            gap:8px;
            font-weight: 600;
            font-size: 14px;
            cursor:pointer;
            transition: transform .15s ease, background .15s ease, border-color .15s ease;
            user-select:none;
        }
        .btn:hover{ transform: translateY(-1px); background: rgba(255,255,255,.10); border-color: rgba(255,255,255,.22); }
        .btn:active{ transform: translateY(0px); }

        .btn-primary{
            background: linear-gradient(135deg, rgba(124,58,237,.95), rgba(59,130,246,.85));
            border: 0;
            box-shadow: 0 10px 25px rgba(124,58,237,.22);
        }
        .btn-primary:hover{ background: linear-gradient(135deg, rgba(124,58,237,1), rgba(59,130,246,.95)); }

        .card{
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow:hidden;
        }

        .card-top{
            padding: 14px 14px 0;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
            flex-wrap:wrap;
        }

        .search{
            flex: 1 1 260px;
            position: relative;
        }

        .search input{
            width:100%;
            border: 1px solid var(--line);
            background: rgba(255,255,255,.06);
            color: var(--text);
            padding: 11px 12px 11px 38px;
            border-radius: 12px;
            outline:none;
        }
        .search input::placeholder{ color: rgba(255,255,255,.55); }
        .search svg{
            position:absolute;
            left:12px;
            top:50%;
            transform: translateY(-50%);
            opacity:.75;
        }

        .meta{
            color: var(--muted);
            font-size: 13px;
            white-space:nowrap;
        }

        .table-wrap{
            overflow:auto;           /* maakt het responsive op mobiel */
            -webkit-overflow-scrolling: touch;
            margin-top: 14px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            min-width: 720px;        /* zodat hij horizontaal kan scrollen op mobiel */
        }

        thead th{
            position: sticky;
            top: 0;
            background: rgba(255,255,255,.08);
            backdrop-filter: blur(8px);
            text-align:left;
            font-size: 13px;
            letter-spacing:.3px;
            color: rgba(255,255,255,.85);
            padding: 12px 14px;
            border-bottom: 1px solid var(--line);
            cursor: pointer;
            user-select:none;
        }

        tbody td{
            padding: 12px 14px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            color: rgba(255,255,255,.90);
            font-size: 14px;
        }

        tbody tr:hover{
            background: rgba(255,255,255,.06);
        }

        .amount{
            font-variant-numeric: tabular-nums;
            font-weight: 700;
        }

        .pill{
            display:inline-flex;
            align-items:center;
            gap:6px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(34,197,94,.14);
            border: 1px solid rgba(34,197,94,.25);
            color: rgba(255,255,255,.92);
            font-size: 12px;
            font-weight: 700;
        }

        .empty{
            padding: 26px 16px;
            text-align:center;
        }
        .empty h2{
            margin: 0 0 8px;
            font-size: 18px;
        }
        .empty p{
            margin:0;
            color: var(--muted);
        }

        .footer-note{
            margin-top: 12px;
            color: rgba(255,255,255,.55);
            font-size: 12px;
        }

        /* Mobiel tweaks */
        @media (max-width: 640px){
            .actions{ width:100%; justify-content:stretch; }
            .btn{ flex:1 1 auto; justify-content:center; }
            .meta{ width:100%; }
            .card-top{ padding: 14px; }
        }
    </style>
</head>

<body>
<div class="container">
    <div class="header">
        <div class="title-wrap">
            <h1>Omzet bekijken</h1>
            <p class="subtitle">Alleen zichtbaar voor praktijkmanagement</p>
        </div>

        <div class="actions">
            <a class="btn" href="{{ route('dashboard') }}" title="Terug naar dashboard">
                <!-- arrow-left icon -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Terug naar dashboard
            </a>

            <button class="btn btn-primary" id="printBtn" type="button" title="Printen / PDF">
                <!-- printer icon -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M6 9V4h12v5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 18h12v2H6v-2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 14H5a2 2 0 0 1-2-2v-1a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Print / PDF
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-top">
            <div class="search">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M11 19a8 8 0 1 1 0-16 8 8 0 0 1 0 16Z" stroke="currentColor" stroke-width="2"/>
                </svg>
                <input id="searchInput" type="text" placeholder="Zoek op omschrijving, klant, datum of bedrag..." autocomplete="off">
            </div>

            <div class="meta">
                <span class="pill">
                    <!-- dot -->
                    <span style="width:8px;height:8px;border-radius:50%;background:rgba(34,197,94,.9);display:inline-block;"></span>
                    <span id="rowCount">0</span> resultaten
                </span>
            </div>
        </div>

        @if(count($omzetten) === 0)
            <div class="empty">
                <h2>Geen omzet beschikbaar</h2>
                <p>Er zijn op dit moment geen omzets opgeslagen.</p>
            </div>
        @else
            <div class="table-wrap">
                <table id="omzetTable">
                    <thead>
                        <tr>
                            <th data-col="0">Omschrijving</th>
                            <th data-col="1">Klant</th>
                            <th data-col="2">Datum</th>
                            <th data-col="3">Bedrag</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($omzetten as $o)
                            <tr>
                                <td>{{ $o->omschrijving }}</td>
                                <td>{{ $o->klant_naam }}</td>
                                <td>{{ \Carbon\Carbon::parse($o->datum)->format('d-m-Y') }}</td>
                                <td class="amount">€ {{ number_format((float)$o->bedrag, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="footer-note" style="padding: 0 14px 14px;">
                Tip: klik op een kolomkop om te sorteren. Gebruik zoekbalk om te filteren.
            </div>
        @endif
    </div>
</div>

<script>
(function () {
    const table = document.getElementById('omzetTable');
    const searchInput = document.getElementById('searchInput');
    const rowCountEl = document.getElementById('rowCount');
    const printBtn = document.getElementById('printBtn');

    // Update count
    function updateCount() {
        if (!table) return;
        const rows = Array.from(table.tBodies[0].rows);
        const visible = rows.filter(r => r.style.display !== 'none').length;
        rowCountEl.textContent = visible.toString();
    }

    // Search filter
    if (searchInput && table) {
        searchInput.addEventListener('input', () => {
            const q = searchInput.value.toLowerCase().trim();
            const rows = Array.from(table.tBodies[0].rows);

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(q) ? '' : 'none';
            });

            updateCount();
        });
    }

    // Sorting
    if (table) {
        const headers = table.querySelectorAll('thead th');
        const tbody = table.tBodies[0];
        const sortState = { col: null, dir: 1 }; // 1 asc, -1 desc

        headers.forEach(th => {
            th.addEventListener('click', () => {
                const col = Number(th.dataset.col);

                // toggle direction if same col
                if (sortState.col === col) sortState.dir *= -1;
                else { sortState.col = col; sortState.dir = 1; }

                const rows = Array.from(tbody.rows);

                const parseCell = (row) => {
                    const raw = row.cells[col].innerText.trim();

                    // col 3 = bedrag: "€ 1.234,56"
                    if (col === 3) {
                        const n = raw.replace(/[€\s.]/g, '').replace(',', '.');
                        return parseFloat(n) || 0;
                    }

                    // col 2 = datum: "dd-mm-YYYY"
                    if (col === 2) {
                        const [dd, mm, yyyy] = raw.split('-').map(Number);
                        return new Date(yyyy, (mm || 1) - 1, dd || 1).getTime();
                    }

                    return raw.toLowerCase();
                };

                rows.sort((a, b) => {
                    const av = parseCell(a);
                    const bv = parseCell(b);

                    if (av < bv) return -1 * sortState.dir;
                    if (av > bv) return  1 * sortState.dir;
                    return 0;
                });

                rows.forEach(r => tbody.appendChild(r));
                updateCount();
            });
        });

        updateCount();
    }

    // Print
    if (printBtn) {
        printBtn.addEventListener('click', () => window.print());
    }
})();
</script>
</body>
</html>
