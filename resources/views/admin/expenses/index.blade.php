@extends('frontend.layouts.app')

@section('title', 'Expense Tracking')

@section('content')
    <style>
        .ex-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
        }
        .ex-head h2 {
            margin: 0;
            font-size: 40px;
            letter-spacing: -0.02em;
            color: #0f1f3a;
        }
        .ex-head p {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 14px;
        }
        .btn-primary {
            border: 0;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14px;
            font-weight: 600;
            background: #2f63e3;
            color: #fff;
        }
        .log-card {
            background: #fff;
            border: 1px solid #e3e8f2;
            border-radius: 8px;
            padding: 14px;
        }
        .log-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }
        .log-top h3 {
            margin: 0;
            font-size: 36px;
            color: #0f1f3a;
        }
        .log-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .search {
            width: 240px;
            border: 1px solid #dbe2ee;
            border-radius: 8px;
            height: 34px;
            padding: 0 10px;
            font-size: 13px;
            color: #334155;
            background: #fbfcff;
        }
        .icon-btn {
            width: 34px;
            height: 34px;
            border: 1px solid #dbe2ee;
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            border-bottom: 1px solid #edf1f7;
            padding: 11px 8px;
            font-size: 13px;
            color: #334155;
            vertical-align: middle;
        }
        th {
            color: #0f1f3a;
            font-weight: 700;
            font-size: 12px;
        }
        .desc { color: #0f1f3a; font-weight: 600; }
        .amt { color: #0f1f3a; font-weight: 700; white-space: nowrap; }
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            color: #fff;
        }
        .ok { background: #22c55e; }
        .pending { background: #eab308; }
        .flagged { background: #ef4444; }
        @media (max-width: 1100px) {
            .ex-head h2 { font-size: 30px; }
            .log-top h3 { font-size: 28px; }
            .log-card { overflow-x: auto; }
            table { min-width: 980px; }
            .search { width: 190px; }
        }
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
                <tr><td>Mar 15, 2024</td><td class="desc">Q1 Honoraria</td><td>Personnel Services</td><td>Barangay Operations</td><td>Maria Santos</td><td><span class="badge ok">Approved</span></td><td class="amt" style="text-align:right;">₱750,000.00</td></tr>
                <tr><td>Mar 20, 2024</td><td class="desc">Medical Supplies Purchase</td><td>MOOE</td><td>Health Services</td><td>Juan Dela Cruz</td><td><span class="badge ok">Approved</span></td><td class="amt" style="text-align:right;">₱450,000.00</td></tr>
                <tr><td>Apr 5, 2024</td><td class="desc">Road Materials - Zone 1</td><td>Capital Outlay</td><td>Infrastructure Projects</td><td>Engr. Reyes</td><td><span class="badge ok">Approved</span></td><td class="amt" style="text-align:right;">₱1,200,000.00</td></tr>
                <tr><td>Apr 10, 2024</td><td class="desc">Basketball Uniforms</td><td>MOOE</td><td>Youth Development</td><td>SK Chair Ramos</td><td><span class="badge pending">Pending</span></td><td class="amt" style="text-align:right;">₱85,000.00</td></tr>
                <tr><td>Apr 12, 2024</td><td class="desc">Diesel for Garbage Truck</td><td>MOOE</td><td>Waste Management</td><td>Driver Ben</td><td><span class="badge ok">Approved</span></td><td class="amt" style="text-align:right;">₱25,000.00</td></tr>
                <tr><td>Apr 15, 2024</td><td class="desc">Office Supplies</td><td>MOOE</td><td>Barangay Operations</td><td>Maria Santos</td><td><span class="badge ok">Approved</span></td><td class="amt" style="text-align:right;">₱15,000.00</td></tr>
                <tr><td>Apr 18, 2024</td><td class="desc">Emergency Kits</td><td>Special Purpose</td><td>Disaster Risk Reduction</td><td>Juan Dela Cruz</td><td><span class="badge ok">Approved</span></td><td class="amt" style="text-align:right;">₱120,000.00</td></tr>
                <tr><td>Apr 20, 2024</td><td class="desc">Computer Repair</td><td>MOOE</td><td>Barangay Operations</td><td>Maria Santos</td><td><span class="badge flagged">Flagged</span></td><td class="amt" style="text-align:right;">₱5,000.00</td></tr>
                <tr><td>Apr 22, 2024</td><td class="desc">Cement Bags</td><td>Capital Outlay</td><td>Infrastructure Projects</td><td>Engr. Reyes</td><td><span class="badge pending">Pending</span></td><td class="amt" style="text-align:right;">₱300,000.00</td></tr>
                <tr><td>Apr 25, 2024</td><td class="desc">Feeding Program</td><td>MOOE</td><td>Health Services</td><td>Juan Dela Cruz</td><td><span class="badge ok">Approved</span></td><td class="amt" style="text-align:right;">₱50,000.00</td></tr>
            </tbody>
        </table>
    </section>
@endsection
