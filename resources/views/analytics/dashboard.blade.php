@extends('frontend.layouts.app')

@section('title', 'Financial Analytics')

@section('content')
    <style>
        .an-head{margin-bottom:14px;}
        .an-head h2{margin:0;font-size:40px;letter-spacing:-.02em;color:#0f1f3a;}
        .an-head p{margin:4px 0 0;color:#64748b;font-size:14px;}
        .an-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
        .an-card{background:#fff;border:1px solid #e3e8f2;border-radius:8px;padding:16px;min-height:330px;}
        .an-card h3{margin:0;font-size:36px;color:#0f1f3a;}
        .an-card p{margin:4px 0 10px;color:#64748b;font-size:13px;}
        .line-wrap{position:relative;height:230px;border-left:1px dashed #dbe3ef;border-bottom:1px dashed #dbe3ef;margin:6px 8px 0 46px;}
        .line-labels{position:absolute;left:-44px;top:0;bottom:0;width:40px;display:flex;flex-direction:column;justify-content:space-between;color:#94a3b8;font-size:11px;}
        .x-labels{display:grid;grid-template-columns:repeat(12,1fr);margin:6px 8px 0 46px;color:#94a3b8;font-size:11px;}
        .line-svg{width:100%;height:100%;}
        .donut-wrap{display:flex;align-items:center;justify-content:center;min-height:210px;}
        .donut{width:170px;height:170px;border-radius:50%;position:relative;}
        .donut::after{content:'';position:absolute;inset:28px;background:#fff;border-radius:50%;border:1px solid #e8edf6;}
        .legend{margin-top:8px;display:flex;flex-wrap:wrap;gap:12px;font-size:12px;color:#64748b;}
        .legend span{display:inline-flex;align-items:center;gap:5px;}
        .dot{width:10px;height:10px;border-radius:2px;display:inline-block;}
        @media (max-width:1100px){.an-grid{grid-template-columns:1fr;}.an-head h2{font-size:30px;}.an-card h3{font-size:28px;}}
    </style>

    @php
        $trendValues = ($trend ?? collect())->pluck('value')->toArray();
        $maxTrend = max(1, ...$trendValues);
        $points = [];
        $count = max(1, count($trendValues) - 1);
        foreach ($trendValues as $index => $value) {
            $x = ($index / $count) * 520;
            $y = 230 - (($value / $maxTrend) * 220);
            $points[] = round($x, 2) . ' ' . round($y, 2);
        }
        $polyline = implode(' ', $points);

        $distributionData = ($distribution ?? collect())->filter(fn($value) => (float) $value > 0);
        $palette = ['#2f63e3','#3f7de2','#6ea4e7','#9fc4ef','#b6d0f4','#d6e4f8'];
        $segments = [];
        $offset = 0;
        $totalDistribution = max(1, (float) $distributionData->sum());
        foreach ($distributionData->values() as $idx => $value) {
            $percent = ((float) $value / $totalDistribution) * 100;
            $segments[] = $palette[$idx % count($palette)] . ' ' . round($offset, 2) . '% ' . round($offset + $percent, 2) . '%';
            $offset += $percent;
        }
        $donutStyle = 'background: conic-gradient(' . (count($segments) ? implode(',', $segments) : '#e2e8f0 0 100%') . ');';
    @endphp

    <section class="an-head">
        <h2>Financial Analytics</h2>
        <p>Insights and visualization of budget performance</p>
    </section>

    <section class="an-grid">
        <article class="an-card">
            <h3>Spending Trend (YTD)</h3>
            <p>Monthly expenditure for current fiscal year</p>
            <div class="line-wrap">
                <div class="line-labels">
                    <span>₱{{ number_format($maxTrend, 0) }}</span>
                    <span>₱{{ number_format($maxTrend * 0.75, 0) }}</span>
                    <span>₱{{ number_format($maxTrend * 0.5, 0) }}</span>
                    <span>₱{{ number_format($maxTrend * 0.25, 0) }}</span>
                    <span>₱0</span>
                </div>
                <svg class="line-svg" viewBox="0 0 520 230" preserveAspectRatio="none" aria-label="Spending trend chart">
                    <polyline points="{{ $polyline }}" fill="none" stroke="#2f63e3" stroke-width="2.5" />
                    @foreach($points as $point)
                        @php [$cx, $cy] = explode(' ', $point); @endphp
                        <circle cx="{{ $cx }}" cy="{{ $cy }}" r="3.5" fill="#2f63e3" />
                    @endforeach
                </svg>
            </div>
            <div class="x-labels">
                @foreach(($trend ?? collect()) as $row)
                    <span>{{ $row->label }}</span>
                @endforeach
            </div>
        </article>

        <article class="an-card">
            <h3>Budget Distribution</h3>
            <p>Spending breakdown by major expense class</p>
            <div class="donut-wrap">
                <div class="donut js-donut" data-gradient="{{ $donutStyle }}" aria-label="Budget distribution chart"></div>
            </div>
            <div class="legend">
                @forelse($distributionData->values() as $idx => $value)
                    @php $label = $distributionData->keys()->values()[$idx]; @endphp
                    <span><i class="dot js-dot" data-color="{{ $palette[$idx % count($palette)] }}"></i>{{ $label }}</span>
                @empty
                    <span>No distribution data</span>
                @endforelse
            </div>
        </article>
    </section>

    <script>
        document.querySelectorAll('.js-donut').forEach((element) => {
            const gradient = element.dataset.gradient || '';
            element.style.background = gradient.replace(/^background:\s*/i, '').replace(/;\s*$/, '');
        });

        document.querySelectorAll('.js-dot').forEach((element) => {
            element.style.background = element.dataset.color || '#2f63e3';
        });
    </script>
@endsection
