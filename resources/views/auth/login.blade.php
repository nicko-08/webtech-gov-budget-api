<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In | BudgetPH</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            background: #eef2f7;
            font-family: Arial, Helvetica, sans-serif;
            color: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .wrap {
            width: 100%;
            max-width: 520px;
            text-align: center;
        }
        .logo {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: #2f63e3;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            box-shadow: 0 10px 24px rgba(47, 99, 227, .25);
            margin-bottom: 14px;
        }
        h1 {
            margin: 0;
            font-size: 52px;
            font-weight: 700;
            color: #0b1b46;
            letter-spacing: -0.02em;
        }
        .subtitle {
            margin: 6px 0 28px;
            color: #64748b;
            font-size: 18px;
        }
        .card {
            text-align: left;
            background: #ffffff;
            border: 1px solid #dde4ef;
            border-radius: 14px;
            padding: 28px;
            box-shadow: 0 18px 32px rgba(15, 23, 42, .08);
        }
        .card h2 {
            margin: 0 0 8px;
            font-size: 38px;
            letter-spacing: -0.02em;
        }
        .card p {
            margin: 0 0 22px;
            color: #334155;
            font-size: 18px;
            line-height: 1.4;
        }
        label {
            display: block;
            margin: 0 0 8px;
            font-size: 28px;
            font-weight: 600;
            color: #0f172a;
        }
        .field {
            position: relative;
            margin-bottom: 18px;
        }
        .icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            pointer-events: none;
        }
        input {
            width: 100%;
            border: 1px solid #d6deea;
            border-radius: 9px;
            height: 58px;
            padding: 0 14px 0 42px;
            font-size: 24px;
            color: #0f172a;
            background: #f9fbff;
            outline: none;
        }
        input:focus {
            border-color: #2f63e3;
            box-shadow: 0 0 0 3px rgba(47, 99, 227, .15);
        }
        .btn {
            width: 100%;
            border: 0;
            border-radius: 9px;
            height: 58px;
            background: #2f63e3;
            color: #fff;
            font-size: 32px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }
        .note {
            text-align: center;
            color: #64748b;
            margin-top: 18px;
            font-size: 14px;
            line-height: 1.35;
        }
        .error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
            margin-bottom: 14px;
        }
        @media (max-width: 600px) {
            h1 { font-size: 42px; }
            .subtitle { font-size: 16px; }
            .card { padding: 20px; }
            .card h2 { font-size: 32px; }
            .card p { font-size: 16px; }
            label { font-size: 22px; }
            input { font-size: 18px; height: 52px; }
            .btn { font-size: 24px; height: 52px; }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="logo">🏛️</div>
        <h1>BudgetPH</h1>
        <div class="subtitle">LGU Finance Management System</div>

        <section class="card">
            <h2>Sign in to your account</h2>
            <p>Enter your official government email to access the dashboard</p>

            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <label for="email">Email</label>
                <div class="field">
                    <span class="icon">✉</span>
                    <input id="email" type="email" name="email" placeholder="name@lgu.gov.ph" value="{{ old('email') }}" required>
                </div>

                <label for="password">Password</label>
                <div class="field">
                    <span class="icon">🔒</span>
                    <input id="password" type="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn">Sign In →</button>
            </form>

            <div class="note">
                Protected by Government Security Protocols.<br>
                Contact IT Support for access issues.
            </div>
        </section>
    </div>
</body>
</html>
