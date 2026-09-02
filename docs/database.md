# Database Design

## Overview

The IT Asset Management System uses a relational MySQL database.

The database is designed to manage:

- Departments
- Employees
- IT Assets
- Asset Assignments
- Maintenance Records

## Tables

### departments

Stores company departments.

### employees

Stores employee information and their department relationships.

### assets

Stores information about IT assets.

### asset_assignments

Tracks asset assignments to employees over time.

### maintenance

Stores maintenance records for assets.

## Relationships

- One department can have many employees.
- One employee can have many asset assignments.
- One asset can have many assignment records.
- One asset can have many maintenance records.

## Database Files

- `schema.sql` — Creates the database structure.
- `seed.sql` — Inserts sample development data.