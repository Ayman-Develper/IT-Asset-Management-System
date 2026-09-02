USE it_asset_management;

INSERT INTO departments (name)
VALUES
    ('IT'),
    ('Human Resources'),
    ('Finance'),
    ('Marketing');

INSERT INTO employees (
    department_id,
    employee_number,
    first_name,
    last_name,
    email,
    phone
)
VALUES
    (1, 'EMP-001', 'Ahmed', 'Ali', 'ahmed@example.com', '0500000001'),
    (1, 'EMP-002', 'Mohammed', 'Khalid', 'mohammed@example.com', '0500000002'),
    (2, 'EMP-003', 'Sara', 'Hassan', 'sara@example.com', '0500000003');

INSERT INTO assets (
    asset_tag,
    asset_type,
    brand,
    model,
    serial_number,
    purchase_date,
    purchase_cost,
    status
)
VALUES
    (
        'LAP-001',
        'Laptop',
        'Dell',
        'Latitude 5540',
        'DL5540-001',
        '2026-01-10',
        4200.00,
        'Assigned'
    ),
    (
        'MON-001',
        'Monitor',
        'Dell',
        'P2422H',
        'DLP2422-001',
        '2026-02-15',
        750.00,
        'Available'
    ),
    (
        'LAP-002',
        'Laptop',
        'HP',
        'EliteBook 840',
        'HP840-001',
        '2026-03-01',
        3900.00,
        'Available'
    );

INSERT INTO asset_assignments (
    asset_id,
    employee_id,
    assigned_at,
    notes
)
VALUES
    (
        1,
        1,
        '2026-08-01 09:00:00',
        'Assigned to IT employee'
    );

INSERT INTO maintenance (
    asset_id,
    issue_description,
    maintenance_date,
    status,
    cost,
    resolution
)
VALUES
    (
        1,
        'Laptop battery performance issue',
        '2026-08-02',
        'Completed',
        250.00,
        'Battery replaced'
    );