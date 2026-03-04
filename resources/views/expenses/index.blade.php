@extends('frontend.layouts.app')

@section('title', 'Expense Tracking')

@section('content')
    <style>
        .ex-head{display:flex;justify-content:space-between;align-items:flex-start;gap:12px;margin-bottom:14px;}
        .ex-head h2{margin:0;font-size:40px;letter-spacing:-.02em;color:#0f1f3a;}
        .ex-head p{margin:4px 0 0;color:#64748b;font-size:14px;}
        .btn-primary{border:0;border-radius:8px;padding:10px 14px;font-size:14px;font-weight:600;background:#2f63e3;color:#fff;}
        .log-card{background:#fff;border:1px solid #e3e8f2;border-radius:8px;padding:14px;}
        .log-top{display:flex;justify-content:space-between;align-items:center;gap:10px;margin-bottom:8px;}
        .log-top h3{margin:0;font-size:36px;color:#0f1f3a;}
        .log-actions{display:flex;align-items:center;gap:8px;}
        .search{width:240px;border:1px solid #dbe2ee;border-radius:8px;height:34px;padding:0 10px;font-size:13px;color:#334155;background:#fbfcff;}
        .icon-btn{width:34px;height:34px;border:1px solid #dbe2ee;border-radius:8px;background:#fff;color:#64748b;font-size:14px;}
        table{width:100%;border-collapse:collapse;}
        th,td{text-align:left;border-bottom:1px solid #edf1f7;padding:11px 8px;font-size:13px;color:#334155;vertical-align:middle;}
        th{color:#0f1f3a;font-weight:700;font-size:12px;}
        .desc{color:#0f1f3a;font-weight:600;}
        .amt{color:#0f1f3a;font-weight:700;white-space:nowrap;}
        .badge{display:inline-block;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:700;color:#fff;}
        .ok{background:#22c55e;}.pending{background:#eab308;}.flagged{background:#ef4444;}
        @media (max-width:1100px){.ex-head h2{font-size:30px;}.log-top h3{font-size:28px;}.log-card{overflow-x:auto;}table{min-width:980px;}.search{width:190px;}}
    </style>

    <section class="ex-head">
        <div>
            <h2>Expenses</h2>
            <p>Record and monitor daily expenditures</p>
        </div>
        <button class="btn-primary">＋ Log Expense</button>
    </section>

    <section class="log-card">
        <div class="log-top">
            <h3>Expense Log</h3>
            <div class="log-actions">
                <input class="search" type="text" placeholder="Search expenses...">
                <button class="icon-btn">⎘</button>
                <button class="icon-btn">⇩</button>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Budget Source</th>
                    <th>Recorded By</th>
                    <th>Status</th>
                    <th style="text-align:right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse(($expenseRows ?? collect()) as $row)
                    <tr>
                        <td>{{ optional($row->date)->format('M d, Y') }}</td>
                        <td class="desc">{{ $row->description }}</td>
                        <td>{{ $row->category }}</td>
                        <td>{{ $row->budget_source }}</td>
                        <td>{{ $row->recorded_by }}</td>
                        <td>
                            <span class="badge {{ strtolower($row->status) === 'flagged' ? 'flagged' : (strtolower($row->status) === 'pending' ? 'pending' : 'ok') }}">
                                {{ $row->status }}
                            </span>
                        </td>
                        <td class="amt" style="text-align:right;">₱{{ number_format($row->amount, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7">No expense records found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
