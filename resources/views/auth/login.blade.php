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
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #0f1f2c;
            background: #f5f7fa;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 32px;
        }

        .panel--info {
            flex: 0 0 40%;
            min-width: 320px;
            background: url('https://media.philstar.com/photos/2019/05/20/bus5-dbm-hikes-lgu-revenue_2019-05-20_19-01-32.jpg') center/cover no-repeat;
            position: relative;
        }

        .panel--info::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(8, 34, 61, 0.76);
        }

        .info {
            position: relative;
            max-width: 340px;
            text-align: left;
            color: #ffffff;
            z-index: 1;
        }

        .info h1 {
            margin: 0 0 16px;
            font-size: 34px;
            line-height: 1.1;
            font-weight: 800;
        }

        .info p {
            margin: 0;
            font-size: 16px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.85);
        }

        .panel--form {
            flex: 0 0 60%;
            background: #ffffff;
        }

        .panel__inner {
            width: 100%;
            max-width: 440px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
        }

        .logo {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: #0b1b2d;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 700;
        }

        .brand h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 700;
            color: #0f1f2c;
        }

        .brand .subtitle {
            margin: 0;
            color: rgba(15, 23, 42, 0.65);
            font-size: 15px;
            text-align: center;
        }

        .card {
            width: 100%;
            text-align: left;
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.12);
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 12px 26px rgba(15, 23, 42, 0.08);
        }

        .card h2 {
            margin: 0 0 10px;
            font-size: 26px;
            letter-spacing: -0.02em;
            color: #0b1b2d;
        }

        .card p {
            margin: 0 0 22px;
            color: rgba(15, 23, 42, 0.7);
            font-size: 15px;
            line-height: 1.5;
        }

        label {
            display: block;
            margin: 0 0 8px;
            font-size: 14px;
            font-weight: 600;
            color: rgba(15, 23, 42, 0.78);
        }

        .field {
            margin-bottom: 16px;
        }

        input {
            width: 100%;
            border: 1px solid rgba(15, 23, 42, 0.14);
            border-radius: 10px;
            height: 50px;
            padding: 0 14px;
            font-size: 15px;
            color: #0f1f2c;
            background: #ffffff;
            outline: none;
            transition: border-color 160ms ease, box-shadow 160ms ease;
        }

        input::placeholder {
            color: rgba(15, 23, 42, 0.45);
        }

        input:focus {
            border-color: rgba(15, 23, 42, 0.32);
            box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.12);
        }

        .btn {
            width: 100%;
            border: 0;
            border-radius: 10px;
            height: 52px;
            background: #0b4d2a;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            cursor: pointer;
            margin-top: 12px;
            transition: background 120ms ease;
        }

        .btn:hover {
            background: #093b23;
        }

        .note {
            text-align: center;
            color: rgba(15, 23, 42, 0.6);
            margin-top: 18px;
            font-size: 13px;
            line-height: 1.35;
        }

        .error {
            background: rgba(254, 226, 226, 0.4);
            border: 1px solid rgba(248, 113, 113, 0.6);
            color: #991b1b;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 14px;
            margin-bottom: 14px;
        }

        @media (max-width: 900px) {
            .layout {
                flex-direction: column;
            }

            .panel--info {
                flex: none;
                width: 100%;
                min-height: 250px;
            }

            .panel--form {
                flex: none;
                width: 100%;
            }

            .panel {
                padding: 32px 24px;
            }

            .info h1 {
                font-size: 28px;
            }

            .info p {
                font-size: 14px;
            }

            .card {
                padding: 26px;
            }

            .card h2 {
                font-size: 24px;
            }

            input {
                height: 48px;
            }

            .btn {
                height: 50px;
            }
        }
    </style>
</head>
<body>
    <div class="layout">
        <aside class="panel panel--info">
            <div class="info">
                <h1>Sign in to your account</h1>
                <p>Access the BudgetPH finance portal for local government units.</p>
            </div>
        </aside>

        <main class="panel panel--form">
            <div class="panel__inner">
                <div class="brand">
                    <div class="logo">BP</div>
                    <h1>BudgetPH</h1>
                    <div class="subtitle">LGU Finance Management System</div>
                </div>

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
                    <input id="email" type="email" name="email" placeholder="name@lgu.gov.ph" value="{{ old('email') }}" required>
                </div>

                <label for="password">Password</label>
                <div class="field">
                    <input id="password" type="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn">SIGN IN</button>
            </form>

            <div class="note">
                Protected by Government Security Protocols.<br>
                Contact IT Support for access issues.
            </div>
        </section>
    </div>
</body>
</html>
