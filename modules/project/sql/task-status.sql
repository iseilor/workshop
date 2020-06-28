INSERT INTO workshop.project_task_status (created_at, created_by, title, description, color, progress)
VALUES (UNIX_TIMESTAMP(), 1, 'Новая', 'Новая', 'info', 10);
INSERT INTO workshop.project_task_status (created_at, created_by, title, description, color, progress)
VALUES (UNIX_TIMESTAMP(), 1, 'В работе', 'В работе', 'warning', 50);
INSERT INTO workshop.project_task_status (created_at, created_by, title, description, color, progress)
VALUES (UNIX_TIMESTAMP(), 1, 'Выполнено', 'Выполнено', 'success', 100);
INSERT INTO workshop.project_task_status (created_at, created_by, title, description, color, progress)
VALUES (UNIX_TIMESTAMP(), 1, 'Проблема', 'Проблема', 'danger', 0);
INSERT INTO workshop.project_task_status (created_at, created_by, title, description, color, progress)
VALUES (UNIX_TIMESTAMP(), 1, 'Другое', 'Другое', 'secondary', 0);