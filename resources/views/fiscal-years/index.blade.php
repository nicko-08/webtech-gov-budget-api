@extends('frontend.layouts.app')

@section('title', 'Fiscal Years')

@section('content')
    <style>
        .fy-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:14px;gap:10px;}
        .fy-header h2{margin:0;font-size:40px;letter-spacing:-.02em;color:#0f1f3a;}
        .fy-header p{margin:4px 0 0;color:#64748b;font-size:14px;}
        .fy-create{background:#2f63e3;color:#fff;border:0;border-radius:8px;font-size:14px;font-weight:600;padding:10px 14px;}
        .fy-list{display:grid;gap:14px;}
        .fy-card{background:#fff;border:1px solid #e3e8f2;border-radius:8px;padding:18px 20px;}
        .fy-row{display:grid;grid-template-columns:1fr auto;gap:16px;align-items:start;}
        .fy-title{display:flex;align-items:center;gap:10px;margin-bottom:6px;}
        .fy-title h3{margin:0;font-size:34px;color:#0f1f3a;}
        .badge{font-size:12px;border-radius:999px;padding:4px 9px;font-weight:600;}
        .active{background:#2f63e3;color:#fff;}
        .closed,.upcoming{background:#f1f5f9;color:#334155;}
        .period{color:#334155;font-size:14px;margin-bottom:12px;}
        .util-label{display:flex;justify-content:space-between;font-size:13px;color:#334155;margin-bottom:6px;}
        .util-track{height:8px;background:#eef2f7;border-radius:999px;overflow:hidden;}
        .util-fill{height:100%;background:#2f63e3;}
        .fy-right{text-align:right;min-width:260px;}
        .alloc{font-size:46px;font-weight:700;letter-spacing:-.02em;color:#0f1f3a;margin-bottom:2px;}
        .alloc-sub{font-size:12px;color:#94a3b8;text-transform:uppercase;font-weight:600;margin-bottom:14px;}
        .fy-actions{display:flex;justify-content:flex-end;gap:8px;}
        .btn-lite{border:1px solid #dbe2ee;background:#fff;color:#334155;border-radius:8px;font-size:13px;font-weight:600;padding:8px 12px;}
        @media (max-width:1000px){.fy-header h2{font-size:30px;}.fy-title h3{font-size:26px;}.alloc{font-size:32px;}.fy-row{grid-template-columns:1fr;}.fy-right{min-width:auto;text-align:left;}.fy-actions{justify-content:flex-start;}}
    </style>

    <section class="fy-header">
        <div>
            <h2>Fiscal Years</h2>
            <p>Manage budget periods and allocations</p>
        </div>
        <button class="fy-create">＋ Create New Fiscal Year</button>
    </section>

    <section class="fy-list">
        @forelse(($fiscalYears ?? collect()) as $fy)
            <article class="fy-card">
                <div class="fy-row">
                    <div>
                        <div class="fy-title">
                            <h3>FY {{ $fy->year }}</h3>
                            <span class="badge {{ strtolower($fy->status) }}">{{ $fy->status }}</span>
                        </div>
                        <div class="period">
                            Budget Period: {{ optional($fy->start_date)->format('M j, Y') }} - {{ optional($fy->end_date)->format('M j, Y') }}
                        </div>
                        <div class="util-label">
                            <span>Budget Utilization</span>
                            <strong>₱{{ number_format($fy->total_spent, 2) }} / ₱{{ number_format($fy->total_allocation, 2) }}</strong>
                        </div>
                        <div class="util-track">
                            <div class="util-fill js-fy-util" data-width="{{ min(100, max(0, $fy->utilization_rate)) }}" data-color="{{ strtolower($fy->status) === 'closed' ? '#ef4444' : '#2f63e3' }}"></div>
                        </div>
                    </div>
                    <div class="fy-right">
                        <div class="alloc">₱{{ number_format($fy->total_allocation, 2) }}</div>
                        <div class="alloc-sub">Total Allocation</div>
                        <div class="fy-actions">
                            <button class="btn-lite">View Reports</button>
                            <button class="btn-lite">Edit Budget</button>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <article class="fy-card">No fiscal years found.</article>
        @endforelse
    </section>

    <script>
        document.querySelectorAll('.js-fy-util').forEach((element) => {
            const width = Number(element.dataset.width || 0);
            const color = element.dataset.color || '#2f63e3';
            element.style.width = `${width}%`;
            element.style.background = color;
        });
    </script>
@endsection
