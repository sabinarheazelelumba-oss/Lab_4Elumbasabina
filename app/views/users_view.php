<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Module</title>
    <style>
        :root {
            --black: #0f0f1e;
            --graphite: #16152a;
            --panel: #1e1d3f;
            --line: #3a3759;
            --muted: #9ca3af;
            --white: #f8f8f8;
            --lime: #a78bfa;
            --cyan: #c4b5fd;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 48px 24px;
            color: var(--white);
            font-family: "Trebuchet MS", Arial, sans-serif;
            background:
                linear-gradient(135deg, rgba(167, 139, 250, 0.08), transparent 35%),
                linear-gradient(315deg, rgba(196, 181, 253, 0.06), transparent 42%),
                var(--black);
        }

        main { width: min(1100px, 100%); margin: 0 auto; }

        .eyebrow {
            margin: 0 0 12px;
            color: var(--lime);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
        }

        .heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 30px;
        }

        h1 {
            margin: 0;
            color: var(--white);
            font-size: clamp(2rem, 5vw, 4rem);
            line-height: 0.95;
            letter-spacing: -0.04em;
        }

        .heading p {
            max-width: 260px;
            margin: 0;
            color: var(--muted);
            font-size: 0.9rem;
            line-height: 1.5;
            text-align: right;
        }

        .table-panel {
            overflow: hidden;
            border: 1px solid var(--line);
            border-top: 3px solid var(--lime);
            background: var(--graphite);
            box-shadow: 12px 12px 0 rgba(167, 139, 250, 0.08);
        }

        .panel-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid var(--line);
            background: var(--panel);
        }

        .panel-title { margin: 0; font-size: 0.9rem; letter-spacing: 0.08em; text-transform: uppercase; }
        .count { color: var(--cyan); font-size: 0.8rem; font-weight: 700; }
        .table-scroll { overflow-x: auto; }
        table { width: 100%; min-width: 720px; border-collapse: collapse; }
        th, td { padding: 18px 20px; border-bottom: 1px solid var(--line); text-align: left; }
        th { color: var(--muted); background: #0e1011; font-size: 0.7rem; letter-spacing: 0.14em; text-transform: uppercase; }
        td { color: #d9dfe2; font-size: 0.95rem; }
        tbody tr { transition: background-color 0.2s, transform 0.2s; }
        tbody tr:hover { background: rgba(167, 139, 250, 0.08); }
        tbody tr:last-child td { border-bottom: 0; }
        td:first-child { color: var(--lime); font-weight: 700; }
        td:nth-child(4) { color: var(--cyan); }
        .empty { color: var(--muted); text-align: center; }

        .description {
            margin-bottom: 36px;
            padding: 24px;
            background: rgba(167, 139, 250, 0.05);
            border: 1px solid var(--line);
            border-radius: 12px;
        }

        .description h3 {
            margin: 0 0 12px;
            color: var(--lime);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .description p {
            margin: 0;
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }

        .stat-card {
            padding: 20px;
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 8px;
            text-align: center;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--lime);
            margin-bottom: 6px;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        @media (max-width: 640px) {
            body { padding: 28px 14px; }
            .heading { align-items: start; flex-direction: column; gap: 14px; margin-bottom: 22px; }
            .heading p { text-align: left; }
            .panel-bar { padding: 14px; }
            th, td { padding: 15px 14px; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <main>
        <p class="eyebrow">LavaLust / Directory</p>
        <div class="heading">
            <div>
                <h1>Users</h1>
                <p style="margin-top: 8px; color: var(--muted); font-size: 0.95rem;">Manage and view all active users in the system</p>
            </div>
            <p>Active records from the application database.</p>
        </div>

        <div class="description">
            <h3>📋 About This Page</h3>
            <p>This page displays a comprehensive list of all registered users in the LavaLust application. Each user record includes their personal information, contact details, and login credentials. The user management system is designed with a modern purple and white interface for optimal visibility and ease of navigation.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value"><?= count($users ?? []) ?></div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= !empty($users) ? count(array_filter($users, fn($u) => !empty($u['email']))) : 0 ?></div>
                <div class="stat-label">Active Accounts</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= date('M d, Y') ?></div>
                <div class="stat-label">Last Updated</div>
            </div>
        </div>

        <section class="table-panel">
            <div class="panel-bar">
                <h2 class="panel-title">User Registry</h2>
                <span class="count"><?= count($users ?? []) ?> records available</span>
            </div>
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($user['lastname'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td class="empty" colspan="5">No users found in the database.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>