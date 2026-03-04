@extends('frontend.layouts.app')

@section('title', 'Budget Management')

@section('content')
    <style>
        .bm-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
        }
        .bm-head h2 {
            margin: 0;
            font-size: 40px;
            letter-spacing: -0.02em;
            color: #0f1f3a;
        }
        .bm-head p {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 14px;
        }
        .bm-actions { display: flex; gap: 8px; }
        .btn-outline,
        .btn-primary {
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14px;
            font-weight: 600;
        }
        .btn-outline {
            border: 1px solid #dbe2ee;
            background: #fff;
            color: #334155;
        }
        .btn-primary {
            border: 0;
            background: #2f63e3;
            color: #fff;
        }
        .table-card {
            background: #fff;
            border: 1px solid #e3e8f2;
            border-radius: 8px;
            padding: 16px;
        }
        .table-card h3 {
            margin: 0 0 10px;
            font-size: 36px;
            color: #0f1f3a;
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
        .name { color: #0f1f3a; font-weight: 600; }
        .money { color: #0f1f3a; font-weight: 700; }
        .tag {
            display: inline-block;
            background: #f1f5f9;
            color: #475569;
            border-radius: 999px;
            padding: 3px 8px;
            font-size: 11px;
            font-weight: 600;
        }
        .util {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .track {
            width: 70px;
            height: 6px;
            border-radius: 999px;
            background: #edf1f7;
            overflow: hidden;
        }
        .fill { height: 100%; background: #2f63e3; }
        .w64 { width: 64%; }
        .w72 { width: 72%; }
        .w38 { width: 38%; }
        .w30 { width: 30%; }
        .w75 { width: 75%; }
        .arrow { width: 20px; color: #64748b; }
        @media (max-width: 1080px) {
            .bm-head h2 { font-size: 30px; }
            .table-card h3 { font-size: 28px; }
            .table-card { overflow-x: auto; }
            table { min-width: 900px; }
        }
    </style>

    <section class="bm-head">
        <div>
            <h2>Budget Management</h2>
            <p>Track allocations and line items for FY 2024</p>
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
                    <th style="width: 24px;"></th>
                    <th>Budget Name</th>
                    <th>Category</th>
                    <th>Allocated</th>
                    <th>Spent</th>
                    <th>Utilization</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="arrow">›</td>
                    <td class="name">Barangay Operations</td>
                    <td><span class="tag">Personnel Services</span></td>
                    <td class="money">₱5,000,000.00</td>
                    <td>₱3,200,000.00</td>
                    <td><div class="util"><div class="track"><div class="fill w64"></div></div>64%</div></td>
                </tr>
                <tr>
                    <td class="arrow">›</td>
                    <td class="name">Health Services</td>
                    <td><span class="tag">MOOE</span></td>
                    <td class="money">₱2,500,000.00</td>
                    <td>₱1,800,000.00</td>
                    <td><div class="util"><div class="track"><div class="fill w72"></div></div>72%</div></td>
                </tr>
                <tr>
                    <td class="arrow">›</td>
                    <td class="name">Infrastructure Projects</td>
                    <td><span class="tag">Capital Outlay</span></td>
                    <td class="money">₱4,000,000.00</td>
                    <td>₱1,500,000.00</td>
                    <td><div class="util"><div class="track"><div class="fill w38"></div></div>38%</div></td>
                </tr>
                <tr>
                    <td class="arrow">›</td>
                    <td class="name">Disaster Risk Reduction</td>
                    <td><span class="tag">Special Purpose</span></td>
                    <td class="money">₱1,500,000.00</td>
                    <td>₱450,000.00</td>
                    <td><div class="util"><div class="track"><div class="fill w30"></div></div>30%</div></td>
                </tr>
                <tr>
                    <td class="arrow">›</td>
                    <td class="name">Youth Development</td>
                    <td><span class="tag">MOOE</span></td>
                    <td class="money">₱800,000.00</td>
                    <td>₱600,000.00</td>
                    <td><div class="util"><div class="track"><div class="fill w75"></div></div>75%</div></td>
                </tr>
                <tr>
                    <td class="arrow">›</td>
                    <td class="name">Waste Management</td>
                    <td><span class="tag">MOOE</span></td>
                    <td class="money">₱1,200,000.00</td>
                    <td>₱900,000.00</td>
                    <td><div class="util"><div class="track"><div class="fill w75"></div></div>75%</div></td>
                </tr>
            </tbody>
        </table>
    </section>
@endsection
