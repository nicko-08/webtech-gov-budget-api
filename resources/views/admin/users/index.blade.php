@extends('frontend.layouts.app')

@section('title', 'Administration')

@section('content')
    <style>
        .ad-head{margin-bottom:14px;}
        .ad-head h2{margin:0;font-size:40px;letter-spacing:-.02em;color:#0f1f3a;}
        .ad-head p{margin:4px 0 0;color:#64748b;font-size:14px;}
        .ad-kpis{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:14px;}
        .kpi{background:#fff;border:1px solid #e3e8f2;border-radius:8px;padding:14px 16px;}
        .kpi-title{display:flex;justify-content:space-between;align-items:center;font-size:13px;color:#0f1f3a;font-weight:600;margin-bottom:8px;}
        .kpi-num{font-size:38px;color:#0f1f3a;font-weight:700;letter-spacing:-.02em;margin-bottom:2px;}
        .kpi-sub{font-size:12px;color:#94a3b8;}
        .ad-card{background:#fff;border:1px solid #e3e8f2;border-radius:8px;padding:14px;}
        .ad-card h3{margin:0;font-size:36px;color:#0f1f3a;}
        .ad-card p{margin:4px 0 12px;color:#64748b;font-size:13px;}
        table{width:100%;border-collapse:collapse;}
        th,td{text-align:left;border-bottom:1px solid #edf1f7;padding:11px 8px;font-size:13px;color:#334155;vertical-align:middle;}
        th{color:#0f1f3a;font-weight:700;font-size:12px;}
        .name strong{display:block;color:#0f1f3a;font-size:14px;margin-bottom:2px;}
        .name span{color:#64748b;font-size:12px;}
        .status{display:inline-block;padding:3px 10px;border-radius:999px;font-size:11px;font-weight:700;background:#dcfce7;color:#16a34a;text-transform:lowercase;}
        .edit-link{color:#0f1f3a;font-weight:600;text-decoration:none;}
        .dot{color:#94a3b8;margin-right:6px;font-size:12px;}
        @media (max-width:1100px){.ad-kpis{grid-template-columns:1fr;}.ad-head h2{font-size:30px;}.ad-card h3{font-size:28px;}.ad-card{overflow-x:auto;}table{min-width:860px;}}
    </style>

    <section class="ad-head">
        <h2>Administration</h2>
        <p>Manage users, roles, and system settings</p>
    </section>

    <section class="ad-kpis">
        <article class="kpi">
            <div class="kpi-title">User Management <span>☊</span></div>
            <div class="kpi-num">{{ number_format($userCount ?? 0) }}</div>
            <div class="kpi-sub">Active system users</div>
        </article>
        <article class="kpi">
            <div class="kpi-title">Government Units <span>⌂</span></div>
            <div class="kpi-num">{{ number_format($governmentUnitCount ?? 0) }}</div>
            <div class="kpi-sub">Registered LGUs</div>
        </article>
        <article class="kpi">
            <div class="kpi-title">Audit Logs <span>🧾</span></div>
            <div class="kpi-num">{{ number_format($auditLogCount ?? 0) }}</div>
            <div class="kpi-sub">System events recorded</div>
        </article>
    </section>

    <section class="ad-card">
        <h3>System Users</h3>
        <p>List of authorized personnel with access</p>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Unit</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse(($userRows ?? collect()) as $row)
                    <tr>
                        <td class="name"><strong>{{ $row->name }}</strong><span>{{ $row->email }}</span></td>
                        <td><span class="dot">○</span>{{ $row->role }}</td>
                        <td>{{ $row->unit }}</td>
                        <td><span class="status">{{ $row->status }}</span></td>
                        <td><a href="#" class="edit-link">Edit</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
