@extends('frontend.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <style>
        .kpi-grid { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:14px; margin-bottom:14px; }
        .kpi-card { background:#fff; border:1px solid #e3e8f2; border-radius:8px; padding:16px; }
        .kpi-title { font-size:13px; font-weight:600; color:#0f1f3a; margin-bottom:6px; }
        .kpi-value { font-size:38px; font-weight:700; letter-spacing:-.02em; color:#0f1f3a; margin-bottom:2px; }
        .kpi-sub { font-size:12px; color:#64748b; }
        .util-track { height:6px; background:#edf1f7; border-radius:999px; margin-top:10px; overflow:hidden; }
        .util-fill { height:100%; background:#2f63e3; }
        .main-grid { display:grid; grid-template-columns:1.35fr 1fr; gap:14px; }
        .panel { background:#fff; border:1px solid #e3e8f2; border-radius:8px; padding:18px; }
        .panel h3 { margin:0; font-size:18px; color:#0f1f3a; }
        .panel p { margin:4px 0 16px; font-size:13px; color:#64748b; }
        .chart { height:250px; display:flex; align-items:flex-end; justify-content:space-between; gap:14px; padding:0 10px 24px; border-left:1px dashed #dbe3ef; border-bottom:1px dashed #dbe3ef; }
        .bar-wrap { flex:1; text-align:center; font-size:12px; color:#94a3b8; }
        .bar { width:100%; border-radius:4px 4px 0 0; margin-bottom:8px; background:#2f63e3; }
        .expense-item { display:flex; gap:12px; align-items:flex-start; padding:10px 0; }
        .expense-icon { width:30px; height:30px; border-radius:999px; background:#dbe8ff; color:#2f63e3; font-size:15px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .expense-main { flex:1; }
        .expense-main strong { display:block; font-size:14px; color:#0f1f3a; margin-bottom:2px; }
        .expense-meta { font-size:12px; color:#64748b; }
        .expense-amount { font-size:14px; font-weight:700; color:#0f1f3a; white-space:nowrap; }
        @media (max-width:1100px){ .kpi-grid{grid-template-columns:1fr 1fr;} .main-grid{grid-template-columns:1fr;} }
    </style>

    <section class="kpi-grid">
        <article class="kpi-card">
            <div class="kpi-title">Total Budget</div>
            <div class="kpi-value">₱{{ number_format($totalBudget, 2) }}</div>
            <div class="kpi-sub">{{ $activeFiscalYear ? 'FY '.$activeFiscalYear->year.' Allocation' : 'No active fiscal year' }}</div>
        </article>
        <article class="kpi-card">
            <div class="kpi-title">Total Spent</div>
            <div class="kpi-value">₱{{ number_format($totalSpent, 2) }}</div>
            <div class="kpi-sub">{{ number_format($utilizationRate, 1) }}% utilized</div>
        </article>
        <article class="kpi-card">
            <div class="kpi-title">Remaining</div>
            <div class="kpi-value">₱{{ number_format($remaining, 2) }}</div>
            <div class="kpi-sub">Available funds</div>
        </article>
        <article class="kpi-card">
            <div class="kpi-title">Utilization Rate</div>
            <div class="kpi-value">{{ number_format($utilizationRate, 1) }}%</div>
            <div class="util-track"><div class="util-fill js-width" data-width="{{ min(100, max(0, $utilizationRate)) }}"></div></div>
        </article>
    </section>

    <section class="main-grid">
        <article class="panel">
            <h3>Budget Utilization by Category</h3>
            <p>Breakdown of spending across major expense classes</p>
            <div class="chart">
                @php
                    $maxSpent = max(1, (float) ($categorySpending->max('spent') ?? 1));
                    $colors = ['#2f63e3','#3d7adf','#5f98df','#84b1e9','#9fc4ef'];
                @endphp
                @forelse($categorySpending->take(5) as $index => $category)
                    @php $height = min(90, max(8, (($category->spent / $maxSpent) * 90))); @endphp
                    <div class="bar-wrap">
                        <div class="bar js-bar" data-height="{{ $height }}" data-color="{{ $colors[$index % count($colors)] }}"></div>
                        {{ \Illuminate\Support\Str::limit($category->name, 12) }}
                    </div>
                @empty
                    <div class="bar-wrap">No category data yet</div>
                @endforelse
            </div>
        </article>

        <article class="panel">
            <h3>Recent Expenses</h3>
            <p>Latest transactions recorded</p>
            @forelse($recentExpenses as $expense)
                <div class="expense-item">
                    <div class="expense-icon">↘</div>
                    <div class="expense-main">
                        <strong>{{ $expense->description }}</strong>
                        <div class="expense-meta">
                            {{ $expense->budgetItem?->budget?->governmentUnit?->name ?? 'Unknown Unit' }} • {{ optional($expense->transaction_date)->format('M d, Y') }}
                        </div>
                    </div>
                    <div class="expense-amount">-₱{{ number_format((float)$expense->amount, 2) }}</div>
                </div>
            @empty
                <div class="expense-meta">No expense records found.</div>
            @endforelse
        </article>
    </section>

    <script>
        document.querySelectorAll('.js-width').forEach((element) => {
            const width = Number(element.dataset.width || 0);
            element.style.width = `${width}%`;
        });

        document.querySelectorAll('.js-bar').forEach((element) => {
            const height = Number(element.dataset.height || 0);
            const color = element.dataset.color || '#2f63e3';
            element.style.height = `${height}%`;
            element.style.background = color;
        });
    </script>
@endsection
