<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Gov Budget System')</title>
    <style>
        :root {
            --bg: #f6f8fc;
            --card: #ffffff;
            --text: #0f1f3a;
            --muted: #64748b;
            --line: #e3e8f2;
            --primary: #2f63e3;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Inter, Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
        }
        .layout {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }
        .sidebar {
            background: var(--card);
            border-right: 1px solid var(--line);
            display: flex;
            flex-direction: column;
        }
        .brand-wrap {
            padding: 16px 18px;
            border-bottom: 1px solid var(--line);
        }
        .brand {
            font-size: 28px;
            font-weight: 700;
            line-height: 1;
            color: #1f4ed8;
            margin-bottom: 2px;
        }
        .brand small {
            display: block;
            font-size: 10px;
            letter-spacing: .08em;
            color: #64748b;
            text-transform: uppercase;
        }
        .menu {
            padding: 16px 12px;
            flex: 1;
        }
        .menu-section {
            margin-bottom: 6px;
        }
        .nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text);
            text-decoration: none;
            padding: 10px 10px;
            border-radius: 8px;
            margin-bottom: 2px;
            border: 1px solid transparent;
            font-size: 14px;
            font-weight: 500;
        }
        .nav a:hover {
            background: #eff4ff;
        }
        .nav a.active {
            background: #edf3ff;
            border-color: #d8e4ff;
            color: #1f4ed8;
            font-weight: 600;
        }
        .nav-ico {
            width: 16px;
            opacity: .75;
            text-align: center;
        }
        .sidebar-footer {
            border-top: 1px solid var(--line);
            padding: 14px 12px;
        }
        .userbox {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        .avatar {
            width: 30px;
            height: 30px;
            border-radius: 999px;
            background: #dbe8ff;
            color: #1f4ed8;
            font-weight: 700;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .user-meta strong { display: block; font-size: 13px; }
        .user-meta span { color: var(--muted); font-size: 12px; }
        .logout {
            display: block;
            border: 1px solid var(--line);
            text-decoration: none;
            color: #334155;
            border-radius: 8px;
            padding: 8px 10px;
            font-size: 14px;
            font-weight: 600;
            text-align: left;
            background: #fff;
        }
        .main {
            padding: 0;
        }
        .topbar {
            background: var(--card);
            border-bottom: 1px solid var(--line);
            padding: 10px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 64px;
        }
        .top-left { font-size: 31px; font-weight: 700; }
        .top-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .search {
            width: 220px;
            height: 36px;
            border: 1px solid var(--line);
            background: #f8fbff;
            border-radius: 8px;
            padding: 0 12px;
            font-size: 13px;
            color: #334155;
        }
        .pill {
            font-size: 12px;
            color: #2f63e3;
            background: #edf3ff;
            border: 1px solid #d6e2ff;
            border-radius: 999px;
            padding: 6px 10px;
            font-weight: 600;
        }
        .bell {
            width: 30px;
            height: 30px;
            border-radius: 999px;
            border: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 14px;
        }
        .content {
            padding: 22px 24px;
        }
        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 18px;
            margin-bottom: 14px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 14px;
        }
        .kpi {
            font-size: 24px;
            font-weight: 700;
            margin-top: 8px;
        }
        .muted { color: var(--muted); }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            text-align: left;
            border-bottom: 1px solid var(--line);
            padding: 10px 8px;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            background: var(--primary);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 14px;
        }
        @media (max-width: 900px) {
            .layout { grid-template-columns: 1fr; }
            .sidebar { border-right: 0; border-bottom: 1px solid var(--line); }
            .topbar { padding: 10px 14px; }
            .top-left { font-size: 22px; }
            .content { padding: 14px; }
            .search { width: 150px; }
        }
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="brand-wrap">
                <div class="brand">BudgetPH</div>
                <small>LGU Finance System</small>
            </div>

            <div class="menu">
                <div class="menu-section">
                    @php
                        $dashboardUrl = \Illuminate\Support\Facades\Route::has('admin.dashboard') ? route('admin.dashboard') : url('/');
                        $fiscalYearsUrl = \Illuminate\Support\Facades\Route::has('fiscal-years.index') ? route('fiscal-years.index') : url('/');
                        $budgetsUrl = \Illuminate\Support\Facades\Route::has('budgets.index') ? route('budgets.index') : url('/');
                        $expensesUrl = \Illuminate\Support\Facades\Route::has('expenses.index') ? route('expenses.index') : url('/');
                        $analyticsUrl = \Illuminate\Support\Facades\Route::has('analytics.dashboard') ? route('analytics.dashboard') : url('/');
                        $adminUsersUrl = \Illuminate\Support\Facades\Route::has('admin.users.index') ? route('admin.users.index') : url('/');
                        $logoutUrl = \Illuminate\Support\Facades\Route::has('logout') ? route('logout') : url('/');
                        $logoutPostUrl = \Illuminate\Support\Facades\Route::has('logout.submit') ? route('logout.submit') : null;
                        $currentUser = \Illuminate\Support\Facades\Auth::guard('web')->user();
                        $displayName = auth()->user()?->name;
                        $displayRole = $currentUser?->role ? ucfirst(str_replace('-', ' ', $currentUser->role)) : 'Not signed in';
                        $nameParts = preg_split('/\s+/', trim($displayName)) ?: [];
                        $initials = collect($nameParts)
                            ->filter()
                            ->take(2)
                            ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
                            ->implode('');
                        $initials = $initials !== '' ? $initials : 'GU';
                    @endphp
                    <nav class="nav">
                        <a href="{{ $dashboardUrl }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><span class="nav-ico">▦</span>Dashboard</a>
                        <a href="{{ $fiscalYearsUrl }}" class="{{ request()->routeIs('fiscal-years.*') ? 'active' : '' }}"><span class="nav-ico">◷</span>Fiscal Years</a>
                        <a href="{{ $budgetsUrl }}" class="{{ request()->routeIs('budgets.*') ? 'active' : '' }}"><span class="nav-ico">▤</span>Budgets</a>
                        <a href="{{ $expensesUrl }}" class="{{ request()->routeIs('expenses.*') ? 'active' : '' }}"><span class="nav-ico">▣</span>Expenses</a>
                        <a href="{{ $analyticsUrl }}" class="{{ request()->routeIs('analytics.*') ? 'active' : '' }}"><span class="nav-ico">◫</span>Analytics</a>
                        <a href="{{ $adminUsersUrl }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><span class="nav-ico">⚙</span>Admin</a>
                    </nav>
                </div>
            </div>

            <div class="sidebar-footer">
                <div class="userbox">
                    <div class="avatar">{{ $initials }}</div>
                    <div class="user-meta">
                        <strong>{{ $displayName }}</strong>
                        <span>{{ $displayRole }}</span>
                    </div>
                </div>
                @if ($logoutPostUrl)
                    <form method="POST" action="{{ $logoutPostUrl }}">
                        @csrf
                        <button type="submit" class="logout" style="width:100%;cursor:pointer;">↩ Log out</button>
                    </form>
                @else
                    <a class="logout" href="{{ $logoutUrl }}">↩ Log out</a>
                @endif
            </div>
        </aside>

        <main class="main">
            <div class="topbar">
                <div class="top-left">@yield('title', 'Dashboard')</div>
                <div class="top-right">
                    <input class="search" type="text" placeholder="Search...">
                    <span class="pill">FY 2024 Active</span>
                    <span class="bell">🔔</span>
                </div>
            </div>
            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
