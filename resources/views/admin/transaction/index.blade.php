@extends('admin.layouts.panel')

@section('head')
    <style>
        :root {
            --primary: #5D5FEF;
            --primary-light: #E6E7FF;
            --secondary: #4F46E5;
            --danger: #EF4444;
            --warning: #F59E0B;
            --success: #10B981;
            --dark: #1F2937;
            --light: #F9FAFB;
        }

        body {
            background-color: #F3F4F6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: none;
            overflow: hidden;
            padding: 0;
        }

        .header-section {
            background-color: var(--primary);
            color: white;
            padding: 20px 25px;
            border-radius: 16px 16px 0 0;
        }

        .header-title {
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header-subtitle {
            font-size: 14px;
            opacity: 0.9;
        }

        .table-container {
            padding: 20px;
        }

        .table thead {
            background-color: var(--light);
        }

        .table th {
            color: var(--dark);
            font-weight: 600;
            padding: 16px 12px;
            border-bottom: 2px solid #E5E7EB;
        }

        .table td {
            padding: 12px;
            vertical-align: middle;
            border-bottom: 1px solid #E5E7EB;
        }

        .action-btn {
            background-color: transparent;
            color: var(--dark);
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .action-btn:hover {
            color: var(--primary);
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-pending {
            background-color: var(--primary-light);
            color: var(--primary);
        }

        .badge-progress {
            background-color: #FEF3C7;
            color: #D97706;
        }

        .badge-completed {
            background-color: #D1FAE5;
            color: #155f06;
        }

        .badge-cancelled {
            background-color: #FEE2E2;
            color: #B91C1C;
        }

        .search-box {
            border-radius: 10px;
            border: 1px solid #E5E7EB;
            transition: all 0.3s;
        }

        .search-box:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.2);
        }

        .btn-primary-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
            transition: all 0.3s;
        }

        .btn-primary-outline:hover {
            background: var(--primary);
            color: white;
        }

        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #E5E7EB;
        }

        .dropdown-item {
            padding: 8px 16px;
        }

        .dropdown-divider {
            margin: 4px 0;
        }

        .pagination .page-item .page-link {
            color: var(--dark);
            border-radius: 8px;
            border: 1px solid #E5E7EB;
            margin: 0 4px;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .modal-content {
            border-radius: 16px;
            overflow: hidden;
            border: none;
        }

        .modal-header {
            border-bottom: 1px solid #E5E7EB;
            padding: 16px 24px;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            border-top: 1px solid #E5E7EB;
            padding: 16px 24px;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
    </style>
@endsection

@section('body')
    @livewire('admin.transaction.data')
@endsection

@section('script')
@endsection
