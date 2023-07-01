CREATE VIEW users_with_roles AS
    SELECT u.user_id, u.avatar, u.username, u.email, r.name as role, u.created_date, u.modified_date
        FROM users u
        INNER JOIN roles r ON u.role_id = r.role_id