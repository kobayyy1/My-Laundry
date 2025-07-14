
    <style>
        /* ===== ROOT VARIABLES ===== */
        :root {
            --primary: #5D5FEF;
            --primary-light: #E6E7FF;
            --primary-dark: #4338CA;
            --secondary: #4F46E5;
            --danger: #EF4444;
            --danger-light: #FEE2E2;
            --warning: #F59E0B;
            --warning-light: #FEF3C7;
            --success: #10B981;
            --success-light: #D1FAE5;
            --success-dark: #065F46;
            --dark: #1F2937;
            --light: #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-600: #6B7280;
            --gray-700: #374151;
            --white: #FFFFFF;
        }

        /* ===== GLOBAL STYLES ===== */
        body {
            background-color: var(--gray-100);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ===== CARD COMPONENTS ===== */
        .card-container {
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: none;
            overflow: hidden;
            padding: 0;
        }

        .header-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: var(--white);
            padding: 24px 30px;
            border-radius: 16px 16px 0 0;
            position: relative;
        }

        .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .header-title {
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 5px;
            position: relative;
            z-index: 1;
        }

        .header-subtitle {
            font-size: 14px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .table-container {
            padding: 25px;
        }

        /* ===== TABLE STYLES ===== */
        .table {
            margin-bottom: 0;
        }

        .table thead {
            background-color: var(--light);
        }

        .table th {
            color: var(--dark);
            font-weight: 600;
            padding: 16px 12px;
            border-bottom: 2px solid var(--gray-200);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            padding: 15px 12px;
            vertical-align: middle;
            border-bottom: 1px solid var(--gray-200);
            font-size: 14px;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(93, 95, 239, 0.02);
        }

        /* ===== BADGE STYLES (FIXED) ===== */
        .badge {
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            min-width: 80px;
            justify-content: center;
            border: 1px solid transparent;
        }

        /* Status Badge - Pending */
        .badge-pending {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            border-color: var(--primary);
        }

        .badge-ready {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            border-color: var(--success);
        }

        /* Status Badge - Progress */
        .badge-progress {
            background-color: var(--warning-light);
            color: #B45309;
            border-color: var(--warning);
        }

        /* Status Badge - Completed */
        .badge-completed {
            background-color: var(--success-light);
            color: var(--success-dark);
            border-color: var(--success);
        }

        /* Status Badge - Cancelled */
        .badge-cancelled {
            background-color: var(--danger-light);
            color: #991B1B;
            border-color: var(--danger);
        }

        /* Status Badge - Default/Secondary */
        .badge-secondary {
            background-color: #F1F5F9;
            color: var(--gray-700);
            border-color: var(--gray-200);
        }

        /* ===== FORM CONTROLS ===== */
        .search-box {
            border-radius: 10px;
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .search-box:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.15);
        }

        .search-box .form-control {
            border: none;
            padding: 12px 16px;
            font-size: 14px;
        }

        .search-box .form-control:focus {
            box-shadow: none;
        }

        .search-box .input-group-text {
            background: transparent;
            border: none;
            color: var(--gray-600);
            padding: 12px 16px;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.15);
        }

        /* ===== BUTTONS ===== */
        .btn-primary-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
            transition: all 0.3s ease;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 25px;
        }

        .btn-primary-outline:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(93, 95, 239, 0.3);
        }

        .btn-success {
            background: var(--success);
            border-color: var(--success);
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: #0F766E;
            border-color: #0F766E;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-danger {
            background: var(--danger);
            border-color: var(--danger);
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: #DC2626;
            border-color: #DC2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-outline-primary {
            border-color: var(--primary);
            color: var(--primary);
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
        }

        .btn-outline-secondary {
            border-color: var(--gray-200);
            color: var(--gray-700);
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background: var(--gray-200);
            border-color: var(--gray-200);
            color: var(--dark);
        }

        /* ===== DROPDOWNS ===== */
        .dropdown-menu {
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--gray-200);
            padding: 8px 0;
            min-width: 200px;
        }

        .dropdown-item {
            padding: 10px 16px;
            font-size: 14px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }

        .dropdown-item:hover {
            background-color: rgba(93, 95, 239, 0.1);
            color: var(--primary);
        }

        .dropdown-item i {
            width: 16px;
            text-align: center;
            margin-right: 8px;
        }

        .dropdown-divider {
            margin: 6px 0;
            border-top: 1px solid var(--gray-200);
        }

        .dropdown-header {
            font-weight: 600;
            color: var(--dark);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 16px 4px;
        }

        /* ===== PAGINATION ===== */
        .pagination {
            gap: 4px;
        }

        .pagination .page-item .page-link {
            color: var(--gray-700);
            border-radius: 8px;
            border: 1px solid var(--gray-200);
            padding: 8px 12px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .pagination .page-item .page-link:hover {
            background-color: var(--primary-light);
            border-color: var(--primary);
            color: var(--primary);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
            color: var(--white);
        }

        .pagination .page-item.disabled .page-link {
            color: var(--gray-600);
            background-color: var(--light);
            border-color: var(--gray-200);
        }

        /* ===== MODALS ===== */
        .modal-content {
            border-radius: 16px;
            overflow: hidden;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            border-bottom: 1px solid var(--gray-200);
            padding: 20px 24px;
            background: var(--light);
        }

        .modal-title {
            font-weight: 600;
            color: var(--dark);
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            border-top: 1px solid var(--gray-200);
            padding: 20px 24px;
            background: var(--light);
        }

        .btn-close {
            opacity: 0.6;
            transition: all 0.2s ease;
        }

        .btn-close:hover {
            opacity: 1;
        }

        /* ===== ALERTS ===== */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .alert-warning {
            background-color: var(--warning-light);
            color: #92400E;
            border-left: 4px solid var(--warning);
        }

        /* ===== FORM ELEMENTS ===== */
        .form-control {
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.15);
        }

        .form-select {
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.15);
        }

        .form-label {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 6px;
        }

        .form-check-label {
            font-size: 14px;
            color: var(--gray-700);
        }

        /* ===== UTILITIES ===== */
        .text-muted {
            color: var(--gray-600) !important;
        }

        .rounded-pill {
            border-radius: 25px !important;
        }

        .shadow {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
        }
    </style>