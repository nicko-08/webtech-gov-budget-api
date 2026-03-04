@extends('frontend.layouts.app')

@section('title', 'Budget Management')

@section('content')
    <style>
        .bm-head{display:flex;justify-content:space-between;align-items:flex-start;gap:12px;margin-bottom:14px;}
        .bm-head h2{margin:0;font-size:40px;letter-spacing:-.02em;color:#0f1f3a;}
        .bm-head p{margin:4px 0 0;color:#64748b;font-size:14px;}
        .bm-actions{display:flex;gap:8px;}
        .btn-outline,.btn-primary{border-radius:8px;padding:10px 14px;font-size:14px;font-weight:600;}
        .btn-outline{border:1px solid #dbe2ee;background:#fff;color:#334155;}
        .btn-primary{border:0;background:#2f63e3;color:#fff;}
        .table-card{background:#fff;border:1px solid #e3e8f2;border-radius:8px;padding:16px;}
        .table-card h3{margin:0 0 10px;font-size:36px;color:#0f1f3a;}
        table{width:100%;border-collapse:collapse;}
        th,td{text-align:left;border-bottom:1px solid #edf1f7;padding:11px 8px;font-size:13px;color:#334155;vertical-align:middle;}
        th{color:#0f1f3a;font-weight:700;font-size:12px;}
        .name{color:#0f1f3a;font-weight:600;}
        .money{color:#0f1f3a;font-weight:700;}
        .tag{display:inline-block;background:#f1f5f9;color:#475569;border-radius:999px;padding:3px 8px;font-size:11px;font-weight:600;}
        .util{display:flex;align-items:center;gap:8px;}
        .track{width:70px;height:6px;border-radius:999px;background:#edf1f7;overflow:hidden;}
        .fill{height:100%;background:#2f63e3;}
        .arrow{width:20px;color:#64748b;}
        @media (max-width:1080px){.bm-head h2{font-size:30px;}.table-card h3{font-size:28px;}.table-card{overflow-x:auto;}table{min-width:900px;}}
    </style>

    <section class="bm-head">
        <div>
            <h2>Budget Management</h2>
            <p>Track allocations and line items for FY {{ $activeFiscalYear?->year ?? 'N/A' }}</p>
        </div>
        <div class="bm-actions">
            <button class="btn-outline">⎘ Filter</button>
            <button class="btn-primary">＋ New Budget</button>
        </div>
    </section>

    <section class="table-card">
        <h3>Budget Allocations</h3>
        <table>
            <thead>
                <tr>
                    <th style="width:24px;"></th>
                    <th>Budget Name</th>
                    <th>Category</th>
                    <th>Allocated</th>
                    <th>Spent</th>
                    <th>Utilization</th>
                </tr>
            </thead>
            <tbody>
                @forelse(($budgetItems ?? collect()) as $row)
                    <tr>
                        <td class="arrow">›</td>
                        <td class="name">{{ $row->budget_name }}</td>
                        <td><span class="tag">{{ $row->category_name }}</span></td>
                        <td class="money">₱{{ number_format($row->allocated_amount, 2) }}</td>
                        <td>₱{{ number_format($row->spent_amount, 2) }}</td>
                        <td>
                            <div class="util">
                                <div class="track"><div class="fill js-budget-util" data-width="{{ min(100, max(0, $row->utilization_rate)) }}"></div></div>
                                {{ $row->utilization_rate }}%
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No budget items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <script>
        document.querySelectorAll('.js-budget-util').forEach((element) => {
            const width = Number(element.dataset.width || 0);
            element.style.width = `${width}%`;
        });
    </script>
@endsection
