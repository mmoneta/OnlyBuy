CREATE VIEW users_with_roles AS
    SELECT users.avatar, users.username, users.email, roles.name as role, users.created_date, users.modified_date
        FROM users
        INNER JOIN roles ON users.role_id = roles.role_id